@props([
    'quote' => '',
    'author' => '',
    'role' => '',
    'avatar' => null,
    'rating' => 5,
])

<div class="testimonial-card">
    {{-- Rating Stars --}}
    @if($rating > 0)
        <div class="flex gap-1 mb-4">
            @for($i = 0; $i < $rating; $i++)
                <svg class="w-5 h-5 text-gold-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            @endfor
        </div>
    @endif

    {{-- Quote --}}
    <div class="testimonial-quote mb-6">
        <p class="text-lg text-zinc-700 leading-relaxed pl-4">
            {{ $quote }}
        </p>
    </div>

    {{-- Author --}}
    <div class="flex items-center gap-4 pt-4 border-t border-zinc-100">
        @if($avatar)
            <img src="{{ $avatar }}" alt="{{ $author }}" class="w-12 h-12 rounded-full object-cover ring-2 ring-primary-100">
        @else
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white font-semibold text-lg">
                {{ substr($author, 0, 1) }}
            </div>
        @endif
        <div>
            <p class="font-semibold text-zinc-900">{{ $author }}</p>
            @if($role)
                <p class="text-sm text-zinc-500">{{ $role }}</p>
            @endif
        </div>
    </div>
</div>
