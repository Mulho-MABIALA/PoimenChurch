<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Schedule;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    /**
     * Display the home page.
     */
    public function home(): View
    {
        $schedules = Schedule::active()->featured()->ordered()->get();
        $testimonials = Testimonial::active()->featured()->ordered()->take(6)->get();

        return view('public.home', compact('schedules', 'testimonials'));
    }

    /**
     * Display the history page.
     */
    public function history(): View
    {
        return view('public.about.history');
    }

    /**
     * Display the vision & mission page.
     */
    public function vision(): View
    {
        return view('public.about.vision');
    }

    /**
     * Display the leadership page.
     */
    public function leadership(): View
    {
        return view('public.about.leadership');
    }

    /**
     * Display the beliefs page.
     */
    public function beliefs(): View
    {
        return view('public.about.beliefs');
    }

    /**
     * Display the worship ministry page.
     */
    public function ministryWorship(): View
    {
        return view('public.ministries.worship');
    }

    /**
     * Display the youth ministry page.
     */
    public function ministryYouth(): View
    {
        return view('public.ministries.youth');
    }

    /**
     * Display the children ministry page.
     */
    public function ministryChildren(): View
    {
        return view('public.ministries.children');
    }

    /**
     * Display the women ministry page.
     */
    public function ministryWomen(): View
    {
        return view('public.ministries.women');
    }

    /**
     * Display the men ministry page.
     */
    public function ministryMen(): View
    {
        return view('public.ministries.men');
    }

    /**
     * Display all testimonials.
     */
    public function testimonials(): View
    {
        $testimonials = Testimonial::active()->ordered()->paginate(12);

        return view('public.testimonials.index', compact('testimonials'));
    }

    /**
     * Display a single testimonial.
     */
    public function testimonialShow(Testimonial $testimonial): View
    {
        if (!$testimonial->is_active) {
            abort(404);
        }

        $otherTestimonials = Testimonial::active()
            ->where('id', '!=', $testimonial->id)
            ->ordered()
            ->take(3)
            ->get();

        return view('public.testimonials.show', compact('testimonial', 'otherTestimonials'));
    }

    /**
     * Display the events listing page.
     */
    public function events(Request $request): View
    {
        $query = Event::published()->orderByDate('asc');

        // Filter by type if provided
        if ($request->filled('type')) {
            $query->ofType($request->type);
        }

        // Get upcoming events by default, or all if requested
        if (!$request->filled('show_past')) {
            $query->upcoming();
        }

        $events = $query->paginate(12)->withQueryString();
        $types = Event::TYPES;
        $featuredEvents = Event::published()->featured()->upcoming()->orderByDate('asc')->take(3)->get();

        return view('public.events.index', compact('events', 'types', 'featuredEvents'));
    }

    /**
     * Display a single event.
     */
    public function eventShow(string $slug): View
    {
        $event = Event::published()->where('slug', $slug)->firstOrFail();

        // Get related events (same type, excluding current)
        $relatedEvents = Event::published()
            ->upcoming()
            ->where('id', '!=', $event->id)
            ->where('type', $event->type)
            ->orderByDate('asc')
            ->take(3)
            ->get();

        // If not enough related events of same type, get other upcoming events
        if ($relatedEvents->count() < 3) {
            $moreEvents = Event::published()
                ->upcoming()
                ->where('id', '!=', $event->id)
                ->whereNotIn('id', $relatedEvents->pluck('id'))
                ->orderByDate('asc')
                ->take(3 - $relatedEvents->count())
                ->get();

            $relatedEvents = $relatedEvents->merge($moreEvents);
        }

        return view('public.events.show', compact('event', 'relatedEvents'));
    }

    /**
     * Display the sermons listing page.
     */
    public function sermons(): View
    {
        return view('public.sermons.index');
    }

    /**
     * Display a single sermon.
     */
    public function sermonShow(string $slug): View
    {
        return view('public.sermons.show', ['slug' => $slug]);
    }

    /**
     * Display the give/donate page.
     */
    public function give(): View
    {
        return view('public.give');
    }

    /**
     * Display the contact page.
     */
    public function contact(): View
    {
        return view('public.contact');
    }

    /**
     * Handle contact form submission.
     */
    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // TODO: Send email notification or store in database

        return back()->with('success', 'Votre message a ete envoye avec succes. Nous vous repondrons dans les plus brefs delais.');
    }

    /**
     * Display the privacy policy page.
     */
    public function privacy(): View
    {
        return view('public.privacy');
    }

    /**
     * Display the terms of use page.
     */
    public function terms(): View
    {
        return view('public.terms');
    }
}
