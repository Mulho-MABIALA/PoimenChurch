<x-public-layout>
    <x-slot name="title">Temoignages - Poimen Church</x-slot>
    <x-slot name="metaDescription">Decouvrez les temoignages inspirants de notre communaute. Des histoires de foi, de transformation et de grace.</x-slot>

    {{-- Hero Section --}}
    <section class="relative py-20 bg-gradient-to-br from-primary-800 via-primary-700 to-primary-900 overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 hero-pattern opacity-10"></div>
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 right-0 w-96 h-96 bg-gold-500/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-400/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            {{-- Breadcrumb --}}
            <nav class="flex justify-center mb-8" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="text-white/60 hover:text-white transition-colors">Accueil</a>
                    </li>
                    <li class="text-white/40">/</li>
                    <li class="text-white">Temoignages</li>
                </ol>
            </nav>

            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-md text-white rounded-full text-sm font-semibold mb-6 border border-white/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <span>Histoires de foi</span>
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6">
                Temoignages
            </h1>
            <p class="text-xl text-white/70 max-w-2xl mx-auto">
                Decouvrez les histoires inspirantes de ceux qui ont ete touches par la grace de Dieu dans notre eglise.
            </p>
        </div>
    </section>

    {{-- Testimonials Grid --}}
    <section class="py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($testimonials->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                <a href="{{ route('testimonials.show', $testimonial) }}"
                   class="group bg-white rounded-3xl border border-gray-100 shadow-lg hover:shadow-xl p-8 transition-all duration-300 hover:-translate-y-2 relative overflow-hidden">
                    {{-- Quote Icon --}}
                    <div class="absolute top-6 right-6 text-primary-100 group-hover:text-primary-200 transition-colors">
                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                    </div>

                    {{-- Rating --}}
                    <div class="flex items-center gap-1 mb-4">
                        @for($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-gold-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        @endfor
                    </div>

                    {{-- Content --}}
                    <p class="text-gray-600 leading-relaxed mb-6 line-clamp-4">
                        "{{ $testimonial->content }}"
                    </p>

                    {{-- Author --}}
                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <img src="{{ $testimonial->photo_url }}" alt="{{ $testimonial->author_name }}"
                             class="w-12 h-12 rounded-xl object-cover border-2 border-gray-100 group-hover:border-primary-200 transition-colors">
                        <div>
                            <h3 class="font-semibold text-gray-900 group-hover:text-primary-600 transition-colors">{{ $testimonial->author_name }}</h3>
                            @if($testimonial->author_role)
                            <p class="text-sm text-gray-500">{{ $testimonial->author_role }}</p>
                            @endif
                        </div>
                    </div>

                    {{-- Read More Arrow --}}
                    <div class="absolute bottom-6 right-6 w-10 h-10 bg-primary-50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-2 group-hover:translate-x-0">
                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($testimonials->hasPages())
            <div class="mt-12">
                {{ $testimonials->links() }}
            </div>
            @endif
            @else
            <div class="text-center py-16">
                <div class="w-20 h-20 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucun temoignage pour le moment</h3>
                <p class="text-gray-500">Les temoignages seront bientot disponibles.</p>
            </div>
            @endif
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-16 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">
                Vous avez un temoignage a partager ?
            </h2>
            <p class="text-white/80 mb-8">
                Votre histoire peut inspirer d'autres personnes. N'hesitez pas a nous contacter.
            </p>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-primary-700 font-semibold rounded-xl hover:bg-gold-50 transition-all duration-300 shadow-lg hover:-translate-y-1">
                Nous contacter
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </section>
</x-public-layout>
