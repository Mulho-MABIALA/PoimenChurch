<x-public-layout>
    <x-slot name="title">{{ $event->title }} - Poimen Church</x-slot>
    <x-slot name="metaDescription">{{ $event->description ?? $event->title }}</x-slot>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-800 to-primary-900 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <span class="inline-block bg-gold-500 text-white px-4 py-1 rounded-full text-sm font-semibold mb-4">{{ $event->type_label }}</span>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $event->title }}</h1>
                <p class="text-xl text-primary-100">{{ $event->formatted_date }}</p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-4 py-4">
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary-700">Accueil</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('events') }}" class="text-gray-500 hover:text-primary-700">Evenements</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-primary-700 font-medium">{{ $event->title }}</span>
            </nav>
        </div>
    </div>

    <!-- Event Details -->
    <section class="py-16 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="grid lg:grid-cols-3 gap-12">
                    <!-- Main Content -->
                    <div class="lg:col-span-2">
                        <!-- Event Image -->
                        @if($event->image)
                            <div class="rounded-2xl h-80 mb-8 overflow-hidden">
                                <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}"
                                     class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl h-80 mb-8 flex items-center justify-center">
                                <svg class="w-24 h-24 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif

                        <div class="bg-white rounded-2xl shadow-lg p-8">
                            <h2 class="text-2xl font-bold text-primary-800 mb-6">A propos de cet evenement</h2>

                            <div class="prose prose-lg max-w-none text-gray-600">
                                @if($event->description)
                                    <p class="text-lg font-medium text-gray-700 mb-4">{{ $event->description }}</p>
                                @endif

                                @if($event->content)
                                    {!! nl2br(e($event->content)) !!}
                                @else
                                    <p>Plus d'informations seront bientot disponibles pour cet evenement.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-32">
                            <h3 class="text-lg font-bold text-primary-800 mb-6">Informations</h3>

                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm">Date</h4>
                                        <p class="text-gray-600">{{ $event->formatted_date }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm">Horaires</h4>
                                        <p class="text-gray-600">{{ $event->formatted_time }}</p>
                                    </div>
                                </div>

                                @if($event->location || $event->address)
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm">Lieu</h4>
                                        <p class="text-gray-600">
                                            @if($event->location){{ $event->location }}@endif
                                            @if($event->location && $event->address)<br>@endif
                                            @if($event->address){{ $event->address }}@endif
                                            @if($event->city)<br>{{ $event->city }}@endif
                                        </p>
                                    </div>
                                </div>
                                @endif

                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm">Inscription</h4>
                                        <p class="text-gray-600">
                                            @if($event->registration_fee)
                                                {{ number_format($event->registration_fee, 0, ',', ' ') }} FCFA
                                            @else
                                                Gratuit
                                            @endif
                                            @if($event->registration_required)
                                                <span class="block text-sm text-primary-600">(Inscription obligatoire)</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                @if($event->max_participants)
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 text-sm">Places</h4>
                                        <p class="text-gray-600">{{ $event->max_participants }} places maximum</p>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="mt-8 pt-6 border-t border-gray-100">
                                @if($event->registration_required)
                                    <a href="{{ route('contact') }}"
                                        class="w-full inline-flex items-center justify-center gap-2 bg-primary-700 hover:bg-primary-800 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                                        S'inscrire
                                    </a>
                                @endif

                                <div class="mt-4 flex gap-2">
                                    <button onclick="navigator.share ? navigator.share({title: '{{ $event->title }}', url: window.location.href}) : null"
                                            class="flex-1 py-2 px-4 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 text-sm">
                                        Partager
                                    </button>
                                    <a href="https://www.google.com/calendar/render?action=TEMPLATE&text={{ urlencode($event->title) }}&dates={{ $event->start_date->format('Ymd\THis') }}/{{ ($event->end_date ?? $event->start_date)->format('Ymd\THis') }}&details={{ urlencode($event->description ?? '') }}&location={{ urlencode($event->location ?? '') }}"
                                       target="_blank"
                                       class="flex-1 py-2 px-4 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 text-sm text-center">
                                        Calendrier
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Events -->
    @if($relatedEvents->isNotEmpty())
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-primary-800 mb-8 text-center">Autres evenements</h2>

            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                @foreach($relatedEvents as $relatedEvent)
                    @php
                        $gradients = [
                            'culte' => 'from-primary-600 to-primary-800',
                            'conference' => 'from-primary-600 to-primary-800',
                            'seminaire' => 'from-blue-600 to-blue-800',
                            'retraite' => 'from-gold-500 to-gold-600',
                            'concert' => 'from-purple-600 to-purple-800',
                            'formation' => 'from-green-600 to-green-800',
                            'autre' => 'from-red-600 to-red-800',
                        ];
                        $gradient = $gradients[$relatedEvent->type] ?? 'from-primary-600 to-primary-800';
                    @endphp

                    <a href="{{ route('events.show', $relatedEvent->slug) }}"
                       class="bg-background rounded-2xl overflow-hidden hover:shadow-lg transition-shadow block">
                        @if($relatedEvent->image)
                            <div class="h-32 overflow-hidden">
                                <img src="{{ Storage::url($relatedEvent->image) }}" alt="{{ $relatedEvent->title }}"
                                     class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="h-32 bg-gradient-to-br {{ $gradient }}"></div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-bold text-primary-800 mb-1">{{ $relatedEvent->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $relatedEvent->formatted_date }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</x-public-layout>
