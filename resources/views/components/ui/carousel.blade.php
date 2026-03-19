@props([
    'id' => 'carousel-' . uniqid(),
    'autoplay' => true,
    'interval' => 5000,
    'showArrows' => true,
    'showDots' => true,
    'showProgress' => true,
    'pauseOnHover' => true,
    'effect' => 'slide', // slide, fade, scale
])

<div
    x-data="{
        currentSlide: 0,
        totalSlides: 0,
        autoplay: {{ $autoplay ? 'true' : 'false' }},
        interval: {{ $interval }},
        isPaused: false,
        progress: 0,
        progressInterval: null,
        slideInterval: null,

        init() {
            this.totalSlides = this.$refs.track.children.length;
            if (this.autoplay) {
                this.startAutoplay();
            }
        },

        startAutoplay() {
            this.progress = 0;
            this.progressInterval = setInterval(() => {
                if (!this.isPaused) {
                    this.progress += 100 / (this.interval / 100);
                    if (this.progress >= 100) {
                        this.next();
                    }
                }
            }, 100);
        },

        stopAutoplay() {
            clearInterval(this.progressInterval);
            this.progress = 0;
        },

        next() {
            this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
            this.resetProgress();
        },

        prev() {
            this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
            this.resetProgress();
        },

        goTo(index) {
            this.currentSlide = index;
            this.resetProgress();
        },

        resetProgress() {
            this.progress = 0;
        },

        pause() {
            this.isPaused = true;
        },

        resume() {
            this.isPaused = false;
        }
    }"
    @if($pauseOnHover)
        @mouseenter="pause()"
        @mouseleave="resume()"
    @endif
    id="{{ $id }}"
    class="carousel-container relative group"
    {{ $attributes }}
>
    {{-- Slides Track --}}
    <div
        x-ref="track"
        class="carousel-track"
        :style="`transform: translateX(-${currentSlide * 100}%)`"
    >
        {{ $slot }}
    </div>

    {{-- Navigation Arrows --}}
    @if($showArrows)
        <button
            @click="prev()"
            class="carousel-nav carousel-prev opacity-0 group-hover:opacity-100 transition-opacity duration-300"
            aria-label="Previous slide"
        >
            <svg class="w-6 h-6 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        <button
            @click="next()"
            class="carousel-nav carousel-next opacity-0 group-hover:opacity-100 transition-opacity duration-300"
            aria-label="Next slide"
        >
            <svg class="w-6 h-6 text-zinc-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    @endif

    {{-- Dot Indicators --}}
    @if($showDots)
        <div class="carousel-indicators">
            <template x-for="(slide, index) in totalSlides" :key="index">
                <button
                    @click="goTo(index)"
                    :class="currentSlide === index ? 'active' : ''"
                    class="carousel-dot"
                    :aria-label="`Go to slide ${index + 1}`"
                ></button>
            </template>
        </div>
    @endif

    {{-- Progress Bar --}}
    @if($showProgress && $autoplay)
        <div class="carousel-progress">
            <div
                class="carousel-progress-bar"
                :style="`width: ${progress}%`"
            ></div>
        </div>
    @endif
</div>
