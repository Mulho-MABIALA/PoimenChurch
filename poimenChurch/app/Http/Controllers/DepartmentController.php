<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Department::with(['leader', 'supervisor'])
            ->withCount('members');

        if ($user->hasRole('department_leader')) {
            $query->where('leader_id', $user->id);
        }

        $departments = $query->when($request->search, function ($q, $search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            })
            ->when($request->status !== null, function ($q) use ($request) {
                $q->where('is_active', $request->status === 'active');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('structures.departments.index', compact('departments'));
    }

    public function create()
    {
        $leaders = User::where('is_active', true)->get();

        return view('structures.departments.create', compact('leaders'));
    }

    public function store(DepartmentRequest $request)
    {
        Department::create($request->validated());

        return redirect()->route('departments.index')
            ->with('success', __('app.messages.created', ['item' => __('app.departments.title')]));
    }

    public function show(Department $department)
    {
        $department->load(['leader', 'supervisor', 'members']);

        return view('structures.departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        $leaders = User::where('is_active', true)->get();

        return view('structures.departments.edit', compact('department', 'leaders'));
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());

        return redirect()->route('departments.index')
            ->with('success', __('app.messages.updated', ['item' => __('app.departments.title')]));
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', __('app.messages.deleted', ['item' => __('app.departments.title')]));
    }

    public function members(Department $department)
    {
        $department->load('members');

        $availableMembers = User::whereDoesntHave('departments', fn($q) => $q->where('departments.id', $department->id))
            ->where('is_active', true)
            ->orderBy('last_name')
            ->get();

        return view('structures.departments.members', compact('department', 'availableMembers'));
    }

    public function addMember(Request $request, Department $department)
    {
        $request->validate(['user_id' => 'required|exists:users,id']);

        $department->members()->syncWithoutDetaching([$request->user_id]);

        return back()->with('success', __('app.messages.updated', ['item' => __('app.departments.members_count')]));
    }

    public function removeMember(Department $department, User $user)
    {
        $department->members()->detach($user->id);

        return back()->with('success', __('app.messages.updated', ['item' => __('app.departments.members_count')]));
    }
}
