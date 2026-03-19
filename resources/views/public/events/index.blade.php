<x-public-layout>
    <x-slot name="title">Evenements - Poimen Church</x-slot>
    <x-slot name="metaDescription">Decouvrez les evenements a venir de Poimen Church. Conferences, retraites, concerts et plus encore.</x-slot>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-800 to-primary-900 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Nos Evenements</h1>
                <p class="text-xl text-primary-100">Rejoignez-nous pour des moments inoubliables</p>
            </div>
        </div>
    </section>

    <!-- Events Grid -->
    <section class="py-16 bg-background">
        <div class="container mx-auto px-4">
            <!-- Filters -->
            <div class="mb-8">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <h2 class="text-2xl font-bold text-primary-800">Evenements a venir</h2>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('events') }}"
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ !request('type') ? 'bg-primary-700 text-white' : 'bg-white text-gray-600 hover:bg-gray-100' }}">
                            Tous
                        </a>
                        @foreach($types as $key => $label)
                            <a href="{{ route('events', ['type' => $key]) }}"
                               class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request('type') === $key ? 'bg-primary-700 text-white' : 'bg-white text-gray-600 hover:bg-gray-100' }}">
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            @if($events->isEmpty())
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Aucun evenement a venir</h3>
                    <p class="text-gray-600">Revenez bientot pour decouvrir nos prochains evenements.</p>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($events as $event)
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
                            $gradient = $gradients[$event->type] ?? 'from-primary-600 to-primary-800';

                            $badgeColors = [
                                'retraite' => 'bg-primary-700',
                                'formation' => 'bg-primary-700',
                            ];
                            $badgeColor = $badgeColors[$event->type] ?? 'bg-gold-500';
                        @endphp

                        <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            <div class="relative h-48 bg-gradient-to-br {{ $gradient }}">
                                @if($event->image)
                                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}"
                                         class="w-full h-full object-cover opacity-90">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                @endif
                                <div class="absolute top-4 left-4 {{ $badgeColor }} text-white px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $event->type_label }}
                                </div>
                                @if($event->is_featured)
                                    <div class="absolute top-4 right-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                        En vedette
                                    </div>
                                @endif
                                <div class="absolute bottom-4 left-4 text-white">
                                    <div class="text-3xl font-bold">{{ $event->start_date->format('d') }}</div>
                                    <div class="text-sm uppercase">{{ $event->start_date->translatedFormat('F') }}</div>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-primary-800 mb-2">{{ $event->title }}</h3>
                                @if($event->description)
                                    <p class="text-gray-600 mb-4 line-clamp-2">
                                        {{ $event->description }}
                                    </p>
                                @endif
                                <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $event->formatted_time }}
                                    </div>
                                    @if($event->location)
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            {{ $event->location }}
                                        </div>
                                    @endif
                                </div>
                                <a href="{{ route('events.show', $event->slug) }}"
                                    class="inline-flex items-center gap-2 text-primary-700 font-medium hover:text-primary-800">
                                    En savoir plus
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($events->hasPages())
                    <div class="flex justify-center">
                        {{ $events->links() }}
                    </div>
                @endif
            @endif

            <!-- Subscribe CTA -->
            <div class="bg-white rounded-2xl shadow-lg p-8 max-w-3xl mx-auto text-center mt-16">
                <h3 class="text-2xl font-bold text-primary-800 mb-4">Restez informe</h3>
                <p class="text-gray-600 mb-6">
                    Inscrivez-vous pour recevoir les informations sur nos prochains evenements.
                </p>
                <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                    <input type="email" placeholder="Votre adresse email"
                        class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <button type="submit"
                        class="px-6 py-3 bg-primary-700 hover:bg-primary-800 text-white font-semibold rounded-lg transition-colors">
                        S'inscrire
                    </button>
                </form>
            </div>
        </div>
    </section>
</x-public-layout>
