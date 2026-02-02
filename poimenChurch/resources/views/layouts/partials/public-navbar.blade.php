<header x-data="{
    mobileOpen: false,
    aboutOpen: false,
    ministriesOpen: false,
    scrolled: false
}"
@scroll.window="scrolled = (window.pageYOffset > 50)"
class="fixed top-0 left-0 right-0 z-50">

    {{-- Top Bar --}}
    <div class="bg-primary-900 text-white text-sm" x-show="!scrolled" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-10">
                {{-- Left --}}
                <div class="hidden md:flex items-center gap-6">
                    <a href="tel:+22500000000" class="flex items-center gap-2 hover:text-gold-400 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span>+225 00 00 00 00</span>
                    </a>
                    <a href="mailto:contact@poimenchurch.org" class="flex items-center gap-2 hover:text-gold-400 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>contact@poimenchurch.org</span>
                    </a>
                </div>

                {{-- Center (Mobile) --}}
                <div class="md:hidden text-center flex-1">
                    <span class="text-white/80">Culte chaque Dimanche a 9h00</span>
                </div>

                {{-- Right --}}
                <div class="hidden md:flex items-center gap-4">
                    <div class="flex items-center gap-2">
                        <a href="#" class="w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-gold-500 transition-all duration-300" aria-label="Facebook">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-gold-500 transition-all duration-300" aria-label="YouTube">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    </div>
                    <div class="h-4 w-px bg-white/20"></div>
                    <div class="flex items-center gap-1 bg-white/10 rounded-full p-0.5">
                        <a href="{{ route('lang.switch', 'fr') }}" class="px-3 py-1 rounded-full text-xs font-medium transition-all {{ app()->getLocale() === 'fr' ? 'bg-white text-primary-900' : 'text-white/70 hover:text-white' }}">FR</a>
                        <a href="{{ route('lang.switch', 'en') }}" class="px-3 py-1 rounded-full text-xs font-medium transition-all {{ app()->getLocale() === 'en' ? 'bg-white text-primary-900' : 'text-white/70 hover:text-white' }}">EN</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Navbar --}}
    <nav :class="scrolled ? 'bg-white/95 backdrop-blur-xl shadow-lg shadow-black/5 py-3' : 'bg-white/80 backdrop-blur-md py-4'"
         class="transition-all duration-300 border-b border-gray-100/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="relative">
                        <div class="w-11 h-11 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center shadow-lg shadow-primary-500/30 group-hover:shadow-primary-500/50 transition-all duration-300 group-hover:scale-105">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-gold-500 rounded-full border-2 border-white"></span>
                    </div>
                    <div class="hidden sm:block">
                        <span class="block text-lg font-bold text-gray-900 leading-none">Poimen</span>
                        <span class="block text-[10px] font-bold text-primary-600 uppercase tracking-[0.2em]">Church</span>
                    </div>
                </a>

                {{-- Desktop Navigation --}}
                <div class="hidden lg:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('home') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        Accueil
                    </a>

                    {{-- About Dropdown --}}
                    <div class="relative" @mouseenter="aboutOpen = true; ministriesOpen = false" @mouseleave="aboutOpen = false">
                        <button class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 inline-flex items-center gap-1.5 {{ request()->routeIs('about.*') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                            A propos
                            <svg class="w-4 h-4 transition-transform duration-200" :class="aboutOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>

                        <div x-show="aboutOpen"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 -translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-2"
                             class="absolute top-full left-0 mt-2 w-72 bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 p-2 z-50"
                             x-cloak>

                            <a href="{{ route('about.history') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors group">
                                <span class="w-10 h-10 rounded-lg bg-primary-100 flex items-center justify-center group-hover:bg-primary-200 transition-colors">
                                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </span>
                                <div>
                                    <span class="block text-sm font-medium text-gray-900">Notre histoire</span>
                                    <span class="block text-xs text-gray-500">Plus de 20 ans de foi</span>
                                </div>
                            </a>

                            <a href="{{ route('about.vision') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors group">
                                <span class="w-10 h-10 rounded-lg bg-gold-100 flex items-center justify-center group-hover:bg-gold-200 transition-colors">
                                    <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </span>
                                <div>
                                    <span class="block text-sm font-medium text-gray-900">Vision & Mission</span>
                                    <span class="block text-xs text-gray-500">Notre appel divin</span>
                                </div>
                            </a>

                            <a href="{{ route('about.leadership') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors group">
                                <span class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </span>
                                <div>
                                    <span class="block text-sm font-medium text-gray-900">Leadership</span>
                                    <span class="block text-xs text-gray-500">Notre equipe pastorale</span>
                                </div>
                            </a>

                            <a href="{{ route('about.beliefs') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors group">
                                <span class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                </span>
                                <div>
                                    <span class="block text-sm font-medium text-gray-900">Nos croyances</span>
                                    <span class="block text-xs text-gray-500">Ce que nous croyons</span>
                                </div>
                            </a>
                        </div>
                    </div>

                    {{-- Ministries Dropdown --}}
                    <div class="relative" @mouseenter="ministriesOpen = true; aboutOpen = false" @mouseleave="ministriesOpen = false">
                        <button class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 inline-flex items-center gap-1.5 {{ request()->routeIs('ministries.*') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                            Ministeres
                            <svg class="w-4 h-4 transition-transform duration-200" :class="ministriesOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>

                        <div x-show="ministriesOpen"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 -translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-2"
                             class="absolute top-full left-0 mt-2 w-64 bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 p-2 z-50"
                             x-cloak>

                            <a href="{{ route('ministries.worship') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                                <span class="w-9 h-9 rounded-lg bg-gradient-to-br from-gold-400 to-gold-500 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
                                </span>
                                <span class="text-sm font-medium text-gray-900">Louange & Adoration</span>
                            </a>

                            <a href="{{ route('ministries.youth') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                                <span class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-400 to-blue-500 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/></svg>
                                </span>
                                <span class="text-sm font-medium text-gray-900">Jeunesse</span>
                            </a>

                            <a href="{{ route('ministries.children') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                                <span class="w-9 h-9 rounded-lg bg-gradient-to-br from-orange-400 to-orange-500 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </span>
                                <span class="text-sm font-medium text-gray-900">Enfants</span>
                            </a>

                            <a href="{{ route('ministries.women') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                                <span class="w-9 h-9 rounded-lg bg-gradient-to-br from-pink-400 to-pink-500 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                </span>
                                <span class="text-sm font-medium text-gray-900">Femmes</span>
                            </a>

                            <a href="{{ route('ministries.men') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                                <span class="w-9 h-9 rounded-lg bg-gradient-to-br from-slate-500 to-slate-600 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </span>
                                <span class="text-sm font-medium text-gray-900">Hommes</span>
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('events') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('events*') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        Evenements
                    </a>

                    <a href="{{ route('sermons') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('sermons*') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        Predications
                    </a>

                    <a href="{{ route('contact') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('contact') ? 'text-primary-700 bg-primary-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        Contact
                    </a>
                </div>

                {{-- Right Actions --}}
                <div class="flex items-center gap-2 sm:gap-3">
                    {{-- Donner Button - Always visible --}}
                    <a href="{{ route('give') }}" class="inline-flex items-center gap-1.5 sm:gap-2 px-3 sm:px-5 py-2 sm:py-2.5 bg-gradient-to-r from-gold-500 to-gold-600 hover:from-gold-600 hover:to-gold-700 text-white text-xs sm:text-sm font-semibold rounded-lg sm:rounded-xl shadow-lg shadow-gold-500/25 hover:shadow-gold-500/40 transition-all duration-300 hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        Donner
                    </a>

                    {{-- Connexion/Dashboard Button - Hidden on very small screens --}}
                    @auth
                        <a href="{{ route('dashboard') }}" class="hidden md:inline-flex items-center gap-2 px-4 py-2.5 border-2 border-primary-600 text-primary-700 text-sm font-semibold rounded-xl hover:bg-primary-600 hover:text-white transition-all duration-300">
                            Mon espace
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hidden md:inline-flex items-center gap-2 px-4 py-2.5 border-2 border-gray-200 text-gray-700 text-sm font-semibold rounded-xl hover:border-primary-600 hover:text-primary-700 transition-all duration-300">
                            Connexion
                        </a>
                    @endauth

                    {{-- Mobile Menu Button --}}
                    <button @click="mobileOpen = !mobileOpen" class="lg:hidden relative w-10 h-10 flex items-center justify-center rounded-xl bg-gray-100 hover:bg-gray-200 transition-colors">
                        <span class="sr-only">Menu</span>
                        <div class="w-5 h-4 flex flex-col justify-between">
                            <span :class="mobileOpen ? 'rotate-45 translate-y-1.5' : ''" class="block h-0.5 w-full bg-gray-600 rounded-full transition-all duration-300 origin-center"></span>
                            <span :class="mobileOpen ? 'opacity-0' : ''" class="block h-0.5 w-full bg-gray-600 rounded-full transition-all duration-300"></span>
                            <span :class="mobileOpen ? '-rotate-45 -translate-y-1.5' : ''" class="block h-0.5 w-full bg-gray-600 rounded-full transition-all duration-300 origin-center"></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    {{-- Mobile Menu --}}
    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/50 z-40 lg:hidden"
         @click="mobileOpen = false"
         x-cloak>
    </div>

    <div x-show="mobileOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed top-0 right-0 bottom-0 w-full max-w-sm bg-white shadow-2xl z-50 lg:hidden overflow-y-auto"
         x-cloak>

        {{-- Mobile Header --}}
        <div class="flex items-center justify-between p-5 border-b border-gray-100">
            <span class="text-lg font-bold text-gray-900">Menu</span>
            <button @click="mobileOpen = false" class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-100 hover:bg-gray-200 transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Mobile Navigation --}}
        <nav class="p-5 space-y-2">
            <a href="{{ route('home') }}" class="flex items-center gap-3 p-3 rounded-xl {{ request()->routeIs('home') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }} transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span class="font-medium">Accueil</span>
            </a>

            {{-- About Section --}}
            <div class="pt-4 pb-2">
                <span class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider">A propos</span>
            </div>
            <a href="{{ route('about.history') }}" class="flex items-center gap-3 p-3 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors">
                <span class="w-2 h-2 rounded-full bg-primary-400"></span>
                Notre histoire
            </a>
            <a href="{{ route('about.vision') }}" class="flex items-center gap-3 p-3 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors">
                <span class="w-2 h-2 rounded-full bg-gold-400"></span>
                Vision & Mission
            </a>
            <a href="{{ route('about.leadership') }}" class="flex items-center gap-3 p-3 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors">
                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                Leadership
            </a>
            <a href="{{ route('about.beliefs') }}" class="flex items-center gap-3 p-3 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors">
                <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                Nos croyances
            </a>

            {{-- Ministries Section --}}
            <div class="pt-4 pb-2">
                <span class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Ministeres</span>
            </div>
            <a href="{{ route('ministries.worship') }}" class="flex items-center gap-3 p-3 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors">
                <span class="w-2 h-2 rounded-full bg-gold-500"></span>
                Louange & Adoration
            </a>
            <a href="{{ route('ministries.youth') }}" class="flex items-center gap-3 p-3 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors">
                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                Jeunesse
            </a>
            <a href="{{ route('ministries.children') }}" class="flex items-center gap-3 p-3 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors">
                <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                Enfants
            </a>
            <a href="{{ route('ministries.women') }}" class="flex items-center gap-3 p-3 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors">
                <span class="w-2 h-2 rounded-full bg-pink-500"></span>
                Femmes
            </a>
            <a href="{{ route('ministries.men') }}" class="flex items-center gap-3 p-3 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors">
                <span class="w-2 h-2 rounded-full bg-slate-500"></span>
                Hommes
            </a>

            {{-- Other Links --}}
            <div class="pt-4 pb-2">
                <span class="px-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Decouvrir</span>
            </div>
            <a href="{{ route('events') }}" class="flex items-center gap-3 p-3 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span class="font-medium">Evenements</span>
            </a>
            <a href="{{ route('sermons') }}" class="flex items-center gap-3 p-3 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                <span class="font-medium">Predications</span>
            </a>
            <a href="{{ route('contact') }}" class="flex items-center gap-3 p-3 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <span class="font-medium">Contact</span>
            </a>
        </nav>

        {{-- Mobile Footer --}}
        <div class="p-5 border-t border-gray-100 space-y-3">
            <a href="{{ route('give') }}" class="flex items-center justify-center gap-2 w-full px-5 py-3 bg-gradient-to-r from-gold-500 to-gold-600 text-white font-semibold rounded-xl shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                Donner
            </a>
            @auth
                <a href="{{ route('dashboard') }}" class="flex items-center justify-center gap-2 w-full px-5 py-3 border-2 border-primary-600 text-primary-700 font-semibold rounded-xl">
                    Mon espace
                </a>
            @else
                <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full px-5 py-3 border-2 border-gray-200 text-gray-700 font-semibold rounded-xl">
                    Connexion
                </a>
            @endauth
        </div>
    </div>
</header>

{{-- Spacer - Matches navbar height when scrolled/not scrolled --}}
<div class="h-[104px] sm:h-[116px]"></div>

<style>
[x-cloak] { display: none !important; }
</style>
