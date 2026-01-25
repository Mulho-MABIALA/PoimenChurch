<x-app-layout>
    <x-slot name="title">{{ __('app.dashboard.title') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.dashboard.overview'))

    <style>
        /* ========================================
           ACCESSIBILITY: Respect reduced motion
           ======================================== */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* ========================================
           ANIMATIONS
           ======================================== */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        @keyframes pulse-ring {
            0% { transform: scale(0.97); opacity: 1; }
            50% { transform: scale(1); opacity: 0.85; }
            100% { transform: scale(0.97); opacity: 1; }
        }
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        @keyframes count-up {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slide-in-right {
            from { opacity: 0; transform: translateX(16px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes subtle-bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-3px); }
        }

        .animate-float { animation: float 4s ease-in-out infinite; }
        .animate-pulse-ring { animation: pulse-ring 2.5s ease-in-out infinite; }
        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient-shift 10s ease infinite;
        }
        .animate-count { animation: count-up 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards; }
        .animate-slide-in { animation: slide-in-right 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards; }
        .animate-fade-up { animation: fade-in-up 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards; }

        /* Staggered animation delays with CSS custom properties */
        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }
        .stagger-4 { animation-delay: 0.4s; }
        .stagger-5 { animation-delay: 0.5s; }

        /* ========================================
           GLASSMORPHISM - Enhanced
           ======================================== */
        .glass {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 4px 24px -1px rgba(0, 0, 0, 0.08);
        }
        .glass-hover:hover {
            background: rgba(255, 255, 255, 0.18);
            border-color: rgba(255, 255, 255, 0.25);
        }

        /* ========================================
           STAT CARDS - Refined hover
           ======================================== */
        .stat-card-modern {
            transition: transform 0.25s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                        box-shadow 0.25s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: transform;
        }
        .stat-card-modern:hover {
            transform: translateY(-6px);
            box-shadow: 0 24px 48px -12px rgba(0, 0, 0, 0.18);
        }
        .stat-card-modern:focus-within {
            outline: 2px solid var(--color-primary-500, #4f6f3a);
            outline-offset: 2px;
        }

        /* ========================================
           SHIMMER - Smoother effect
           ======================================== */
        .shimmer {
            position: relative;
            overflow: hidden;
        }
        .shimmer::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255,255,255,0.25),
                transparent
            );
            animation: shimmer 2.5s ease-in-out infinite;
        }
        @keyframes shimmer {
            100% { left: 100%; }
        }

        /* ========================================
           INTERACTIVE ELEMENTS - Better feedback
           ======================================== */
        .interactive-card {
            transition: all 0.2s ease;
        }
        .interactive-card:hover {
            background-color: rgba(31, 77, 43, 0.04);
        }
        .interactive-card:active {
            transform: scale(0.99);
        }

        /* Focus visible for keyboard navigation */
        .focus-ring:focus-visible {
            outline: 2px solid var(--color-gold-500, #c9a227);
            outline-offset: 2px;
        }

        /* ========================================
           QUICK ACTION BUTTONS - Enhanced
           ======================================== */
        .btn-hero {
            position: relative;
            overflow: hidden;
            transition: all 0.25s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .btn-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255,255,255,0.15),
                transparent
            );
            transition: left 0.5s ease;
        }
        .btn-hero:hover::before {
            left: 100%;
        }
        .btn-hero:active {
            transform: scale(0.97);
        }

        /* ========================================
           RANKING ITEMS - Better hover states
           ======================================== */
        .ranking-item {
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }
        .ranking-item:hover {
            border-color: rgba(212, 168, 83, 0.3);
            transform: translateX(4px);
        }

        /* ========================================
           ACTIVITY ITEMS - Subtle hover
           ======================================== */
        .activity-item {
            transition: background-color 0.15s ease;
        }
        .activity-item:hover {
            background-color: #fafafa;
        }
    </style>

    <!-- Hero Section with Animated Background -->
    <section class="relative mb-10 overflow-hidden rounded-3xl shadow-2xl" aria-label="Bienvenue sur le tableau de bord">
        <!-- Animated Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary-800 via-primary-700 to-primary-900 animate-gradient" aria-hidden="true"></div>

        <!-- Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
            <div class="absolute -top-24 -right-24 w-80 h-80 md:w-96 md:h-96 bg-primary-500/15 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-32 -left-32 w-80 h-80 md:w-96 md:h-96 bg-gold-500/15 rounded-full blur-3xl animate-pulse stagger-2"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] md:w-[600px] h-[400px] md:h-[600px] bg-white/5 rounded-full blur-3xl"></div>
        </div>

        <!-- Pattern Overlay -->
        <div class="absolute inset-0 opacity-[0.07]" aria-hidden="true">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <circle cx="1" cy="1" r="0.5" fill="white"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)"/>
            </svg>
        </div>

        <!-- Content -->
        <div class="relative z-10 px-5 py-8 sm:p-8 lg:p-10">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
                <!-- Welcome Text -->
                <div class="space-y-5 max-w-2xl">
                    <div class="glass glass-hover inline-flex items-center px-4 py-2 rounded-full text-white text-sm font-medium transition-all duration-200">
                        <span class="w-2 h-2 bg-green-400 rounded-full mr-2.5 animate-pulse" aria-hidden="true"></span>
                        <time datetime="{{ now()->toDateString() }}">
                            {{ now()->locale(app()->getLocale())->isoFormat('dddd, D MMMM YYYY') }}
                        </time>
                    </div>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight tracking-tight">
                        {{ __('app.dashboard.welcome') }}, <br class="hidden sm:block"/>
                        <span class="bg-gradient-to-r from-gold-300 to-gold-400 bg-clip-text text-transparent">
                            {{ auth()->user()->first_name }}!
                        </span>
                    </h1>
                    <p class="text-primary-100/90 text-base sm:text-lg max-w-xl leading-relaxed">
                        Voici un aperçu complet de l'activité de votre église. Restez connecté avec votre communauté.
                    </p>
                </div>

                <!-- Quick Stats Cards - Improved responsive -->
                <div class="grid grid-cols-3 gap-3 sm:flex sm:flex-wrap sm:gap-4 w-full lg:w-auto">
                    @if(isset($stats['total_members']))
                    <div class="glass glass-hover rounded-2xl p-4 sm:p-5 sm:min-w-[140px] animate-float stagger-1 transition-all duration-200">
                        <div class="flex items-center justify-between mb-2.5 gap-2">
                            <span class="text-white/85 text-xs sm:text-sm font-medium truncate">Membres</span>
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gold-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <p class="text-2xl sm:text-3xl font-bold text-white counter tabular-nums" data-target="{{ $stats['total_members'] }}">0</p>
                    </div>
                    @endif

                    @if(isset($stats['total_bacentas']))
                    <div class="glass glass-hover rounded-2xl p-4 sm:p-5 sm:min-w-[140px] animate-float stagger-2 transition-all duration-200">
                        <div class="flex items-center justify-between mb-2.5 gap-2">
                            <span class="text-white/85 text-xs sm:text-sm font-medium truncate">Bacentas</span>
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-growth-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <p class="text-2xl sm:text-3xl font-bold text-white counter tabular-nums" data-target="{{ $stats['total_bacentas'] }}">0</p>
                    </div>
                    @endif

                    @if(isset($stats['weekly_attendance']))
                    <div class="glass glass-hover rounded-2xl p-4 sm:p-5 sm:min-w-[140px] animate-float stagger-3 transition-all duration-200">
                        <div class="flex items-center justify-between mb-2.5 gap-2">
                            <span class="text-white/85 text-xs sm:text-sm font-medium truncate">Présences</span>
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-2xl sm:text-3xl font-bold text-white counter tabular-nums" data-target="{{ $stats['weekly_attendance'] }}">0</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Quick Action Buttons - Enhanced -->
            <div class="mt-8 flex flex-col sm:flex-row flex-wrap gap-3">
                @can('reports.create')
                <a href="{{ route('reports.create') }}"
                   class="btn-hero group inline-flex items-center justify-center px-5 py-3 bg-white text-primary-700 font-semibold rounded-xl shadow-lg focus-ring">
                    <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nouveau rapport
                </a>
                @endcan
                @can('finances.create')
                <a href="{{ route('finances.create') }}"
                   class="btn-hero inline-flex items-center justify-center px-5 py-3 glass glass-hover text-white font-semibold rounded-xl focus-ring">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Enregistrer un don
                </a>
                @endcan
            </div>
        </div>
    </section>

    <!-- Main Stats Grid - Consistent vertical rhythm -->
    <section class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5 mb-10" aria-label="Statistiques principales">
        @if(isset($stats['weekly_offerings']))
        <article class="stat-card-modern col-span-2 lg:col-span-1 bg-gradient-to-br from-gold-500 to-gold-600 rounded-2xl p-5 sm:p-6 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-28 h-28 sm:w-32 sm:h-32 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2" aria-hidden="true"></div>
            <div class="absolute bottom-0 left-0 w-20 h-20 sm:w-24 sm:h-24 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/2" aria-hidden="true"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-3 sm:mb-4">
                    <span class="text-white/90 text-xs sm:text-sm font-semibold uppercase tracking-wider">Offrandes</span>
                    <div class="p-2 bg-white/20 rounded-xl" aria-hidden="true">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl sm:text-4xl font-bold mb-1 tabular-nums">{{ number_format($stats['weekly_offerings'], 0, ',', ' ') }}</p>
                <p class="text-white/80 text-xs sm:text-sm font-medium">XOF cette semaine</p>
            </div>
        </article>
        @endif

        @if(isset($stats['total_zones']))
        <article class="stat-card-modern bg-white rounded-2xl p-5 sm:p-6 border border-gray-100/80 shadow-sm relative overflow-hidden group focus-within:ring-2 focus-within:ring-primary-500 focus-within:ring-offset-2">
            <div class="absolute inset-0 bg-gradient-to-br from-primary-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200" aria-hidden="true"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-3 sm:mb-4">
                    <span class="text-gray-600 text-xs sm:text-sm font-semibold uppercase tracking-wider">Zones</span>
                    <div class="p-2 bg-primary-100 rounded-xl group-hover:bg-primary-200 transition-colors duration-200" aria-hidden="true">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl sm:text-4xl font-bold text-gray-900 mb-1 counter tabular-nums" data-target="{{ $stats['total_zones'] }}">0</p>
                <p class="text-gray-500 text-xs sm:text-sm">zones actives</p>
            </div>
        </article>
        @endif

        @if(isset($stats['total_branches']))
        <article class="stat-card-modern bg-white rounded-2xl p-5 sm:p-6 border border-gray-100/80 shadow-sm relative overflow-hidden group focus-within:ring-2 focus-within:ring-primary-500 focus-within:ring-offset-2">
            <div class="absolute inset-0 bg-gradient-to-br from-growth-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200" aria-hidden="true"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-3 sm:mb-4">
                    <span class="text-gray-600 text-xs sm:text-sm font-semibold uppercase tracking-wider">Branches</span>
                    <div class="p-2 bg-growth-100 rounded-xl group-hover:bg-growth-200 transition-colors duration-200" aria-hidden="true">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-growth-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl sm:text-4xl font-bold text-gray-900 mb-1 counter tabular-nums" data-target="{{ $stats['total_branches'] }}">0</p>
                <p class="text-gray-500 text-xs sm:text-sm">branches établies</p>
            </div>
        </article>
        @endif

        @if(isset($stats['pending_reports']))
        <article class="stat-card-modern bg-white rounded-2xl p-5 sm:p-6 border border-gray-100/80 shadow-sm relative overflow-hidden group focus-within:ring-2 focus-within:ring-orange-500 focus-within:ring-offset-2">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200" aria-hidden="true"></div>
            <div class="relative">
                <div class="flex items-center justify-between mb-3 sm:mb-4">
                    <span class="text-gray-600 text-xs sm:text-sm font-semibold uppercase tracking-wider">En attente</span>
                    <div class="p-2 bg-orange-100 rounded-xl group-hover:bg-orange-200 transition-colors duration-200 animate-pulse-ring" aria-hidden="true">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl sm:text-4xl font-bold text-orange-600 mb-1 tabular-nums">{{ $stats['pending_reports'] ?? 0 }}</p>
                <p class="text-gray-500 text-xs sm:text-sm">rapports à soumettre</p>
            </div>
        </article>
        @endif
    </section>

    <!-- Charts & Data Section - Improved spacing -->
    <section class="grid grid-cols-1 xl:grid-cols-3 gap-5 md:gap-6 mb-10" aria-label="Graphiques et données">
        <!-- Main Chart -->
        @if(isset($charts['attendance']))
        <article class="xl:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden animate-fade-up">
            <header class="p-5 sm:p-6 border-b border-gray-100">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900">Évolution des présences</h3>
                        <p class="text-gray-500 text-sm mt-0.5">Tendance sur les 8 dernières semaines</p>
                    </div>
                    <div class="flex items-center">
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-700">
                            <span class="w-2 h-2 bg-primary-500 rounded-full mr-2" aria-hidden="true"></span>
                            Présences
                        </span>
                    </div>
                </div>
            </header>
            <div class="p-5 sm:p-6">
                <div class="h-72 sm:h-80">
                    <canvas id="attendanceChart" aria-label="Graphique d'évolution des présences"></canvas>
                </div>
            </div>
        </article>
        @endif

        <!-- Finance Donut Chart -->
        @if(isset($stats['monthly_tithes']) || isset($stats['weekly_offerings']))
        <article class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden animate-fade-up stagger-2">
            <header class="p-5 sm:p-6 border-b border-gray-100">
                <h3 class="text-lg sm:text-xl font-bold text-gray-900">Finances du mois</h3>
                <p class="text-gray-500 text-sm mt-0.5">Répartition des revenus</p>
            </header>
            <div class="p-5 sm:p-6">
                <div class="relative h-56 sm:h-64 flex items-center justify-center">
                    <canvas id="financeChart" aria-label="Graphique de répartition des finances"></canvas>
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none" aria-hidden="true">
                        <div class="text-center">
                            <p class="text-2xl sm:text-3xl font-bold text-gray-900 tabular-nums">{{ number_format(($stats['monthly_tithes'] ?? 0) + ($stats['weekly_offerings'] ?? 0), 0, ',', ' ') }}</p>
                            <p class="text-gray-500 text-xs sm:text-sm font-medium">XOF Total</p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 grid grid-cols-2 gap-4">
                    <div class="flex items-center p-2 rounded-lg hover:bg-gray-50 transition-colors">
                        <span class="w-3 h-3 bg-primary-500 rounded-full mr-2.5 shrink-0" aria-hidden="true"></span>
                        <span class="text-sm text-gray-700 font-medium">Dîmes</span>
                    </div>
                    <div class="flex items-center p-2 rounded-lg hover:bg-gray-50 transition-colors">
                        <span class="w-3 h-3 bg-gold-500 rounded-full mr-2.5 shrink-0" aria-hidden="true"></span>
                        <span class="text-sm text-gray-700 font-medium">Offrandes</span>
                    </div>
                </div>
            </div>
        </article>
        @endif
    </section>

    <!-- Bottom Section: Rankings & Recent Activity -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-5 md:gap-6" aria-label="Classements et activité récente">
        <!-- Top Bacentas -->
        @if(isset($topBacentas) && $topBacentas->count() > 0)
        <article class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden animate-fade-up stagger-3">
            <header class="p-5 sm:p-6 border-b border-gray-100 bg-gradient-to-r from-gold-50/80 to-white">
                <div class="flex items-center space-x-3">
                    <div class="p-2.5 bg-gradient-to-br from-gold-400 to-gold-600 rounded-xl shadow-lg" aria-hidden="true">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900">Top Bacentas</h3>
                        <p class="text-gray-500 text-xs sm:text-sm">Meilleures performances cette semaine</p>
                    </div>
                </div>
            </header>
            <div class="p-3 sm:p-4">
                <ul class="space-y-2.5" role="list">
                    @foreach($topBacentas as $index => $bacenta)
                    <li class="ranking-item flex items-center p-3 sm:p-4 rounded-xl bg-gray-50/80 group animate-slide-in stagger-{{ $index + 1 }}">
                        <div class="shrink-0">
                            @if($index === 0)
                            <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center bg-gradient-to-br from-gold-400 to-gold-600 text-white rounded-xl shadow-lg shimmer" aria-label="1ère place">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            @elseif($index === 1)
                            <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center bg-gradient-to-br from-gray-300 to-gray-400 text-white rounded-xl shadow-md" aria-label="2ème place">
                                <span class="text-lg sm:text-xl font-bold">2</span>
                            </div>
                            @elseif($index === 2)
                            <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center bg-gradient-to-br from-amber-600 to-amber-700 text-white rounded-xl shadow-md" aria-label="3ème place">
                                <span class="text-lg sm:text-xl font-bold">3</span>
                            </div>
                            @else
                            <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center bg-gray-200 text-gray-600 rounded-xl group-hover:bg-gold-100 transition-colors duration-200" aria-label="{{ $index + 1 }}ème place">
                                <span class="text-lg sm:text-xl font-bold">{{ $index + 1 }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="ml-3 sm:ml-4 flex-1 min-w-0">
                            <p class="font-semibold text-gray-900 truncate text-sm sm:text-base">{{ $bacenta->name }}</p>
                            <p class="text-xs sm:text-sm text-gray-500 truncate">{{ $bacenta->zone->name ?? 'Zone non assignée' }}</p>
                        </div>
                        <div class="text-right ml-2">
                            <p class="text-xl sm:text-2xl font-bold text-primary-700 tabular-nums">{{ $bacenta->total_attendance ?? 0 }}</p>
                            <p class="text-[10px] sm:text-xs text-gray-500 uppercase tracking-wide font-medium">présences</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </article>
        @endif

        <!-- Recent Reports -->
        @if(isset($recentReports) && $recentReports->count() > 0)
        <article class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden animate-fade-up stagger-4">
            <header class="p-5 sm:p-6 border-b border-gray-100 bg-gradient-to-r from-primary-50/80 to-white">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="p-2.5 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl shadow-lg" aria-hidden="true">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900">Activité récente</h3>
                            <p class="text-gray-500 text-xs sm:text-sm">Derniers rapports soumis</p>
                        </div>
                    </div>
                    <a href="{{ route('reports.index') }}"
                       class="text-xs sm:text-sm font-semibold text-primary-600 hover:text-primary-700 transition-colors inline-flex items-center focus-ring rounded-lg px-2 py-1 -mx-2 -my-1 hover:bg-primary-50">
                        Voir tout
                        <svg class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </header>
            <ul class="divide-y divide-gray-100" role="list">
                @foreach($recentReports->take(5) as $index => $report)
                <li class="activity-item p-3 sm:p-4 animate-slide-in stagger-{{ $index + 1 }}">
                    <div class="flex items-center">
                        <div class="shrink-0 w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-primary-100 to-primary-200 rounded-xl flex items-center justify-center" aria-hidden="true">
                            <span class="text-base sm:text-lg font-bold text-primary-700">{{ strtoupper(substr($report->bacenta->name, 0, 2)) }}</span>
                        </div>
                        <div class="ml-3 sm:ml-4 flex-1 min-w-0">
                            <div class="flex items-center flex-wrap gap-1.5 sm:gap-2">
                                <p class="font-semibold text-gray-900 truncate text-sm sm:text-base">{{ $report->bacenta->name }}</p>
                                @if($report->report_type === 'sunday_service')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] sm:text-xs font-semibold bg-primary-100 text-primary-700">
                                    Dimanche
                                </span>
                                @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] sm:text-xs font-semibold bg-gray-100 text-gray-600">
                                    Bacenta
                                </span>
                                @endif
                            </div>
                            <p class="text-xs sm:text-sm text-gray-500 mt-0.5">
                                <time datetime="{{ $report->report_date->toDateString() }}">{{ $report->report_date->diffForHumans() }}</time>
                            </p>
                        </div>
                        <div class="text-right ml-2">
                            <p class="font-bold text-gray-900 text-sm sm:text-base tabular-nums">
                                {{ $report->attendance_count }}
                                <span class="text-gray-400 text-xs font-normal">pers.</span>
                            </p>
                            <p class="text-xs sm:text-sm font-semibold text-gold-600 tabular-nums">{{ number_format($report->offering_amount, 0, ',', ' ') }} XOF</p>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </article>
        @endif
    </section>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Counter Animation
        document.querySelectorAll('.counter').forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;

            const updateCounter = () => {
                current += step;
                if (current < target) {
                    counter.textContent = Math.floor(current).toLocaleString('fr-FR');
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target.toLocaleString('fr-FR');
                }
            };

            // Start animation when element is visible
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateCounter();
                        observer.unobserve(entry.target);
                    }
                });
            });
            observer.observe(counter);
        });

        // Attendance Chart
        @if(isset($charts['attendance']))
        const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');

        const gradient = attendanceCtx.createLinearGradient(0, 0, 0, 320);
        gradient.addColorStop(0, 'rgba(31, 77, 43, 0.4)');
        gradient.addColorStop(0.5, 'rgba(31, 77, 43, 0.1)');
        gradient.addColorStop(1, 'rgba(31, 77, 43, 0)');

        new Chart(attendanceCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(collect($charts['attendance'])->pluck('week')) !!},
                datasets: [{
                    label: 'Présences',
                    data: {!! json_encode(collect($charts['attendance'])->pluck('value')) !!},
                    borderColor: '#1F4D2B',
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointBackgroundColor: '#1F4D2B',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 3,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: '#ffffff',
                    pointHoverBorderColor: '#1F4D2B',
                    pointHoverBorderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(31, 77, 43, 0.95)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: 'rgba(255,255,255,0.2)',
                        borderWidth: 1,
                        cornerRadius: 12,
                        padding: 16,
                        displayColors: false,
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 24, weight: 'bold' },
                        callbacks: {
                            title: (ctx) => 'Semaine du ' + ctx[0].label,
                            label: (ctx) => ctx.parsed.y.toLocaleString('fr-FR') + ' présences'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.04)', drawBorder: false },
                        ticks: { color: '#9ca3af', font: { size: 12 }, padding: 10 }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#9ca3af', font: { size: 12 }, padding: 10 }
                    }
                }
            }
        });
        @endif

        // Finance Donut Chart
        @if(isset($stats['monthly_tithes']) || isset($stats['weekly_offerings']))
        const financeCtx = document.getElementById('financeChart').getContext('2d');
        new Chart(financeCtx, {
            type: 'doughnut',
            data: {
                labels: ['Dîmes', 'Offrandes'],
                datasets: [{
                    data: [{{ $stats['monthly_tithes'] ?? 0 }}, {{ $stats['weekly_offerings'] ?? 0 }}],
                    backgroundColor: ['#1F4D2B', '#D4A853'],
                    borderColor: ['#ffffff', '#ffffff'],
                    borderWidth: 4,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        cornerRadius: 12,
                        padding: 16,
                        callbacks: {
                            label: (ctx) => ctx.label + ': ' + ctx.parsed.toLocaleString('fr-FR') + ' XOF'
                        }
                    }
                }
            }
        });
        @endif
    </script>
    @endpush
</x-app-layout>
