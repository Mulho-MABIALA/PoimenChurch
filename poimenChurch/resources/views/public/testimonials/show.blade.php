<x-public-layout>
    <x-slot name="title">Temoignage de {{ $testimonial->author_name }} - Poimen Church</x-slot>
    <x-slot name="metaDescription">{{ Str::limit($testimonial->content, 160) }}</x-slot>

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
                    <li>
                        <a href="{{ route('testimonials') }}" class="text-white/60 hover:text-white transition-colors">Temoignages</a>
                    </li>
                    <li class="text-white/40">/</li>
                    <li class="text-white">{{ $testimonial->author_name }}</li>
                </ol>
            </nav>

            {{-- Quote Icon --}}
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white/10 backdrop-blur-sm rounded-2xl mb-8">
                <svg class="w-10 h-10 text-gold-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                </svg>
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">
                Temoignage
            </h1>
            <p class="text-xl text-white/70">
                Une histoire de foi et de transformation
            </p>
        </div>
    </section>

    {{-- Testimonial Content --}}
    <section class="py-16 lg:py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                {{-- Author Header --}}
                <div class="bg-gradient-to-r from-primary-50 to-gold-50 p-8 border-b border-gray-100">
                    <div class="flex flex-col sm:flex-row items-center gap-6">
                        <img src="{{ $testimonial->photo_url }}" alt="{{ $testimonial->author_name }}"
                             class="w-24 h-24 rounded-2xl object-cover border-4 border-white shadow-lg">
                        <div class="text-center sm:text-left">
                            <h2 class="text-2xl font-bold text-gray-900">{{ $testimonial->author_name }}</h2>
                            @if($testimonial->author_role)
                            <p class="text-gray-600 mt-1">{{ $testimonial->author_role }}</p>
                            @endif
                            {{-- Rating --}}
                            <div class="flex items-center justify-center sm:justify-start gap-1 mt-3">
                                @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-gold-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-8 lg:p-12">
                    <div class="relative">
                        {{-- Quote marks --}}
                        <svg class="absolute -top-4 -left-2 w-12 h-12 text-primary-100" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>

                        <blockquote class="relative z-10 text-xl lg:text-2xl text-gray-700 leading-relaxed pl-8">
                            {{ $testimonial->content }}
                        </blockquote>
                    </div>

                    @if($testimonial->testimonial_date)
                    <p class="text-gray-400 text-sm mt-8 text-right">
                        {{ $testimonial->testimonial_date->format('d F Y') }}
                    </p>
                    @endif
                </div>
            </div>

            {{-- Back Link --}}
            <div class="mt-8 text-center">
                <a href="{{ route('testimonials') }}" class="inline-flex items-center gap-2 text-primary-600 hover:text-primary-700 font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Voir tous les temoignages
                </a>
            </div>
        </div>
    </section>

    {{-- Other Testimonials --}}
    @if($otherTestimonials->count() > 0)
    <section class="py-16 bg-zinc-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-2xl font-bold text-gray-900 text-center mb-12">Autres temoignages</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($otherTestimonials as $other)
                <a href="{{ route('testimonials.show', $other) }}"
                   class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg p-6 transition-all duration-300 hover:-translate-y-1">
                    {{-- Rating --}}
                    <div class="flex items-center gap-1 mb-3">
                        @for($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 {{ $i <= $other->rating ? 'text-gold-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        @endfor
                    </div>

                    {{-- Content --}}
                    <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-4">
                        "{{ $other->short_content }}"
                    </p>

                    {{-- Author --}}
                    <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                        <img src="{{ $other->photo_url }}" alt="{{ $other->author_name }}"
                             class="w-10 h-10 rounded-lg object-cover">
                        <div>
                            <p class="font-medium text-gray-900 text-sm">{{ $other->author_name }}</p>
                            @if($other->author_role)
                            <p class="text-xs text-gray-500">{{ $other->author_role }}</p>
                            @endif
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</x-public-layout>
