<x-public-layout>
    <x-slot name="title">Accueil - Poimen Church</x-slot>
    <x-slot name="metaDescription">Poimen Church - Une communaute de foi, d'amour et de croissance spirituelle. Rejoignez-nous pour vivre une experience spirituelle transformatrice.</x-slot>

    {{-- ============================================
         HERO CAROUSEL - Spectacular "WOW" Effect
         ============================================ --}}
    <section class="relative" x-data="{
        currentSlide: 0,
        totalSlides: 3,
        autoplay: true,
        interval: 6000,
        isPaused: false,
        progress: 0,
        touchStartX: 0,
        touchEndX: 0,

        init() {
            this.startAutoplay();
        },

        startAutoplay() {
            setInterval(() => {
                if (!this.isPaused) {
                    this.progress += 100 / (this.interval / 100);
                    if (this.progress >= 100) {
                        this.next();
                    }
                }
            }, 100);
        },

        next() {
            this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
            this.progress = 0;
        },

        prev() {
            this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
            this.progress = 0;
        },

        goTo(index) {
            this.currentSlide = index;
            this.progress = 0;
        },

        handleTouchStart(e) {
            this.touchStartX = e.changedTouches[0].screenX;
        },

        handleTouchEnd(e) {
            this.touchEndX = e.changedTouches[0].screenX;
            const diff = this.touchStartX - this.touchEndX;
            if (Math.abs(diff) > 50) {
                if (diff > 0) { this.next(); } else { this.prev(); }
            }
        }
    }" @mouseenter="isPaused = true" @mouseleave="isPaused = false">

        {{-- Slides Container --}}
        <div class="relative overflow-hidden group"
             @touchstart="handleTouchStart($event)"
             @touchend="handleTouchEnd($event)">
            <div class="flex transition-transform duration-1000 ease-out" :style="`transform: translateX(-${currentSlide * 100}%)`">

                {{-- Slide 1 - Welcome --}}
                <div class="w-full flex-shrink-0 min-h-[100svh] sm:min-h-[calc(100vh-116px)] relative flex items-center">
                    {{-- Background --}}
                    <div class="absolute inset-0">
                        <img src="https://images.unsplash.com/photo-1438232992991-995b7058bbb3?auto=format&fit=crop&w=2070&q=80"
                             alt="" class="w-full h-full object-cover scale-105 animate-slow-zoom">
                        <div class="absolute inset-0 bg-gradient-to-br from-primary-900/95 via-primary-800/90 to-primary-900/85"></div>
                        <div class="absolute inset-0 hero-pattern opacity-30"></div>
                    </div>

                    {{-- Floating Elements --}}
                    <div class="absolute inset-0 overflow-hidden pointer-events-none hidden sm:block">
                        <div class="absolute top-1/4 left-10 w-72 h-72 bg-gold-400/20 rounded-full blur-3xl animate-float"></div>
                        <div class="absolute bottom-1/4 right-10 w-96 h-96 bg-primary-400/15 rounded-full blur-3xl animate-float-delayed"></div>
                        <div class="absolute top-1/2 left-1/3 w-48 h-48 bg-white/5 rounded-full blur-2xl animate-pulse"></div>
                    </div>

                    {{-- Content --}}
                    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-8 sm:py-16 lg:py-20">
                        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                            {{-- Left Content --}}
                            <div class="space-y-5 sm:space-y-8" x-show="currentSlide === 0" x-transition:enter="transition ease-out duration-700 delay-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                                {{-- Badge --}}
                                <div class="inline-flex items-center gap-2 sm:gap-3 px-3 sm:px-5 py-2 sm:py-2.5 bg-white/10 backdrop-blur-md rounded-full border border-white/20">
                                    <span class="relative flex h-2 w-2 sm:h-2.5 sm:w-2.5">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-gold-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 sm:h-2.5 sm:w-2.5 bg-gold-400"></span>
                                    </span>
                                    <span class="text-white/90 text-xs sm:text-sm font-medium">Bienvenue a Poimen Church</span>
                                </div>

                                {{-- Title --}}
                                <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold text-white leading-tight">
                                    Une communaute de
                                    <span class="relative inline-block">
                                        <span class="text-gradient-gold">foi</span>
                                        <svg class="absolute -bottom-1 sm:-bottom-2 left-0 w-full" viewBox="0 0 200 12" fill="none">
                                            <path d="M2 10C50 2 150 2 198 10" stroke="url(#gold-grad)" stroke-width="3" stroke-linecap="round"/>
                                            <defs>
                                                <linearGradient id="gold-grad" x1="0" y1="0" x2="200" y2="0">
                                                    <stop offset="0%" stop-color="#fbbf24"/>
                                                    <stop offset="100%" stop-color="#f59e0b"/>
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </span>
                                    et d'<span class="text-gold-400">amour</span>
                                </h1>

                                {{-- Description --}}
                                <p class="text-base sm:text-lg lg:text-xl text-white/70 leading-relaxed max-w-xl">
                                    Rejoignez-nous chaque dimanche pour vivre une experience spirituelle transformatrice. Ensemble, grandissons dans la grace et l'amour de Christ.
                                </p>

                                {{-- CTA Buttons --}}
                                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-2 sm:pt-4">
                                    <a href="{{ route('about.vision') }}" class="group inline-flex items-center justify-center px-6 sm:px-8 py-3.5 sm:py-4 bg-gold-500 hover:bg-gold-400 text-white font-semibold rounded-xl sm:rounded-2xl transition-all duration-300 shadow-lg shadow-gold-500/30 hover:shadow-xl hover:shadow-gold-500/40 hover:-translate-y-1 text-sm sm:text-base">
                                        <span>Decouvrir notre eglise</span>
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2 sm:ml-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('contact') }}" class="group inline-flex items-center justify-center px-6 sm:px-8 py-3.5 sm:py-4 bg-white/10 hover:bg-white/20 backdrop-blur-md text-white font-semibold rounded-xl sm:rounded-2xl border border-white/20 transition-all duration-300 hover:-translate-y-1 text-sm sm:text-base">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        </svg>
                                        <span>Nous trouver</span>
                                    </a>
                                </div>
                            </div>

                            {{-- Right Content - Service Card (visible on mobile too) --}}
                            <div class="flex justify-center lg:justify-end mt-4 lg:mt-0" x-show="currentSlide === 0" x-transition:enter="transition ease-out duration-700 delay-500" x-transition:enter-start="opacity-0 translate-y-4 lg:translate-y-0 lg:translate-x-8" x-transition:enter-end="opacity-100 translate-y-0 lg:translate-x-0">
                                <div class="relative w-full max-w-sm">
                                    {{-- Main Card --}}
                                    <div class="bg-white/10 backdrop-blur-xl rounded-2xl sm:rounded-3xl p-5 sm:p-8 border border-white/20 shadow-2xl">
                                        <div class="flex items-center mb-4 sm:mb-6">
                                            <div class="w-11 h-11 sm:w-14 sm:h-14 bg-gold-500/20 rounded-xl sm:rounded-2xl flex items-center justify-center mr-3 sm:mr-4">
                                                <svg class="w-5 h-5 sm:w-7 sm:h-7 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-white font-semibold text-base sm:text-lg">Prochain Culte</h3>
                                                <p class="text-white/60 text-xs sm:text-sm">Ce Dimanche</p>
                                            </div>
                                        </div>

                                        <div class="space-y-2 sm:space-y-3">
                                            <div class="bg-white/5 rounded-xl sm:rounded-2xl p-3 sm:p-4 border border-white/10 hover:bg-white/10 transition-colors">
                                                <div class="flex items-center justify-between">
                                                    <span class="text-white/80 text-sm sm:text-base">Culte Principal</span>
                                                    <span class="text-gold-400 font-bold text-base sm:text-lg">09h00</span>
                                                </div>
                                            </div>
                                            <div class="bg-white/5 rounded-xl sm:rounded-2xl p-3 sm:p-4 border border-white/10 hover:bg-white/10 transition-colors">
                                                <div class="flex items-center justify-between">
                                                    <span class="text-white/80 text-sm sm:text-base">Ecole du Dimanche</span>
                                                    <span class="text-gold-400 font-bold text-base sm:text-lg">08h30</span>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="{{ route('contact') }}" class="mt-4 sm:mt-6 w-full inline-flex items-center justify-center px-5 sm:px-6 py-3 sm:py-3.5 bg-white text-primary-700 font-semibold rounded-lg sm:rounded-xl hover:bg-gold-50 transition-all duration-300 group text-sm sm:text-base">
                                            Planifier ma visite
                                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>

                                    {{-- Decorative Badge --}}
                                    <div class="absolute -top-2 -right-2 sm:-top-3 sm:-right-3 bg-gradient-to-r from-gold-400 to-gold-500 text-white text-[10px] sm:text-xs font-bold px-3 sm:px-4 py-1.5 sm:py-2 rounded-full shadow-lg animate-pulse-glow">
                                        En direct
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Slide 2 - Community --}}
                <div class="w-full flex-shrink-0 min-h-[100svh] sm:min-h-[calc(100vh-116px)] relative flex items-center">
                    <div class="absolute inset-0">
                        <img src="https://images.unsplash.com/photo-1529070538774-1843cb3265df?auto=format&fit=crop&w=2070&q=80"
                             alt="" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-primary-900/95 via-primary-900/80 to-transparent"></div>
                    </div>

                    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-8 sm:py-16 lg:py-20">
                        <div class="max-w-2xl" x-show="currentSlide === 1" x-transition:enter="transition ease-out duration-700 delay-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                            <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 bg-growth-500/20 backdrop-blur-md rounded-full border border-growth-400/30 mb-4 sm:mb-6">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-growth-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-growth-300 text-xs sm:text-sm font-medium">Notre Communaute</span>
                            </div>

                            <h2 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold text-white mb-4 sm:mb-6 leading-tight">
                                Une famille
                                <span class="text-growth-400">unie</span>
                                par la foi
                            </h2>

                            <p class="text-base sm:text-lg lg:text-xl text-white/70 leading-relaxed mb-6 sm:mb-8">
                                Depuis plus de 20 ans, nous batissons une communaute ou chacun trouve sa place. Venez comme vous etes, repartez transforme.
                            </p>

                            <div class="flex flex-wrap gap-3 sm:gap-4">
                                <a href="{{ route('about.history') }}" class="inline-flex items-center px-6 sm:px-8 py-3.5 sm:py-4 bg-white text-primary-700 font-semibold rounded-xl sm:rounded-2xl transition-all duration-300 hover:-translate-y-1 shadow-lg hover:shadow-xl text-sm sm:text-base">
                                    Notre histoire
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2 sm:ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Slide 3 - Ministries --}}
                <div class="w-full flex-shrink-0 min-h-[100svh] sm:min-h-[calc(100vh-116px)] relative flex items-center">
                    <div class="absolute inset-0">
                        <img src="https://images.unsplash.com/photo-1519491050926-8cf10c1ea3e1?auto=format&fit=crop&w=2070&q=80"
                             alt="" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary-900/95 via-primary-900/70 to-primary-900/50"></div>
                    </div>

                    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-8 sm:py-16 lg:py-20 text-center">
                        <div x-show="currentSlide === 2" x-transition:enter="transition ease-out duration-700 delay-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                            <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 bg-gold-500/20 backdrop-blur-md rounded-full border border-gold-400/30 mb-4 sm:mb-6">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <span class="text-gold-300 text-xs sm:text-sm font-medium">Nos Ministeres</span>
                            </div>

                            <h2 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold text-white mb-4 sm:mb-6 max-w-4xl mx-auto leading-tight">
                                Trouvez votre
                                <span class="text-gold-400">place</span>
                                parmi nous
                            </h2>

                            <p class="text-base sm:text-lg lg:text-xl text-white/70 leading-relaxed mb-6 sm:mb-10 max-w-2xl mx-auto">
                                Jeunesse, enfants, femmes, hommes... Nous avons un ministere adapte a chaque saison de votre vie.
                            </p>

                            <div class="grid grid-cols-2 sm:flex sm:flex-wrap gap-3 sm:gap-4 justify-center">
                                <a href="{{ route('ministries.youth') }}" class="inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3 bg-blue-500 text-white font-semibold rounded-lg sm:rounded-xl hover:bg-blue-600 transition-all text-sm sm:text-base">
                                    Jeunesse
                                </a>
                                <a href="{{ route('ministries.children') }}" class="inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3 bg-orange-500 text-white font-semibold rounded-lg sm:rounded-xl hover:bg-orange-600 transition-all text-sm sm:text-base">
                                    Enfants
                                </a>
                                <a href="{{ route('ministries.women') }}" class="inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3 bg-pink-500 text-white font-semibold rounded-lg sm:rounded-xl hover:bg-pink-600 transition-all text-sm sm:text-base">
                                    Femmes
                                </a>
                                <a href="{{ route('ministries.men') }}" class="inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3 bg-slate-600 text-white font-semibold rounded-lg sm:rounded-xl hover:bg-slate-700 transition-all text-sm sm:text-base">
                                    Hommes
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Navigation Arrows (hidden on mobile - use swipe instead) --}}
            <button @click="prev()" class="absolute left-3 sm:left-6 top-1/2 -translate-y-1/2 z-20 w-10 h-10 sm:w-14 sm:h-14 rounded-full bg-white/10 backdrop-blur-md border border-white/20 hidden sm:flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all duration-300 hover:bg-white/20 hover:scale-110">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button @click="next()" class="absolute right-3 sm:right-6 top-1/2 -translate-y-1/2 z-20 w-10 h-10 sm:w-14 sm:h-14 rounded-full bg-white/10 backdrop-blur-md border border-white/20 hidden sm:flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-all duration-300 hover:bg-white/20 hover:scale-110">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            {{-- Dot Indicators --}}
            <div class="absolute bottom-6 sm:bottom-8 left-1/2 -translate-x-1/2 z-20 flex gap-2.5 sm:gap-3">
                <template x-for="(_, index) in totalSlides" :key="index">
                    <button
                        @click="goTo(index)"
                        :class="currentSlide === index ? 'w-6 sm:w-8 bg-white' : 'w-2 sm:w-2.5 bg-white/40 hover:bg-white/60'"
                        class="h-2 sm:h-2.5 rounded-full transition-all duration-300"
                    ></button>
                </template>
            </div>

            {{-- Progress Bar --}}
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-white/10">
                <div class="h-full bg-gradient-to-r from-primary-400 to-gold-400 transition-all duration-100" :style="`width: ${progress}%`"></div>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-24 left-1/2 -translate-x-1/2 z-20 animate-bounce hidden lg:block">
            <div class="w-8 h-12 rounded-full border-2 border-white/30 flex items-start justify-center p-2">
                <div class="w-1.5 h-3 bg-white/60 rounded-full animate-scroll-indicator"></div>
            </div>
        </div>
    </section>

    {{-- ============================================
         STATS SECTION - Impressive Numbers
         ============================================ --}}
    <section class="py-12 sm:py-16 lg:py-20 bg-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-radial opacity-50"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8 lg:gap-12">
                {{-- Stat 1 --}}
                <div class="text-center animate-slide-up" data-animate>
                    <div class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 rounded-xl sm:rounded-2xl bg-primary-100 mb-3 sm:mb-4">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gradient counter" data-target="500">0</div>
                    <div class="text-zinc-500 mt-1 sm:mt-2 text-xs sm:text-sm lg:text-base">Membres actifs</div>
                </div>

                {{-- Stat 2 --}}
                <div class="text-center animate-slide-up" data-animate style="animation-delay: 0.1s">
                    <div class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 rounded-xl sm:rounded-2xl bg-gold-100 mb-3 sm:mb-4">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gradient-gold counter" data-target="20">0</div>
                    <div class="text-zinc-500 mt-1 sm:mt-2 text-xs sm:text-sm lg:text-base">Annees de foi</div>
                </div>

                {{-- Stat 3 --}}
                <div class="text-center animate-slide-up" data-animate style="animation-delay: 0.2s">
                    <div class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 rounded-xl sm:rounded-2xl bg-growth-100 mb-3 sm:mb-4">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-growth-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gradient counter" data-target="5">0</div>
                    <div class="text-zinc-500 mt-1 sm:mt-2 text-xs sm:text-sm lg:text-base">Ministeres</div>
                </div>

                {{-- Stat 4 --}}
                <div class="text-center animate-slide-up" data-animate style="animation-delay: 0.3s">
                    <div class="inline-flex items-center justify-center w-12 h-12 sm:w-16 sm:h-16 rounded-xl sm:rounded-2xl bg-blue-100 mb-3 sm:mb-4">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <div class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gradient counter" data-target="1000">0</div>
                    <div class="text-zinc-500 mt-1 sm:mt-2 text-xs sm:text-sm lg:text-base">Vies transformees</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         SERVICE TIMES SECTION
         ============================================ --}}
    <section class="py-16 sm:py-20 lg:py-24 bg-gradient-mesh relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-zinc-200 to-transparent"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Section Header --}}
            <div class="text-center mb-10 sm:mb-16 animate-slide-up" data-animate>
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-50 text-primary-700 rounded-full text-sm font-semibold mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Rejoignez-nous</span>
                </div>
                <h2 class="section-title mb-4">
                    Horaires des <span class="text-gradient">cultes</span>
                </h2>
                <p class="section-subtitle mx-auto">
                    Nous serions ravis de vous accueillir lors de nos rassemblements. Venez comme vous etes !
                </p>
            </div>

            @if($schedules->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-{{ min($schedules->count(), 3) }} gap-8 stagger-children" data-animate>
                @foreach($schedules as $index => $schedule)
                    @php
                        $color = $schedule->icon_color ?? 'primary';
                        $isFirst = $index === 0;
                        $colorClasses = [
                            'primary' => ['bg' => 'bg-primary-50', 'icon-bg' => 'bg-primary-100', 'text' => 'text-primary-600', 'gradient' => 'from-primary-500 to-primary-600'],
                            'gold' => ['bg' => 'bg-gold-50', 'icon-bg' => 'bg-gold-100', 'text' => 'text-gold-600', 'gradient' => 'from-gold-400 to-gold-500'],
                            'blue' => ['bg' => 'bg-blue-50', 'icon-bg' => 'bg-blue-100', 'text' => 'text-blue-600', 'gradient' => 'from-blue-500 to-blue-600'],
                            'purple' => ['bg' => 'bg-purple-50', 'icon-bg' => 'bg-purple-100', 'text' => 'text-purple-600', 'gradient' => 'from-purple-500 to-purple-600'],
                        ];
                        $colorClass = $colorClasses[$color] ?? $colorClasses['primary'];
                    @endphp

                    @if($isFirst)
                    <div class="group relative card-hover-lift">
                        <div class="absolute inset-0 bg-gradient-to-br {{ $colorClass['gradient'] }} rounded-3xl blur-xl opacity-40 group-hover:opacity-60 transition-opacity duration-500"></div>
                        <div class="relative bg-gradient-to-br {{ $colorClass['gradient'] }} rounded-3xl p-8 text-white overflow-hidden shadow-2xl">
                            <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl"></div>

                            <div class="relative">
                                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                    @include('components.schedule-icon', ['icon' => $schedule->icon, 'class' => 'w-8 h-8'])
                                </div>
                                <h3 class="text-2xl font-bold mb-3">{{ $schedule->title }}</h3>
                                @if($schedule->description)
                                <p class="text-white/80 mb-6 leading-relaxed">{{ $schedule->description }}</p>
                                @endif
                                <div class="flex items-center bg-white/10 backdrop-blur-sm rounded-xl px-4 py-3 border border-white/10">
                                    <svg class="w-5 h-5 mr-3 text-gold-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-lg font-semibold">{{ $schedule->display_time }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="group relative card-hover-lift">
                        <div class="relative bg-white rounded-3xl p-8 border border-zinc-100 shadow-lg overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 {{ $colorClass['bg'] }} rounded-full -translate-y-1/2 translate-x-1/2 opacity-50 group-hover:opacity-100 transition-opacity duration-300"></div>

                            <div class="relative">
                                <div class="w-16 h-16 {{ $colorClass['icon-bg'] }} rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                    @include('components.schedule-icon', ['icon' => $schedule->icon, 'class' => 'w-8 h-8 ' . $colorClass['text']])
                                </div>
                                <h3 class="text-2xl font-bold text-zinc-900 mb-3">{{ $schedule->title }}</h3>
                                @if($schedule->description)
                                <p class="text-zinc-600 mb-6 leading-relaxed">{{ $schedule->description }}</p>
                                @endif
                                <div class="flex items-center {{ $colorClass['bg'] }} rounded-xl px-4 py-3">
                                    <svg class="w-5 h-5 mr-3 {{ $colorClass['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-lg font-semibold {{ $colorClass['text'] }}">{{ $schedule->display_time }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
            @else
            <div class="text-center py-16 bg-white rounded-3xl border border-zinc-100 shadow-sm">
                <svg class="w-16 h-16 text-zinc-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-zinc-500 text-lg">Les horaires seront bientot disponibles.</p>
            </div>
            @endif
        </div>
    </section>

    {{-- ============================================
         ABOUT SECTION - Split Layout
         ============================================ --}}
    <section class="py-16 sm:py-20 lg:py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 sm:gap-12 lg:gap-16 items-center">
                {{-- Image Side --}}
                <div class="relative animate-slide-up" data-animate>
                    <div class="relative">
                        <div class="relative rounded-2xl sm:rounded-3xl overflow-hidden shadow-xl sm:shadow-2xl">
                            <div class="absolute inset-0 bg-gradient-to-t from-primary-900/50 to-transparent z-10"></div>
                            <img src="https://images.unsplash.com/photo-1529070538774-1843cb3265df?auto=format&fit=crop&w=1470&q=80"
                                 alt="Communaute Poimen Church"
                                 class="w-full h-[300px] sm:h-[400px] lg:h-[500px] object-cover hover:scale-105 transition-transform duration-700">
                        </div>

                        {{-- Floating Stats Card --}}
                        <div class="absolute -bottom-4 -right-2 sm:-bottom-6 sm:-right-6 bg-white rounded-xl sm:rounded-2xl shadow-xl sm:shadow-2xl p-4 sm:p-6 z-20 card-hover-glow">
                            <div class="flex items-center gap-3 sm:gap-4">
                                <div class="w-10 h-10 sm:w-14 sm:h-14 bg-gradient-to-br from-gold-400 to-gold-500 rounded-lg sm:rounded-xl flex items-center justify-center shadow-lg shadow-gold-500/30">
                                    <svg class="w-5 h-5 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-2xl sm:text-3xl font-bold text-zinc-900">500+</p>
                                    <p class="text-xs sm:text-sm text-zinc-500">Membres actifs</p>
                                </div>
                            </div>
                        </div>

                        {{-- Experience Badge --}}
                        <div class="absolute -top-2 -left-2 sm:-top-4 sm:-left-4 bg-primary-600 text-white rounded-xl sm:rounded-2xl px-3 sm:px-5 py-2 sm:py-3 shadow-xl z-20">
                            <span class="text-xl sm:text-2xl font-bold">20+</span>
                            <span class="text-xs sm:text-sm block text-primary-200">ans d'experience</span>
                        </div>
                    </div>
                </div>

                {{-- Content Side --}}
                <div class="animate-slide-up" data-animate>
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-50 text-primary-700 rounded-full text-sm font-semibold mb-6">
                        <span class="w-2 h-2 bg-primary-500 rounded-full"></span>
                        <span>A propos de nous</span>
                    </div>

                    <h2 class="section-title mb-6">
                        Une eglise au service de la <span class="text-gradient">communaute</span>
                    </h2>

                    <p class="text-zinc-600 text-lg leading-relaxed mb-8">
                        Depuis plus de 20 ans, Poimen Church est un lieu de refuge, de guerison et de transformation. Notre mission est simple : faire connaitre l'amour de Christ a tous et equiper chaque croyant pour accomplir son appel.
                    </p>

                    {{-- Features Grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 mb-8 sm:mb-10">
                        <div class="flex items-start gap-3 sm:gap-4 group">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-primary-100 rounded-lg sm:rounded-xl flex items-center justify-center shrink-0 group-hover:bg-primary-200 transition-colors">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-zinc-900 text-sm sm:text-base">Accueil chaleureux</h4>
                                <p class="text-xs sm:text-sm text-zinc-500">Venez comme vous etes</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 sm:gap-4 group">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gold-100 rounded-lg sm:rounded-xl flex items-center justify-center shrink-0 group-hover:bg-gold-200 transition-colors">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-zinc-900 text-sm sm:text-base">Enseignement solide</h4>
                                <p class="text-xs sm:text-sm text-zinc-500">Base sur la Bible</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 sm:gap-4 group">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-lg sm:rounded-xl flex items-center justify-center shrink-0 group-hover:bg-blue-200 transition-colors">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-zinc-900 text-sm sm:text-base">Louange vibrante</h4>
                                <p class="text-xs sm:text-sm text-zinc-500">Adoration authentique</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 sm:gap-4 group">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-purple-100 rounded-lg sm:rounded-xl flex items-center justify-center shrink-0 group-hover:bg-purple-200 transition-colors">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-zinc-900 text-sm sm:text-base">Communaute unie</h4>
                                <p class="text-xs sm:text-sm text-zinc-500">Famille spirituelle</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('about.history') }}" class="group inline-flex items-center w-full sm:w-auto justify-center px-6 sm:px-8 py-3.5 sm:py-4 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg shadow-primary-500/25 hover:-translate-y-1 text-sm sm:text-base">
                        En savoir plus
                        <svg class="w-5 h-5 ml-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         MINISTRIES SECTION
         ============================================ --}}
    <section class="py-16 sm:py-20 lg:py-24 bg-zinc-50 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-radial opacity-30"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Section Header --}}
            <div class="text-center mb-10 sm:mb-16 animate-slide-up" data-animate>
                <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 bg-gold-100 text-gold-700 rounded-full text-xs sm:text-sm font-semibold mb-4 sm:mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                    <span>Nos ministeres</span>
                </div>
                <h2 class="section-title mb-4">
                    Trouvez votre <span class="text-gradient">place</span>
                </h2>
                <p class="section-subtitle mx-auto">
                    Nous avons des ministeres adaptes a chaque age et chaque saison de la vie.
                </p>
            </div>

            {{-- Ministry Cards --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 stagger-children" data-animate>
                <a href="{{ route('ministries.youth') }}" class="group relative card-hover-lift">
                    <div class="relative bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl sm:rounded-3xl p-5 sm:p-8 text-white overflow-hidden h-full min-h-[200px] sm:min-h-[280px]">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
                        <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-white/10 rounded-full"></div>
                        <div class="absolute top-0 right-0 w-20 h-20 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>

                        <div class="relative h-full flex flex-col">
                            <div class="w-10 h-10 sm:w-14 sm:h-14 bg-white/20 backdrop-blur-sm rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Jeunesse</h3>
                            <p class="text-white/80 text-sm mb-auto">13 - 25 ans</p>
                            <span class="inline-flex items-center text-sm font-medium mt-4 group-hover:translate-x-2 transition-transform duration-300">
                                Decouvrir
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>

                <a href="{{ route('ministries.children') }}" class="group relative card-hover-lift">
                    <div class="relative bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl sm:rounded-3xl p-5 sm:p-8 text-white overflow-hidden h-full min-h-[200px] sm:min-h-[280px]">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
                        <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-white/10 rounded-full"></div>

                        <div class="relative h-full flex flex-col">
                            <div class="w-10 h-10 sm:w-14 sm:h-14 bg-white/20 backdrop-blur-sm rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Enfants</h3>
                            <p class="text-white/80 text-sm mb-auto">0 - 12 ans</p>
                            <span class="inline-flex items-center text-sm font-medium mt-4 group-hover:translate-x-2 transition-transform duration-300">
                                Decouvrir
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>

                <a href="{{ route('ministries.women') }}" class="group relative card-hover-lift">
                    <div class="relative bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl sm:rounded-3xl p-5 sm:p-8 text-white overflow-hidden h-full min-h-[200px] sm:min-h-[280px]">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
                        <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-white/10 rounded-full"></div>

                        <div class="relative h-full flex flex-col">
                            <div class="w-10 h-10 sm:w-14 sm:h-14 bg-white/20 backdrop-blur-sm rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Femmes</h3>
                            <p class="text-white/80 text-sm mb-auto">Ministere feminin</p>
                            <span class="inline-flex items-center text-sm font-medium mt-4 group-hover:translate-x-2 transition-transform duration-300">
                                Decouvrir
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>

                <a href="{{ route('ministries.men') }}" class="group relative card-hover-lift">
                    <div class="relative bg-gradient-to-br from-slate-600 to-slate-700 rounded-2xl sm:rounded-3xl p-5 sm:p-8 text-white overflow-hidden h-full min-h-[200px] sm:min-h-[280px]">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
                        <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-white/10 rounded-full"></div>

                        <div class="relative h-full flex flex-col">
                            <div class="w-10 h-10 sm:w-14 sm:h-14 bg-white/20 backdrop-blur-sm rounded-xl sm:rounded-2xl flex items-center justify-center mb-4 sm:mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Hommes</h3>
                            <p class="text-white/80 text-sm mb-auto">Ministere masculin</p>
                            <span class="inline-flex items-center text-sm font-medium mt-4 group-hover:translate-x-2 transition-transform duration-300">
                                Decouvrir
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- ============================================
         TESTIMONIALS SECTION - Horizontal Scroll Carousel
         ============================================ --}}
    @if($testimonials->count() > 0)
    <section class="py-16 sm:py-20 lg:py-24 bg-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-radial opacity-30"></div>

        <div class="relative">
            {{-- Section Header --}}
            <div class="text-center mb-8 sm:mb-12 px-4 sm:px-6 lg:px-8 animate-slide-up" data-animate>
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-50 text-primary-700 rounded-full text-sm font-semibold mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <span>Temoignages</span>
                </div>
                <h2 class="section-title mb-4">
                    Ce que notre <span class="text-gradient">communaute</span> dit
                </h2>
                <p class="section-subtitle mx-auto">
                    Decouvrez les histoires inspirantes de ceux qui ont ete touches par la grace de Dieu dans notre eglise.
                </p>
            </div>

            {{-- Horizontal Scrolling Carousel --}}
            <div class="relative group/carousel" x-data="{
                scrollContainer: null,
                canScrollLeft: false,
                canScrollRight: true,

                init() {
                    this.scrollContainer = this.$refs.scrollContainer;
                    this.checkScroll();
                    this.scrollContainer.addEventListener('scroll', () => this.checkScroll());
                },

                checkScroll() {
                    this.canScrollLeft = this.scrollContainer.scrollLeft > 0;
                    this.canScrollRight = this.scrollContainer.scrollLeft < (this.scrollContainer.scrollWidth - this.scrollContainer.clientWidth - 10);
                },

                scrollLeft() {
                    this.scrollContainer.scrollBy({ left: -400, behavior: 'smooth' });
                },

                scrollRight() {
                    this.scrollContainer.scrollBy({ left: 400, behavior: 'smooth' });
                }
            }">
                {{-- Navigation Arrows --}}
                <button @click="scrollLeft()"
                        x-show="canScrollLeft"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        class="absolute left-4 top-1/2 -translate-y-1/2 z-10 w-12 h-12 bg-white rounded-full shadow-lg border border-gray-100 flex items-center justify-center text-gray-600 hover:text-primary-600 hover:border-primary-200 transition-all duration-300 opacity-0 group-hover/carousel:opacity-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <button @click="scrollRight()"
                        x-show="canScrollRight"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-x-4"
                        x-transition:enter-end="opacity-100 translate-x-0"
                        class="absolute right-4 top-1/2 -translate-y-1/2 z-10 w-12 h-12 bg-white rounded-full shadow-lg border border-gray-100 flex items-center justify-center text-gray-600 hover:text-primary-600 hover:border-primary-200 transition-all duration-300 opacity-0 group-hover/carousel:opacity-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                {{-- Scrollable Container --}}
                <div x-ref="scrollContainer"
                     class="flex gap-6 overflow-x-auto pb-4 px-4 sm:px-6 lg:px-8 scroll-smooth scrollbar-hide"
                     style="scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch;">

                    {{-- Left Spacer for centering --}}
                    <div class="flex-shrink-0 w-[calc((100vw-1280px)/2)] hidden xl:block"></div>

                    @foreach($testimonials as $testimonial)
                    <a href="{{ route('testimonials.show', $testimonial) }}"
                       class="group flex-shrink-0 w-[280px] sm:w-[380px] bg-white rounded-2xl sm:rounded-3xl border border-gray-100 shadow-lg hover:shadow-2xl p-5 sm:p-8 transition-all duration-300 hover:-translate-y-2 relative overflow-hidden cursor-pointer"
                       style="scroll-snap-align: start;">

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
                            "{{ $testimonial->short_content }}"
                        </p>

                        {{-- Author --}}
                        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                            <img src="{{ $testimonial->photo_url }}" alt="{{ $testimonial->author_name }}"
                                 class="w-12 h-12 rounded-xl object-cover border-2 border-gray-100 group-hover:border-primary-200 transition-colors">
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-900 group-hover:text-primary-600 transition-colors truncate">{{ $testimonial->author_name }}</h4>
                                @if($testimonial->author_role)
                                <p class="text-sm text-gray-500 truncate">{{ $testimonial->author_role }}</p>
                                @endif
                            </div>
                            {{-- Arrow indicator --}}
                            <div class="w-8 h-8 bg-primary-50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-2 group-hover:translate-x-0">
                                <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                    @endforeach

                    {{-- Right Spacer --}}
                    <div class="flex-shrink-0 w-[calc((100vw-1280px)/2)] hidden xl:block"></div>
                </div>

                {{-- Scroll Indicator --}}
                <div class="flex justify-center items-center gap-4 mt-8 px-4">
                    <span class="text-sm text-gray-400">Faites defiler pour voir plus</span>
                    <svg class="w-5 h-5 text-gray-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </div>

                {{-- View All Link --}}
                <div class="text-center mt-8">
                    <a href="{{ route('testimonials') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        Voir tous les temoignages
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ============================================
         UPCOMING EVENTS SECTION
         ============================================ --}}
    @if($upcomingEvents->count() > 0)
    <section class="py-16 sm:py-20 lg:py-24 bg-zinc-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Section Header --}}
            <div class="text-center mb-10 sm:mb-16 animate-slide-up" data-animate>
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-gold-100 text-gold-700 rounded-full text-sm font-semibold mb-6">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Evenements</span>
                </div>
                <h2 class="section-title mb-4">
                    Evenements <span class="text-gradient">a venir</span>
                </h2>
                <p class="section-subtitle mx-auto">
                    Retrouvez nos prochains evenements et activites. Rejoignez-nous !
                </p>
            </div>

            {{-- Events Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 stagger-children" data-animate>
                @foreach($upcomingEvents as $event)
                <a href="{{ route('events.show', $event->slug) }}" class="group relative card-hover-lift">
                    <div class="relative bg-white rounded-2xl sm:rounded-3xl overflow-hidden shadow-lg border border-zinc-100">
                        {{-- Event Image --}}
                        <div class="relative h-48 sm:h-56 overflow-hidden">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>

                            {{-- Date Badge --}}
                            <div class="absolute top-4 left-4 bg-white rounded-xl px-3 py-2 shadow-lg text-center">
                                <span class="block text-2xl font-bold text-primary-700 leading-none">{{ $event->start_date->format('d') }}</span>
                                <span class="block text-xs font-medium text-zinc-500 uppercase">{{ $event->start_date->translatedFormat('M') }}</span>
                            </div>

                            {{-- Type Badge --}}
                            <div class="absolute top-4 right-4 bg-primary-600/90 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                                {{ ucfirst($event->type) }}
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-5 sm:p-6">
                            <h3 class="text-lg font-bold text-zinc-900 mb-2 group-hover:text-primary-600 transition-colors line-clamp-2">{{ $event->title }}</h3>
                            @if($event->description)
                            <p class="text-zinc-600 text-sm leading-relaxed mb-4 line-clamp-2">{{ $event->description }}</p>
                            @endif

                            <div class="flex items-center gap-4 text-sm text-zinc-500">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $event->start_date->format('H\hi') }}</span>
                                </div>
                                @if($event->location)
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    <span class="truncate">{{ $event->location }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- View All Events Link --}}
            <div class="text-center mt-10 sm:mt-12">
                <a href="{{ route('events') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                    Voir tous les evenements
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- ============================================
         CTA SECTION - Immersive
         ============================================ --}}
    <section class="py-16 sm:py-24 lg:py-32 relative overflow-hidden">
        {{-- Background --}}
        <div class="absolute inset-0 bg-gradient-to-br from-primary-800 via-primary-700 to-primary-900"></div>
        <div class="absolute inset-0 hero-pattern opacity-10"></div>

        {{-- Floating Elements --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none hidden sm:block">
            <div class="absolute top-0 left-0 w-96 h-96 bg-gold-500/20 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-primary-400/20 rounded-full translate-x-1/2 translate-y-1/2 blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="animate-slide-up" data-animate>
                <div class="inline-flex items-center gap-2 px-3 sm:px-4 py-1.5 sm:py-2 bg-white/10 backdrop-blur-md text-white rounded-full text-xs sm:text-sm font-semibold mb-6 sm:mb-8 border border-white/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    <span>Rejoignez-nous</span>
                </div>

                <h2 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold text-white mb-4 sm:mb-6 leading-tight">
                    Pret a faire le <br class="hidden sm:block">premier pas ?
                </h2>

                <p class="text-base sm:text-lg lg:text-xl text-white/70 max-w-2xl mx-auto mb-8 sm:mb-12">
                    Nous serions honores de vous accueillir ce dimanche. Une nouvelle aventure spirituelle vous attend.
                </p>

                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
                    <a href="{{ route('contact') }}" class="group inline-flex items-center justify-center px-6 sm:px-10 py-4 sm:py-5 bg-white text-primary-700 font-semibold rounded-xl sm:rounded-2xl transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1 text-sm sm:text-base">
                        Planifier votre visite
                        <svg class="w-5 h-5 ml-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="{{ route('give') }}" class="group inline-flex items-center justify-center px-6 sm:px-10 py-4 sm:py-5 bg-gold-500 hover:bg-gold-400 text-white font-semibold rounded-xl sm:rounded-2xl transition-all duration-300 shadow-lg shadow-gold-500/30 hover:-translate-y-1 text-sm sm:text-base">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        Soutenir notre mission
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         LOCATION SECTION
         ============================================ --}}
    <section class="py-16 sm:py-20 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 sm:gap-12 lg:gap-16 items-center">
                {{-- Map --}}
                <div class="relative animate-slide-up" data-animate>
                    <div class="relative rounded-2xl sm:rounded-3xl overflow-hidden shadow-xl sm:shadow-2xl h-[280px] sm:h-[350px] lg:h-[450px]">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55251.37609537865!2d-17.49029585!3d14.716677!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xec10d0bdeba9b1d%3A0x7e66b6c12d8e4f25!2sDakar%2C%20Senegal!5e0!3m2!1sfr!2s!4v1699000000000!5m2!1sfr!2s"
                            class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>

                    <div class="absolute -bottom-3 left-4 sm:-bottom-4 sm:left-8 bg-primary-600 text-white rounded-xl sm:rounded-2xl px-4 sm:px-6 py-2.5 sm:py-4 shadow-xl flex items-center gap-2 sm:gap-3">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-white/20 rounded-lg sm:rounded-xl flex items-center justify-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                        </div>
                        <span class="font-medium text-sm sm:text-base">Rue GY-113,132</span>
                    </div>
                </div>

                {{-- Contact Info --}}
                <div class="animate-slide-up mt-4 sm:mt-0" data-animate>
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-50 text-primary-700 rounded-full text-sm font-semibold mb-6">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                        <span>Nous trouver</span>
                    </div>

                    <h2 class="section-title mb-6">
                        Venez nous <span class="text-gradient">rendre visite</span>
                    </h2>

                    <p class="text-zinc-600 text-lg leading-relaxed mb-10">
                        Nous sommes situes a Dakar, facilement accessibles. N'hesitez pas a nous contacter pour toute question.
                    </p>

                    {{-- Contact Cards --}}
                    <div class="space-y-3 sm:space-y-4">
                        <div class="group bg-zinc-50 hover:bg-white rounded-xl sm:rounded-2xl p-4 sm:p-5 flex items-center gap-3 sm:gap-5 transition-all duration-300 hover:shadow-lg border border-transparent hover:border-zinc-100">
                            <div class="w-11 h-11 sm:w-14 sm:h-14 bg-primary-100 rounded-xl sm:rounded-2xl flex items-center justify-center shrink-0 group-hover:bg-primary-200 transition-colors">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-zinc-900 mb-0.5 sm:mb-1 text-sm sm:text-base">Adresse</h4>
                                <p class="text-zinc-600 text-sm sm:text-base">Rue GY-113,132</p>
                            </div>
                        </div>

                        <div class="group bg-zinc-50 hover:bg-white rounded-xl sm:rounded-2xl p-4 sm:p-5 flex items-center gap-3 sm:gap-5 transition-all duration-300 hover:shadow-lg border border-transparent hover:border-zinc-100">
                            <div class="w-11 h-11 sm:w-14 sm:h-14 bg-gold-100 rounded-xl sm:rounded-2xl flex items-center justify-center shrink-0 group-hover:bg-gold-200 transition-colors">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-zinc-900 mb-0.5 sm:mb-1 text-sm sm:text-base">Telephone</h4>
                                <a href="tel:+221774663834" class="text-primary-600 hover:text-primary-700 font-medium text-sm sm:text-base">+221 77 466 38 34</a>
                            </div>
                        </div>

                        <div class="group bg-zinc-50 hover:bg-white rounded-xl sm:rounded-2xl p-4 sm:p-5 flex items-center gap-3 sm:gap-5 transition-all duration-300 hover:shadow-lg border border-transparent hover:border-zinc-100">
                            <div class="w-11 h-11 sm:w-14 sm:h-14 bg-blue-100 rounded-xl sm:rounded-2xl flex items-center justify-center shrink-0 group-hover:bg-blue-200 transition-colors">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-zinc-900 mb-0.5 sm:mb-1 text-sm sm:text-base">Email</h4>
                                <a href="mailto:contact@poimenchurch.org" class="text-primary-600 hover:text-primary-700 font-medium text-sm sm:text-base">contact@poimenchurch.org</a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('contact') }}" class="group inline-flex items-center w-full sm:w-auto justify-center mt-8 sm:mt-10 px-6 sm:px-8 py-3.5 sm:py-4 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg shadow-primary-500/25 hover:-translate-y-1 text-sm sm:text-base">
                        Nous contacter
                        <svg class="w-5 h-5 ml-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Intersection Observer for animations
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('[data-animate]').forEach(el => {
                observer.observe(el);
            });

            // Counter animation
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;
                let started = false;

                const updateCounter = () => {
                    current += step;
                    if (current < target) {
                        counter.textContent = Math.floor(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target + '+';
                    }
                };

                const counterObserver = new IntersectionObserver((entries) => {
                    if (entries[0].isIntersecting && !started) {
                        started = true;
                        updateCounter();
                        counterObserver.disconnect();
                    }
                }, { threshold: 0.5 });

                counterObserver.observe(counter);
            });

            // Navbar scroll effect
            const navbar = document.getElementById('main-navbar');
            const mainNav = document.getElementById('main-nav');

            if (mainNav) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 100) {
                        mainNav.classList.add('scrolled');
                    } else {
                        mainNav.classList.remove('scrolled');
                    }
                });
            }
        });
    </script>

    <style>
        @keyframes slow-zoom {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }

        .animate-slow-zoom {
            animation: slow-zoom 20s ease-out forwards;
        }
    </style>
    @endpush
</x-public-layout>
