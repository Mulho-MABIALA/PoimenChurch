@props([
    'badge' => null,
    'badgeIcon' => null,
    'title' => '',
    'subtitle' => null,
    'align' => 'center',
    'dark' => false,
])

@php
    $alignClasses = [
        'left' => 'text-left',
        'center' => 'text-center mx-auto',
        'right' => 'text-right ml-auto',
    ];

    $alignment = $alignClasses[$align] ?? $alignClasses['center'];
@endphp

<div class="max-w-3xl {{ $alignment }} animate-slide-up" data-animate>
    @if($badge)
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold mb-6
            {{ $dark ? 'bg-white/10 text-white/90 border border-white/20' : 'bg-primary-50 text-primary-700' }}">
            @if($badgeIcon)
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $badgeIcon !!}
                </svg>
            @endif
            <span>{{ $badge }}</span>
        </div>
    @endif

    <h2 class="section-title mb-4 {{ $dark ? 'text-white' : 'text-zinc-900' }}">
        {!! $title !!}
    </h2>

    @if($subtitle)
        <p class="section-subtitle {{ $align === 'center' ? 'mx-auto' : '' }} {{ $dark ? 'text-white/70' : 'text-zinc-600' }}">
            {{ $subtitle }}
        </p>
    @endif

    {{ $slot }}
</div>
