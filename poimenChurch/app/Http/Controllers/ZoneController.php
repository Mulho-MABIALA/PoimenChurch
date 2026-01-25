<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZoneRequest;
use App\Models\Branch;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZoneController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Zone::with(['branch', 'leader', 'assistantLeader'])
            ->withCount(['bacentas', 'members']);

        // Filtrer par permissions
        if ($user->hasRole('zone_leader')) {
            $query->where('leader_id', $user->id);
        }

        $zones = $query->when($request->search, function ($q, $search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->when($request->branch_id, function ($q, $branchId) {
                $q->where('branch_id', $branchId);
            })
            ->when($request->status !== null, function ($q) use ($request) {
                $q->where('is_active', $request->status === 'active');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $branches = Branch::where('is_active', true)->get();

        return view('structures.zones.index', compact('zones', 'branches'));
    }

    public function create()
    {
        $branches = Branch::where('is_active', true)->get();
        $leaders = User::whereHas('roles', fn($q) => $q->whereIn('name', ['zone_leader', 'minister', 'pastor_assistant']))
            ->where('is_active', true)
            ->get();

        return view('structures.zones.create', compact('branches', 'leaders'));
    }

    public function store(ZoneRequest $request)
    {
        Zone::create($request->validated());

        return redirect()->route('zones.index')
            ->with('success', __('app.messages.created', ['item' => __('app.zones.title')]));
    }

    public function show(Zone $zone)
    {
        $this->authorizeZoneAccess($zone);

        $zone->load(['branch', 'leader', 'assistantLeader', 'bacentas.shepherd', 'members']);

        $stats = [
            'total_bacentas' => $zone->bacentas->count(),
            'total_members' => $zone->total_members_count,
            'weekly_attendance' => $zone->getWeeklyAttendance('sunday_service', now()->startOfWeek(), now()->endOfWeek()),
            'weekly_offerings' => $zone->getWeeklyOfferings(now()->startOfWeek(), now()->endOfWeek()),
        ];

        $growthTrend = $zone->getGrowthTrend(4);

        return view('structures.zones.show', compact('zone', 'stats', 'growthTrend'));
    }

    public function edit(Zone $zone)
    {
        $this->authorizeZoneAccess($zone);

        $branches = Branch::where('is_active', true)->get();
        $leaders = User::whereHas('roles', fn($q) => $q->whereIn('name', ['zone_leader', 'minister', 'pastor_assistant']))
            ->where('is_active', true)
            ->get();

        return view('structures.zones.edit', compact('zone', 'branches', 'leaders'));
    }

    public function update(ZoneRequest $request, Zone $zone)
    {
        $this->authorizeZoneAccess($zone);

        $zone->update($request->validated());

        return redirect()->route('zones.index')
            ->with('success', __('app.messages.updated', ['item' => __('app.zones.title')]));
    }

    public function destroy(Zone $zone)
    {
        $zone->delete();

        return redirect()->route('zones.index')
            ->with('success', __('app.messages.deleted', ['item' => __('app.zones.title')]));
    }

    protected function authorizeZoneAccess(Zone $zone)
    {
        $user = Auth::user();

        if ($user->hasRole('zone_leader') && $zone->leader_id !== $user->id) {
            abort(403, __('app.messages.unauthorized'));
        }
    }
}
