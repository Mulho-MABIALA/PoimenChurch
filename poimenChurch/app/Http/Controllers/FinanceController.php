<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinancialTransactionRequest;
use App\Models\Branch;
use App\Models\FinancialTransaction;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = FinancialTransaction::with(['user', 'branch', 'zone', 'recordedBy']);

        // Filtrer pour les membres standards (voir uniquement leurs propres dons)
        if ($user->hasRole('member') && !$user->hasAnyRole(['bishop', 'admin', 'treasurer', 'reverend'])) {
            $query->where('user_id', $user->id);
        }

        $transactions = $query->when($request->search, function ($q, $search) {
                $q->whereHas('user', fn($query) =>
                    $query->where('first_name', 'like', "%{$search}%")
                          ->orWhere('last_name', 'like', "%{$search}%")
                );
            })
            ->when($request->transaction_type, function ($q, $type) {
                $q->where('transaction_type', $type);
            })
            ->when($request->payment_method, function ($q, $method) {
                $q->where('payment_method', $method);
            })
            ->when($request->zone_id, function ($q, $zoneId) {
                $q->where('zone_id', $zoneId);
            })
            ->when($request->branch_id, function ($q, $branchId) {
                $q->where('branch_id', $branchId);
            })
            ->when($request->date_from, function ($q, $dateFrom) {
                $q->where('transaction_date', '>=', $dateFrom);
            })
            ->when($request->date_to, function ($q, $dateTo) {
                $q->where('transaction_date', '<=', $dateTo);
            })
            ->when($request->year, function ($q, $year) {
                $q->where('fiscal_year', $year);
            })
            ->latest('transaction_date')
            ->paginate(20)
            ->withQueryString();

        $zones = Zone::where('is_active', true)->get();
        $branches = Branch::where('is_active', true)->get();

        // Statistiques
        $currentYear = $request->input('year', now()->year);
        $stats = $this->getStats($user, $currentYear);

        return view('finances.index', compact('transactions', 'zones', 'branches', 'stats', 'currentYear'));
    }

    public function create()
    {
        $members = User::where('is_active', true)->orderBy('last_name')->get();
        $zones = Zone::where('is_active', true)->get();
        $branches = Branch::where('is_active', true)->get();

        return view('finances.create', compact('members', 'zones', 'branches'));
    }

    public function store(FinancialTransactionRequest $request)
    {
        $data = $request->validated();
        $data['recorded_by'] = Auth::id();
        $data['fiscal_year'] = now()->parse($data['transaction_date'])->year;

        FinancialTransaction::create($data);

        return redirect()->route('finances.index')
            ->with('success', __('app.messages.created', ['item' => __('app.finances.title')]));
    }

    public function show(FinancialTransaction $finance)
    {
        $this->authorizeAccess($finance);

        $finance->load(['user', 'branch', 'zone', 'recordedBy']);

        return view('finances.show', compact('finance'));
    }

    public function edit(FinancialTransaction $finance)
    {
        $this->authorizeAccess($finance);

        $members = User::where('is_active', true)->orderBy('last_name')->get();
        $zones = Zone::where('is_active', true)->get();
        $branches = Branch::where('is_active', true)->get();

        return view('finances.edit', compact('finance', 'members', 'zones', 'branches'));
    }

    public function update(FinancialTransactionRequest $request, FinancialTransaction $finance)
    {
        $this->authorizeAccess($finance);

        $data = $request->validated();
        $data['fiscal_year'] = now()->parse($data['transaction_date'])->year;

        $finance->update($data);

        return redirect()->route('finances.index')
            ->with('success', __('app.messages.updated', ['item' => __('app.finances.title')]));
    }

    public function destroy(FinancialTransaction $finance)
    {
        $this->authorizeAccess($finance);

        $finance->delete();

        return redirect()->route('finances.index')
            ->with('success', __('app.messages.deleted', ['item' => __('app.finances.title')]));
    }

    // Mes dons (pour les membres)
    public function myDonations(Request $request)
    {
        $user = Auth::user();

        $donations = $user->donations()
            ->when($request->year, function ($q, $year) {
                $q->where('fiscal_year', $year);
            })
            ->when($request->transaction_type, function ($q, $type) {
                $q->where('transaction_type', $type);
            })
            ->latest('transaction_date')
            ->paginate(20)
            ->withQueryString();

        $years = $user->donations()->distinct()->pluck('fiscal_year')->sort()->reverse();

        $currentYear = $request->input('year', now()->year);
        $summary = [
            'total_tithes' => $user->getTotalDonations($currentYear, 'tithe'),
            'total_offerings' => $user->getTotalDonations($currentYear, 'offering'),
            'total_special' => $user->getTotalDonations($currentYear, 'special_offering'),
            'total' => $user->getTotalDonations($currentYear),
        ];

        return view('finances.my-donations', compact('donations', 'years', 'summary', 'currentYear'));
    }

    // Rapport annuel
    public function annualReport(Request $request)
    {
        $year = $request->input('year', now()->year);

        $monthlyTotals = FinancialTransaction::getMonthlyTotals($year);

        $summary = [
            'total_tithes' => FinancialTransaction::getTotalByType('tithe', $year),
            'total_offerings' => FinancialTransaction::getTotalByType('offering', $year),
            'total_special' => FinancialTransaction::getTotalByType('special_offering', $year),
        ];

        $summary['grand_total'] = $summary['total_tithes'] + $summary['total_offerings'] + $summary['total_special'];

        // Top donateurs (dîmes)
        $topTithers = User::withSum(['donations as total_tithes' => function ($q) use ($year) {
            $q->where('transaction_type', 'tithe')->where('fiscal_year', $year);
        }], 'amount')
            ->having('total_tithes', '>', 0)
            ->orderByDesc('total_tithes')
            ->limit(10)
            ->get();

        $years = FinancialTransaction::distinct()->pluck('fiscal_year')->sort()->reverse();

        return view('finances.annual-report', compact('monthlyTotals', 'summary', 'topTithers', 'year', 'years'));
    }

    // Rapport par zone
    public function zoneReport(Request $request)
    {
        $year = $request->input('year', now()->year);

        $zones = Zone::withSum(['financialTransactions as total_amount' => function ($q) use ($year) {
            $q->where('fiscal_year', $year);
        }], 'amount')
            ->where('is_active', true)
            ->orderByDesc('total_amount')
            ->get();

        return view('finances.zone-report', compact('zones', 'year'));
    }

    protected function getStats($user, $year)
    {
        $query = FinancialTransaction::where('fiscal_year', $year);

        if ($user->hasRole('member') && !$user->hasAnyRole(['bishop', 'admin', 'treasurer', 'reverend'])) {
            $query->where('user_id', $user->id);
        }

        return [
            'total_tithes' => (clone $query)->where('transaction_type', 'tithe')->sum('amount'),
            'total_offerings' => (clone $query)->where('transaction_type', 'offering')->sum('amount'),
            'total_special' => (clone $query)->where('transaction_type', 'special_offering')->sum('amount'),
            'total' => $query->sum('amount'),
        ];
    }

    protected function authorizeAccess(FinancialTransaction $finance)
    {
        $user = Auth::user();

        if ($user->hasAnyRole(['bishop', 'admin', 'treasurer', 'reverend'])) {
            return;
        }

        if ($finance->user_id !== $user->id) {
            abort(403, __('app.messages.unauthorized'));
        }
    }
}
