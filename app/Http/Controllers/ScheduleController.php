<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $schedules = Schedule::with('branch')
            ->when($request->search, function ($q, $search) {
                $q->where('title', 'like', "%{$search}%");
            })
            ->when($request->day, function ($q, $day) {
                $q->where('day_of_week', $day);
            })
            ->ordered()
            ->paginate(15)
            ->withQueryString();

        $days = Schedule::DAYS;

        return view('schedules.index', compact('schedules', 'days'));
    }

    public function create()
    {
        $days = Schedule::DAYS;
        $icons = Schedule::ICONS;
        $colors = Schedule::COLORS;
        $branches = Branch::where('is_active', true)->get();

        return view('schedules.create', compact('days', 'icons', 'colors', 'branches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'day_of_week' => 'required|in:' . implode(',', array_keys(Schedule::DAYS)),
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'location' => 'nullable|string|max:255',
            'icon' => 'nullable|in:' . implode(',', array_keys(Schedule::ICONS)),
            'icon_color' => 'nullable|in:' . implode(',', array_keys(Schedule::COLORS)),
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer|min:0',
            'branch_id' => 'nullable|exists:branches,id',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order'] = $validated['order'] ?? 0;

        Schedule::create($validated);

        return redirect()->route('admin.schedules.index')
            ->with('success', 'L\'horaire a été créé avec succès.');
    }

    public function edit(Schedule $schedule)
    {
        $days = Schedule::DAYS;
        $icons = Schedule::ICONS;
        $colors = Schedule::COLORS;
        $branches = Branch::where('is_active', true)->get();

        return view('schedules.edit', compact('schedule', 'days', 'icons', 'colors', 'branches'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'day_of_week' => 'required|in:' . implode(',', array_keys(Schedule::DAYS)),
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'location' => 'nullable|string|max:255',
            'icon' => 'nullable|in:' . implode(',', array_keys(Schedule::ICONS)),
            'icon_color' => 'nullable|in:' . implode(',', array_keys(Schedule::COLORS)),
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer|min:0',
            'branch_id' => 'nullable|exists:branches,id',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $schedule->update($validated);

        return redirect()->route('admin.schedules.index')
            ->with('success', 'L\'horaire a été mis à jour avec succès.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('admin.schedules.index')
            ->with('success', 'L\'horaire a été supprimé avec succès.');
    }

    public function toggleActive(Schedule $schedule)
    {
        $schedule->update(['is_active' => !$schedule->is_active]);

        $status = $schedule->is_active ? 'activé' : 'désactivé';
        return back()->with('success', "L'horaire a été {$status} avec succès.");
    }
}
