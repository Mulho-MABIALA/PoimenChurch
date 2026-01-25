<?php

namespace App\Http\Controllers;

use App\Http\Requests\BacentaReportRequest;
use App\Models\Bacenta;
use App\Models\BacentaReport;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = BacentaReport::with(['bacenta.zone.branch', 'submittedBy']);

        // Filtrer par permissions
        if ($user->hasRole('zone_leader')) {
            $zoneIds = $user->ledZones->pluck('id');
            $query->whereHas('bacenta', fn($q) => $q->whereIn('zone_id', $zoneIds));
        } elseif ($user->hasRole('shepherd')) {
            $bacentaIds = $user->shepherdedBacentas->pluck('id');
            $query->whereIn('bacenta_id', $bacentaIds);
        }

        $reports = $query->when($request->search, function ($q, $search) {
                $q->whereHas('bacenta', fn($query) => $query->where('name', 'like', "%{$search}%"));
            })
            ->when($request->bacenta_id, function ($q, $bacentaId) {
                $q->where('bacenta_id', $bacentaId);
            })
            ->when($request->zone_id, function ($q, $zoneId) {
                $q->whereHas('bacenta', fn($query) => $query->where('zone_id', $zoneId));
            })
            ->when($request->report_type, function ($q, $type) {
                $q->where('report_type', $type);
            })
            ->when($request->date_from, function ($q, $dateFrom) {
                $q->where('report_date', '>=', $dateFrom);
            })
            ->when($request->date_to, function ($q, $dateTo) {
                $q->where('report_date', '<=', $dateTo);
            })
            ->latest('report_date')
            ->paginate(15)
            ->withQueryString();

        $zones = Zone::where('is_active', true)->get();
        $bacentas = $this->getAccessibleBacentas($user);

        // Calculate stats
        $statsQuery = BacentaReport::query();
        if ($user->hasRole('zone_leader')) {
            $zoneIds = $user->ledZones->pluck('id');
            $statsQuery->whereHas('bacenta', fn($q) => $q->whereIn('zone_id', $zoneIds));
        } elseif ($user->hasRole('shepherd')) {
            $bacentaIds = $user->shepherdedBacentas->pluck('id');
            $statsQuery->whereIn('bacenta_id', $bacentaIds);
        }

        $stats = [
            'total_reports' => (clone $statsQuery)->count(),
            'total_attendance' => (clone $statsQuery)->sum('attendance_count'),
            'avg_attendance' => (clone $statsQuery)->avg('attendance_count') ?? 0,
            'total_offerings' => (clone $statsQuery)->sum('offering_amount') ?? 0,
        ];

        return view('reports.index', compact('reports', 'zones', 'bacentas', 'stats'));
    }

    public function create()
    {
        $user = Auth::user();
        $bacentas = $this->getAccessibleBacentas($user);

        return view('reports.create', compact('bacentas'));
    }

    public function store(BacentaReportRequest $request)
    {
        $data = $request->validated();
        $data['submitted_by'] = Auth::id();

        // Vérifier si un rapport existe déjà
        $exists = BacentaReport::where('bacenta_id', $data['bacenta_id'])
            ->where('report_date', $data['report_date'])
            ->where('report_type', $data['report_type'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['report_date' => __('app.attendance.report_exists')])->withInput();
        }

        BacentaReport::create($data);

        return redirect()->route('reports.index')
            ->with('success', __('app.messages.report_submitted'));
    }

    public function show(BacentaReport $report)
    {
        $this->authorizeReportAccess($report);

        $report->load(['bacenta.zone.branch', 'submittedBy', 'memberAttendances.user']);

        return view('reports.show', compact('report'));
    }

    public function edit(BacentaReport $report)
    {
        $this->authorizeReportAccess($report);

        $user = Auth::user();
        $bacentas = $this->getAccessibleBacentas($user);

        return view('reports.edit', compact('report', 'bacentas'));
    }

    public function update(BacentaReportRequest $request, BacentaReport $report)
    {
        $this->authorizeReportAccess($report);

        $report->update($request->validated());

        return redirect()->route('reports.index')
            ->with('success', __('app.messages.updated', ['item' => __('app.attendance.report')]));
    }

    public function destroy(BacentaReport $report)
    {
        $this->authorizeReportAccess($report);

        $report->delete();

        return redirect()->route('reports.index')
            ->with('success', __('app.messages.deleted', ['item' => __('app.attendance.report')]));
    }

    // Rapport hebdomadaire par zone
    public function weeklyByZone(Request $request)
    {
        $user = Auth::user();
        $startOfWeek = $request->input('week_start', now()->startOfWeek()->format('Y-m-d'));
        $endOfWeek = now()->parse($startOfWeek)->endOfWeek();

        $query = Zone::with(['bacentas.reports' => function ($q) use ($startOfWeek, $endOfWeek) {
            $q->whereBetween('report_date', [$startOfWeek, $endOfWeek]);
        }])->where('is_active', true);

        if ($user->hasRole('zone_leader')) {
            $query->where('leader_id', $user->id);
        }

        $zones = $query->get()->map(function ($zone) {
            $reports = $zone->bacentas->flatMap->reports;
            return [
                'zone' => $zone,
                'bacenta_attendance' => $reports->where('report_type', 'bacenta_meeting')->sum('attendance_count'),
                'sunday_attendance' => $reports->where('report_type', 'sunday_service')->sum('attendance_count'),
                'total_offerings' => $reports->sum('offering_amount'),
                'reports_submitted' => $reports->count(),
                'bacentas_count' => $zone->bacentas->count(),
            ];
        });

        return view('reports.weekly-zone', compact('zones', 'startOfWeek', 'endOfWeek'));
    }

    // Rapport mensuel
    public function monthly(Request $request)
    {
        $user = Auth::user();
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        $startOfMonth = now()->setYear($year)->setMonth($month)->startOfMonth();
        $endOfMonth = now()->setYear($year)->setMonth($month)->endOfMonth();

        $query = BacentaReport::whereBetween('report_date', [$startOfMonth, $endOfMonth]);

        if ($user->hasRole('zone_leader')) {
            $zoneIds = $user->ledZones->pluck('id');
            $query->whereHas('bacenta', fn($q) => $q->whereIn('zone_id', $zoneIds));
        } elseif ($user->hasRole('shepherd')) {
            $bacentaIds = $user->shepherdedBacentas->pluck('id');
            $query->whereIn('bacenta_id', $bacentaIds);
        }

        $summary = [
            'total_bacenta_attendance' => (clone $query)->where('report_type', 'bacenta_meeting')->sum('attendance_count'),
            'total_sunday_attendance' => (clone $query)->where('report_type', 'sunday_service')->sum('attendance_count'),
            'total_offerings' => (clone $query)->sum('offering_amount'),
            'reports_count' => $query->count(),
        ];

        // Données par semaine
        $weeklyData = [];
        $currentDate = $startOfMonth->copy();
        while ($currentDate <= $endOfMonth) {
            $weekStart = $currentDate->copy()->startOfWeek();
            $weekEnd = $currentDate->copy()->endOfWeek();

            if ($weekEnd > $endOfMonth) {
                $weekEnd = $endOfMonth->copy();
            }

            $weekQuery = BacentaReport::whereBetween('report_date', [$weekStart, $weekEnd]);

            if ($user->hasRole('zone_leader')) {
                $zoneIds = $user->ledZones->pluck('id');
                $weekQuery->whereHas('bacenta', fn($q) => $q->whereIn('zone_id', $zoneIds));
            } elseif ($user->hasRole('shepherd')) {
                $bacentaIds = $user->shepherdedBacentas->pluck('id');
                $weekQuery->whereIn('bacenta_id', $bacentaIds);
            }

            $weeklyData[] = [
                'week' => $weekStart->format('d/m') . ' - ' . $weekEnd->format('d/m'),
                'attendance' => (clone $weekQuery)->where('report_type', 'sunday_service')->sum('attendance_count'),
                'offerings' => (clone $weekQuery)->sum('offering_amount'),
            ];

            $currentDate->addWeek();
        }

        return view('reports.monthly', compact('summary', 'weeklyData', 'month', 'year'));
    }

    protected function getAccessibleBacentas($user)
    {
        if ($user->hasRole(['bishop', 'admin', 'reverend'])) {
            return Bacenta::where('is_active', true)->get();
        }

        if ($user->hasRole('zone_leader')) {
            $zoneIds = $user->ledZones->pluck('id');
            return Bacenta::whereIn('zone_id', $zoneIds)->where('is_active', true)->get();
        }

        if ($user->hasRole('shepherd')) {
            return $user->shepherdedBacentas;
        }

        return collect();
    }

    protected function authorizeReportAccess(BacentaReport $report)
    {
        $user = Auth::user();

        if ($user->hasRole(['bishop', 'admin', 'reverend'])) {
            return;
        }

        if ($user->hasRole('zone_leader')) {
            $zoneIds = $user->ledZones->pluck('id');
            if (!$zoneIds->contains($report->bacenta->zone_id)) {
                abort(403, __('app.messages.unauthorized'));
            }
        }

        if ($user->hasRole('shepherd')) {
            if ($report->bacenta->shepherd_id !== $user->id) {
                abort(403, __('app.messages.unauthorized'));
            }
        }
    }
}
