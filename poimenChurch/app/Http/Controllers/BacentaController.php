<?php

namespace App\Http\Controllers;

use App\Http\Requests\BacentaRequest;
use App\Models\Bacenta;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BacentaController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Bacenta::with(['zone.branch', 'shepherd', 'assistantShepherd'])
            ->withCount('members');

        // Filtrer par permissions
        if ($user->hasRole('zone_leader')) {
            $zoneIds = $user->ledZones->pluck('id');
            $query->whereIn('zone_id', $zoneIds);
        } elseif ($user->hasRole('shepherd')) {
            $query->where('shepherd_id', $user->id);
        }

        $bacentas = $query->when($request->search, function ($q, $search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            })
            ->when($request->zone_id, function ($q, $zoneId) {
                $q->where('zone_id', $zoneId);
            })
            ->when($request->meeting_day, function ($q, $day) {
                $q->where('meeting_day', $day);
            })
            ->when($request->status !== null, function ($q) use ($request) {
                $q->where('is_active', $request->status === 'active');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $zones = Zone::where('is_active', true)->get();

        return view('structures.bacentas.index', compact('bacentas', 'zones'));
    }

    public function create()
    {
        $zones = Zone::where('is_active', true)->with('branch')->get();
        $shepherds = User::whereHas('roles', fn($q) => $q->where('name', 'shepherd'))
            ->where('is_active', true)
            ->get();

        return view('structures.bacentas.create', compact('zones', 'shepherds'));
    }

    public function store(BacentaRequest $request)
    {
        Bacenta::create($request->validated());

        return redirect()->route('bacentas.index')
            ->with('success', __('app.messages.created', ['item' => __('app.bacentas.title')]));
    }

    public function show(Bacenta $bacenta)
    {
        $this->authorizeBacentaAccess($bacenta);

        $bacenta->load(['zone.branch', 'shepherd', 'assistantShepherd', 'members', 'reports' => function ($q) {
            $q->latest('report_date')->limit(10);
        }]);

        $stats = [
            'total_members' => $bacenta->members->count(),
            'average_attendance' => $bacenta->getAverageAttendance(4, 'sunday_service'),
            'last_report' => $bacenta->getLatestReport(),
        ];

        $weeklyReport = $bacenta->getWeeklyReport(now()->startOfWeek(), now()->endOfWeek());

        return view('structures.bacentas.show', compact('bacenta', 'stats', 'weeklyReport'));
    }

    public function edit(Bacenta $bacenta)
    {
        $this->authorizeBacentaAccess($bacenta);

        $zones = Zone::where('is_active', true)->with('branch')->get();
        $shepherds = User::whereHas('roles', fn($q) => $q->where('name', 'shepherd'))
            ->where('is_active', true)
            ->get();

        return view('structures.bacentas.edit', compact('bacenta', 'zones', 'shepherds'));
    }

    public function update(BacentaRequest $request, Bacenta $bacenta)
    {
        $this->authorizeBacentaAccess($bacenta);

        $bacenta->update($request->validated());

        return redirect()->route('bacentas.index')
            ->with('success', __('app.messages.updated', ['item' => __('app.bacentas.title')]));
    }

    public function destroy(Bacenta $bacenta)
    {
        $bacenta->delete();

        return redirect()->route('bacentas.index')
            ->with('success', __('app.messages.deleted', ['item' => __('app.bacentas.title')]));
    }

    public function members(Bacenta $bacenta)
    {
        $this->authorizeBacentaAccess($bacenta);

        $bacenta->load('members');

        // Get members not already in this bacenta
        $existingMemberIds = $bacenta->members->pluck('id')->toArray();
        $availableMembers = User::where('is_active', true)
            ->whereNotIn('id', $existingMemberIds)
            ->orderBy('last_name')
            ->get();

        return view('structures.bacentas.members', compact('bacenta', 'availableMembers'));
    }

    public function addMember(Request $request, Bacenta $bacenta)
    {
        $this->authorizeBacentaAccess($bacenta);

        $request->validate(['user_id' => 'required|exists:users,id']);

        $bacenta->members()->syncWithoutDetaching([$request->user_id]);

        return back()->with('success', __('app.messages.updated', ['item' => __('app.bacentas.members_count')]));
    }

    public function removeMember(Bacenta $bacenta, User $user)
    {
        $this->authorizeBacentaAccess($bacenta);

        $bacenta->members()->detach($user->id);

        return back()->with('success', __('app.messages.updated', ['item' => __('app.bacentas.members_count')]));
    }

    protected function authorizeBacentaAccess(Bacenta $bacenta)
    {
        $user = Auth::user();

        if ($user->hasRole('shepherd') && $bacenta->shepherd_id !== $user->id) {
            abort(403, __('app.messages.unauthorized'));
        }

        if ($user->hasRole('zone_leader')) {
            $zoneIds = $user->ledZones->pluck('id');
            if (!$zoneIds->contains($bacenta->zone_id)) {
                abort(403, __('app.messages.unauthorized'));
            }
        }
    }
}
