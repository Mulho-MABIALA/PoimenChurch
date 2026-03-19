@props([
    'value' => '0',
    'label' => '',
    'suffix' => '+',
    'icon' => null,
    'animated' => true,
    'dark' => false,
])

<div class="stat-modern group">
    @if($icon)
        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4 mx-auto transition-transform group-hover:scale-110
            {{ $dark ? 'bg-white/10' : 'bg-primary-100' }}">
            <svg class="w-6 h-6 {{ $dark ? 'text-white' : 'text-primary-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {!! $icon !!}
            </svg>
        </div>
    @endif

    <div class="stat-number {{ $animated ? 'counter' : '' }}"
         @if($animated) data-target="{{ preg_replace('/[^0-9]/', '', $value) }}" @endif>
        @if($animated)
            0{{ $suffix }}
        @else
            {{ $value }}{{ $suffix }}
        @endif
    </div>

    <div class="stat-label {{ $dark ? 'text-white/70' : '' }}">
        {{ $label }}
    </div>
</div>
