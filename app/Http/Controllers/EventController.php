<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Branch;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with(['creator', 'branch'])
            ->when($request->search, function ($q, $search) {
                $q->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                          ->orWhere('description', 'like', "%{$search}%")
                          ->orWhere('location', 'like', "%{$search}%");
                });
            })
            ->when($request->type, function ($q, $type) {
                $q->ofType($type);
            })
            ->when($request->status, function ($q, $status) {
                if ($status === 'published') {
                    $q->published();
                } elseif ($status === 'draft') {
                    $q->where('is_published', false);
                } elseif ($status === 'upcoming') {
                    $q->upcoming();
                } elseif ($status === 'past') {
                    $q->past();
                }
            })
            ->orderByDate('desc')
            ->paginate(15)
            ->withQueryString();

        $events = $query;
        $types = Event::TYPES;

        return view('events.index', compact('events', 'types'));
    }

    public function create()
    {
        $types = Event::TYPES;
        $branches = Branch::where('is_active', true)->get();

        return view('events.create', compact('types', 'branches'));
    }

    public function store(EventRequest $request)
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $data['created_by'] = Auth::id();

        Event::create($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'L\'événement a été créé avec succès.');
    }

    public function show(Event $event)
    {
        $event->load(['creator', 'branch']);

        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $types = Event::TYPES;
        $branches = Branch::where('is_active', true)->get();

        return view('events.edit', compact('event', 'types', 'branches'));
    }

    public function update(EventRequest $request, Event $event)
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'L\'événement a été mis à jour avec succès.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'L\'événement a été archivé avec succès.');
    }

    public function archived(Request $request)
    {
        $events = Event::onlyTrashed()
            ->with(['creator', 'branch'])
            ->when($request->search, function ($q, $search) {
                $q->where('title', 'like', "%{$search}%");
            })
            ->orderByDate('desc')
            ->paginate(15)
            ->withQueryString();

        return view('events.archived', compact('events'));
    }

    public function restore($id)
    {
        $event = Event::withTrashed()->findOrFail($id);
        $event->restore();

        return redirect()->route('admin.events.index')
            ->with('success', 'L\'événement a été restauré avec succès.');
    }

    public function togglePublish(Event $event)
    {
        $event->update(['is_published' => !$event->is_published]);

        $status = $event->is_published ? 'publié' : 'dépublié';
        return back()->with('success', "L'événement a été {$status} avec succès.");
    }

    public function toggleFeatured(Event $event)
    {
        $event->update(['is_featured' => !$event->is_featured]);

        $status = $event->is_featured ? 'mis en avant' : 'retiré de la une';
        return back()->with('success', "L'événement a été {$status} avec succès.");
    }
}
