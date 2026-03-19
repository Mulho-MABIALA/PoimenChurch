@props([
    'icon' => null,
    'iconBg' => 'bg-primary-100',
    'iconColor' => 'text-primary-600',
    'title' => '',
    'description' => '',
    'href' => null,
    'gradient' => false,
    'gradientFrom' => 'from-primary-500',
    'gradientTo' => 'to-primary-600',
])

@php
    $cardClasses = $gradient
        ? "relative bg-gradient-to-br {$gradientFrom} {$gradientTo} rounded-2xl p-8 text-white overflow-hidden group card-hover-lift"
        : "feature-card group";
@endphp

@if($href)
<a href="{{ $href }}" class="{{ $cardClasses }}">
@else
<div class="{{ $cardClasses }}">
@endif
    @if($gradient)
        {{-- Gradient card decorations --}}
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300"></div>
        <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-white/10 rounded-full"></div>
        <div class="absolute top-0 right-0 w-24 h-24 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    @endif

    <div class="relative">
        {{-- Icon --}}
        @if($icon)
            <div class="feature-icon {{ $gradient ? 'bg-white/20 backdrop-blur-sm' : $iconBg }}">
                <svg class="w-6 h-6 {{ $gradient ? 'text-white' : $iconColor }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $icon !!}
                </svg>
            </div>
        @endif

        {{-- Title --}}
        <h3 class="text-xl font-semibold mb-3 {{ $gradient ? 'text-white' : 'text-zinc-900' }}">
            {{ $title }}
        </h3>

        {{-- Description --}}
        <p class="leading-relaxed {{ $gradient ? 'text-white/80' : 'text-zinc-600' }}">
            {{ $description }}
        </p>

        {{-- Slot for additional content --}}
        {{ $slot }}

        {{-- Arrow for links --}}
        @if($href)
            <div class="mt-4 inline-flex items-center text-sm font-medium {{ $gradient ? 'text-white' : 'text-primary-600' }} group-hover:translate-x-1 transition-transform duration-300">
                <span>En savoir plus</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        @endif
    </div>

@if($href)
</a>
@else
</div>
@endif
