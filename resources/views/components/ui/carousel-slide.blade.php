@props([
    'image' => null,
    'overlay' => true,
    'overlayGradient' => 'from-primary-900/90 via-primary-900/70 to-primary-800/80',
])

<div class="carousel-slide min-h-[600px] lg:min-h-[700px] relative">
    {{-- Background Image --}}
    @if($image)
        <div class="absolute inset-0">
            <img
                src="{{ $image }}"
                alt=""
                class="w-full h-full object-cover"
                loading="lazy"
            >
        </div>
    @endif

    {{-- Overlay --}}
    @if($overlay)
        <div class="absolute inset-0 bg-gradient-to-br {{ $overlayGradient }}"></div>
        <div class="absolute inset-0 hero-pattern opacity-20"></div>
    @endif

    {{-- Content --}}
    <div class="carousel-slide-content relative h-full min-h-[600px] lg:min-h-[700px] flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-20">
            {{ $slot }}
        </div>
    </div>
</div>
