<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\Bacenta;
use App\Models\Department;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['roles', 'bacentas', 'zones', 'departments'])
            ->when($request->search, function ($q, $search) {
                $q->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', "%{$search}%")
                          ->orWhere('last_name', 'like', "%{$search}%")
                          ->orWhere('email', 'like', "%{$search}%")
                          ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->when($request->role, function ($q, $role) {
                $q->whereHas('roles', fn($query) => $query->where('name', $role));
            })
            ->when($request->status !== null, function ($q) use ($request) {
                $q->where('is_active', $request->status === 'active');
            })
            ->when($request->zone_id, function ($q, $zoneId) {
                $q->whereHas('zones', fn($query) => $query->where('zones.id', $zoneId));
            })
            ->when($request->bacenta_id, function ($q, $bacentaId) {
                $q->whereHas('bacentas', fn($query) => $query->where('bacentas.id', $bacentaId));
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $roles = Role::all();
        $zones = Zone::where('is_active', true)->get();
        $bacentas = Bacenta::where('is_active', true)->get();

        $members = $query;
        return view('members.index', compact('members', 'roles', 'zones', 'bacentas'));
    }

    public function create()
    {
        $roles = Role::all();
        $zones = Zone::where('is_active', true)->get();
        $bacentas = Bacenta::where('is_active', true)->get();
        $departments = Department::where('is_active', true)->get();

        return view('members.create', compact('roles', 'zones', 'bacentas', 'departments'));
    }

    public function store(MemberRequest $request)
    {
        $data = $request->validated();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('members/photos', 'public');
        }

        $data['password'] = Hash::make($data['password'] ?? 'password123');

        $member = User::create($data);

        // Assign roles
        if ($request->has('roles')) {
            $member->syncRoles($request->roles);
        } else {
            $member->assignRole('member');
        }

        // Attach to structures
        if ($request->has('zone_ids')) {
            $member->zones()->sync($request->zone_ids);
        }

        if ($request->has('bacenta_ids')) {
            $member->bacentas()->sync($request->bacenta_ids);
        }

        if ($request->has('department_ids')) {
            $member->departments()->sync($request->department_ids);
        }

        return redirect()->route('members.index')
            ->with('success', __('app.messages.created', ['item' => __('app.members.title')]));
    }

    public function show(User $member)
    {
        $member->load(['roles', 'zones', 'bacentas', 'departments', 'donations', 'attendances']);

        // Statistiques du membre
        $stats = [
            'attendance_rate' => $member->getAttendanceRate('sunday_service', 6),
            'total_donations_year' => $member->getTotalDonations(now()->year),
            'total_tithes_year' => $member->getTotalDonations(now()->year, 'tithe'),
        ];

        return view('members.show', compact('member', 'stats'));
    }

    public function edit(User $member)
    {
        $roles = Role::all();
        $zones = Zone::where('is_active', true)->get();
        $bacentas = Bacenta::where('is_active', true)->get();
        $departments = Department::where('is_active', true)->get();

        return view('members.edit', compact('member', 'roles', 'zones', 'bacentas', 'departments'));
    }

    public function update(MemberRequest $request, User $member)
    {
        $data = $request->validated();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }
            $data['photo'] = $request->file('photo')->store('members/photos', 'public');
        }

        // Update password only if provided
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $member->update($data);

        // Sync roles
        if ($request->has('roles')) {
            $member->syncRoles($request->roles);
        }

        // Sync structures
        if ($request->has('zone_ids')) {
            $member->zones()->sync($request->zone_ids);
        }

        if ($request->has('bacenta_ids')) {
            $member->bacentas()->sync($request->bacenta_ids);
        }

        if ($request->has('department_ids')) {
            $member->departments()->sync($request->department_ids);
        }

        return redirect()->route('members.index')
            ->with('success', __('app.messages.updated', ['item' => __('app.members.title')]));
    }

    public function destroy(User $member)
    {
        // Soft delete
        $member->delete();

        return redirect()->route('members.index')
            ->with('success', __('app.messages.deleted', ['item' => __('app.members.title')]));
    }

    public function toggleStatus(User $member)
    {
        $member->update(['is_active' => !$member->is_active]);

        return back()->with('success', __('app.messages.updated', ['item' => __('app.members.status')]));
    }
}
