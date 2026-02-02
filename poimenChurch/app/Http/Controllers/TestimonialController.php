<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $testimonials = Testimonial::query()
            ->when($request->search, function ($q, $search) {
                $q->where('author_name', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            })
            ->when($request->has('featured'), function ($q) use ($request) {
                $q->where('is_featured', $request->boolean('featured'));
            })
            ->when($request->has('active'), function ($q) use ($request) {
                $q->where('is_active', $request->boolean('active'));
            })
            ->ordered()
            ->paginate(10)
            ->withQueryString();

        return view('testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author_name' => 'required|string|max:255',
            'author_role' => 'nullable|string|max:255',
            'author_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'content' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
            'testimonial_date' => 'nullable|date',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['display_order'] = $validated['display_order'] ?? 0;

        if ($request->hasFile('author_photo')) {
            $validated['author_photo'] = $request->file('author_photo')
                ->store('testimonials', 'public');
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Le témoignage a été créé avec succès.');
    }

    public function show(Testimonial $testimonial)
    {
        return view('testimonials.show', compact('testimonial'));
    }

    public function edit(Testimonial $testimonial)
    {
        return view('testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'author_name' => 'required|string|max:255',
            'author_role' => 'nullable|string|max:255',
            'author_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'content' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
            'testimonial_date' => 'nullable|date',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['display_order'] = $validated['display_order'] ?? 0;

        if ($request->hasFile('author_photo')) {
            // Delete old photo if exists
            if ($testimonial->author_photo) {
                Storage::disk('public')->delete($testimonial->author_photo);
            }
            $validated['author_photo'] = $request->file('author_photo')
                ->store('testimonials', 'public');
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Le témoignage a été mis à jour avec succès.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->author_photo) {
            Storage::disk('public')->delete($testimonial->author_photo);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Le témoignage a été supprimé avec succès.');
    }

    public function toggleActive(Testimonial $testimonial)
    {
        $testimonial->update(['is_active' => !$testimonial->is_active]);

        $status = $testimonial->is_active ? 'activé' : 'désactivé';
        return back()->with('success', "Le témoignage a été {$status} avec succès.");
    }

    public function toggleFeatured(Testimonial $testimonial)
    {
        $testimonial->update(['is_featured' => !$testimonial->is_featured]);

        $status = $testimonial->is_featured ? 'mis en avant' : 'retiré de la mise en avant';
        return back()->with('success', "Le témoignage a été {$status} avec succès.");
    }
}
