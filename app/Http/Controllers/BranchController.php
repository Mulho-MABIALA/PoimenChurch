<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        $branches = Branch::with(['leader', 'assistantLeader', 'zones'])
            ->withCount(['zones', 'members'])
            ->when($request->search, function ($q, $search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            })
            ->when($request->status !== null, function ($q) use ($request) {
                $q->where('is_active', $request->status === 'active');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('structures.branches.index', compact('branches'));
    }

    public function create()
    {
        $leaders = User::whereHas('roles', fn($q) => $q->whereIn('name', ['bishop', 'reverend', 'pastor_assistant']))
            ->where('is_active', true)
            ->get();

        return view('structures.branches.create', compact('leaders'));
    }

    public function store(BranchRequest $request)
    {
        Branch::create($request->validated());

        return redirect()->route('branches.index')
            ->with('success', __('app.messages.created', ['item' => __('app.branches.title')]));
    }

    public function show(Branch $branch)
    {
        $branch->load(['leader', 'assistantLeader', 'zones.leader', 'zones.bacentas']);

        $stats = [
            'total_zones' => $branch->zones->count(),
            'total_bacentas' => $branch->bacentas->count(),
            'total_members' => $branch->total_members_count,
            'weekly_attendance' => $branch->getWeeklyAttendance('sunday_service', now()->startOfWeek(), now()->endOfWeek()),
            'weekly_offerings' => $branch->getWeeklyOfferings(now()->startOfWeek(), now()->endOfWeek()),
        ];

        return view('structures.branches.show', compact('branch', 'stats'));
    }

    public function edit(Branch $branch)
    {
        $leaders = User::whereHas('roles', fn($q) => $q->whereIn('name', ['bishop', 'reverend', 'pastor_assistant']))
            ->where('is_active', true)
            ->get();

        return view('structures.branches.edit', compact('branch', 'leaders'));
    }

    public function update(BranchRequest $request, Branch $branch)
    {
        $branch->update($request->validated());

        return redirect()->route('branches.index')
            ->with('success', __('app.messages.updated', ['item' => __('app.branches.title')]));
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();

        return redirect()->route('branches.index')
            ->with('success', __('app.messages.deleted', ['item' => __('app.branches.title')]));
    }
}
