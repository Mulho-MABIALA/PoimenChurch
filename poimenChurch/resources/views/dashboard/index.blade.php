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
           PREMIUM DASHBOARD ANIMATIONS
           ======================================== */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }
        @keyframes pulse-ring {
            0% { transform: scale(0.98); opacity: 1; }
            50% { transform: scale(1); opacity: 0.9; }
            100% { transform: scale(0.98); opacity: 1; }
        }
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        @keyframes count-up {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slide-in-right {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes subtle-scale {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }
        @keyframes shimmer-premium {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        @keyframes glow-pulse {
            0%, 100% { box-shadow: 0 0 20px rgba(201, 162, 39, 0.2); }
            50% { box-shadow: 0 0 35px rgba(201, 162, 39, 0.4); }
        }

        .animate-float { animation: float 5s ease-in-out infinite; }
        .animate-pulse-ring { animation: pulse-ring 3s ease-in-out infinite; }
        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient-shift 12s ease infinite;
        }
        .animate-count { animation: count-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .animate-slide-in { animation: slide-in-right 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .animate-fade-up { animation: fade-in-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .animate-glow { animation: glow-pulse 3s ease-in-out infinite; }

        /* Staggered animation delays */
        .stagger-1 { animation-delay: 0.05s; }
        .stagger-2 { animation-delay: 0.1s; }
        .stagger-3 { animation-delay: 0.15s; }
        .stagger-4 { animation-delay: 0.2s; }
        .stagger-5 { animation-delay: 0.25s; }
        .stagger-6 { animation-delay: 0.3s; }

        /* ========================================
           PREMIUM GLASSMORPHISM
           ======================================== */
        .glass-premium {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow:
                0 4px 30px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }
        .glass-premium:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow:
                0 8px 40px rgba(0, 0, 0, 0.12),
                inset 0 1px 0 rgba(255, 255, 255, 0.25);
        }

        /* ========================================
           PREMIUM STAT CARDS
           ======================================== */
        .stat-card-premium {
            position: relative;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: transform, box-shadow;
        }
        .stat-card-premium::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            opacity: 0;
            transition: opacity 0.4s ease;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 100%);
            pointer-events: none;
        }
        .stat-card-premium:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow:
                0 25px 50px -12px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.1);
        }
        .stat-card-premium:hover::before {
            opacity: 1;
        }
        .stat-card-premium:focus-within {
            outline: 2px solid var(--color-primary-500, #4f6f3a);
            outline-offset: 3px;
        }

        /* Card inner glow on hover */
        .stat-card-glow {
            position: relative;
            overflow: hidden;
        }
        .stat-card-glow::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.5s ease;
            pointer-events: none;
        }
        .stat-card-glow:hover::after {
            opacity: 1;
        }

        /* ========================================
           PREMIUM SHIMMER EFFECT
           ======================================== */
        .shimmer-premium {
            position: relative;
            overflow: hidden;
        }
        .shimmer-premium::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent 0%,
                rgba(255, 255, 255, 0.15) 50%,
                transparent 100%
            );
            background-size: 200% 100%;
            animation: shimmer-premium 3s ease-in-out infinite;
            pointer-events: none;
        }

        /* ========================================
           INTERACTIVE ELEMENTS
           ======================================== */
        .interactive-premium {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .interactive-premium:hover {
            background-color: rgba(31, 77, 43, 0.04);
            transform: translateX(4px);
        }
        .interactive-premium:active {
            transform: translateX(2px) scale(0.99);
        }

        /* Focus visible for keyboard navigation */
        .focus-ring:focus-visible {
            outline: 2px solid var(--color-gold-500, #c9a227);
            outline-offset: 3px;
            border-radius: inherit;
        }

        /* ========================================
           PREMIUM ACTION BUTTONS
           ======================================== */
        .btn-premium {
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .btn-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent
            );
            transition: left 0.6s ease;
        }
        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.2);
        }
        .btn-premium:hover::before {
            left: 100%;
        }
        .btn-premium:active {
            transform: translateY(0) scale(0.98);
        }

        /* ========================================
           PREMIUM RANKING ITEMS
           ======================================== */
        .ranking-premium {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            border: 1px solid transparent;
            position: relative;
        }
        .ranking-premium::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 0;
            background: linear-gradient(180deg, var(--color-gold-400), var(--color-gold-600));
            border-radius: 3px;
            transition: height 0.3s ease;
        }
        .ranking-premium:hover {
            background-color: rgba(212, 168, 83, 0.06);
            border-color: rgba(212, 168, 83, 0.15);
            transform: translateX(6px);
        }
        .ranking-premium:hover::before {
            height: 60%;
        }

        /* ========================================
           PREMIUM ACTIVITY ITEMS
           ======================================== */
        .activity-premium {
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            border-left: 3px solid transparent;
        }
        .activity-premium:hover {
            background-color: rgba(31, 77, 43, 0.03);
            border-left-color: var(--color-primary-500);
            padding-left: 1.25rem;
        }

        /* ========================================
           PREMIUM CHART CONTAINER
           ======================================== */
        .chart-container-premium {
            position: relative;
        }
        .chart-container-premium::before {
            content: '';
            position: absolute;
            inset: -1px;
            border-radius: inherit;
            padding: 1px;
            background: linear-gradient(135deg, rgba(31, 77, 43, 0.1), rgba(201, 162, 39, 0.1));
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .chart-container-premium:hover::before {
            opacity: 1;
        }

        /* ========================================
           PREMIUM SECTION HEADERS
           ======================================== */
        .section-header-premium {
            position: relative;
        }
        .section-header-premium::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--color-primary-500), var(--color-gold-500));
            border-radius: 3px;
        }

        /* ========================================
           NUMBER DISPLAY
           ======================================== */
        .number-premium {
            font-variant-numeric: tabular-nums;
            letter-spacing: -0.02em;
        }

        /* ========================================
           BADGE PREMIUM
           ======================================== */
        .badge-premium {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.375rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.025em;
            transition: all 0.2s ease;
        }
        .badge-premium:hover {
            transform: scale(1.05);
        }
    </style>

    <!-- Hero Section - Premium Design -->
    <section class="relative mb-12 overflow-hidden rounded-[2rem] shadow-2xl" aria-label="Bienvenue sur le tableau de bord">
        <!-- Animated Gradient Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary-800 via-primary-700 to-primary-900 animate-gradient" aria-hidden="true"></div>

        <!-- Premium Decorative Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
            <!-- Floating orbs with blur -->
            <div class="absolute -top-20 -right-20 w-72 h-72 md:w-[400px] md:h-[400px] bg-primary-500/20 rounded-full blur-[100px] animate-float"></div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 md:w-[350px] md:h-[350px] bg-gold-500/20 rounded-full blur-[80px] animate-float stagger-2"></div>
            <div class="absolute top-1/3 right-1/4 w-48 h-48 bg-white/5 rounded-full blur-[60px] animate-float stagger-3"></div>
            <!-- Central glow -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] md:w-[700px] h-[500px] md:h-[700px] bg-gradient-radial from-white/5 to-transparent rounded-full"></div>
        </div>

        <!-- Premium Pattern Overlay -->
        <div class="absolute inset-0 opacity-[0.05]" aria-hidden="true">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="grid-premium" width="8" height="8" patternUnits="userSpaceOnUse">
                        <circle cx="1" cy="1" r="0.4" fill="white"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid-premium)"/>
            </svg>
        </div>

        <!-- Content -->
        <div class="relative z-10 px-6 py-10 sm:p-10 lg:p-12">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10">
                <!-- Welcome Text -->
                <div class="space-y-6 max-w-2xl">
                    <!-- Date Badge -->
                    <div class="glass-premium inline-flex items-center px-5 py-2.5 rounded-full text-white text-sm font-medium transition-all duration-300 hover:scale-105">
                        <span class="relative flex h-2.5 w-2.5 mr-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-400"></span>
                        </span>
                        <time datetime="{{ now()->toDateString() }}" class="tracking-wide">
                            {{ now()->locale(app()->getLocale())->isoFormat('dddd, D MMMM YYYY') }}
                        </time>
                    </div>

                    <!-- Welcome Title -->
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-[3.5rem] font-bold text-white leading-[1.1] tracking-tight">
                        {{ __('app.dashboard.welcome') }}, <br class="hidden sm:block"/>
                        <span class="bg-gradient-to-r from-gold-300 via-gold-400 to-gold-300 bg-clip-text text-transparent animate-gradient bg-[length:200%_auto]">
                            {{ auth()->user()->first_name }}!
                        </span>
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-primary-100/90 text-lg sm:text-xl max-w-xl leading-relaxed font-light">
                        Voici un aperçu complet de l'activité de votre église. Restez connecté avec votre communauté.
                    </p>
                </div>

                <!-- Quick Stats Cards - Premium Glass -->
                <div class="grid grid-cols-3 gap-4 sm:flex sm:flex-wrap sm:gap-5 w-full lg:w-auto">
                    @if(isset($stats['total_members']))
                    <div class="glass-premium rounded-2xl p-5 sm:p-6 sm:min-w-[160px] animate-float stagger-1 transition-all duration-300 hover:scale-105 group">
                        <div class="flex items-center justify-between mb-3 gap-2">
                            <span class="text-white/80 text-xs sm:text-sm font-semibold uppercase tracking-wider truncate">Membres</span>
                            <div class="p-2 rounded-xl bg-gold-500/20 group-hover:bg-gold-500/30 transition-colors">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl sm:text-4xl font-bold text-white counter number-premium" data-target="{{ $stats['total_members'] }}">0</p>
                    </div>
                    @endif

                    @if(isset($stats['total_bacentas']))
                    <div class="glass-premium rounded-2xl p-5 sm:p-6 sm:min-w-[160px] animate-float stagger-2 transition-all duration-300 hover:scale-105 group">
                        <div class="flex items-center justify-between mb-3 gap-2">
                            <span class="text-white/80 text-xs sm:text-sm font-semibold uppercase tracking-wider truncate">Bacentas</span>
                            <div class="p-2 rounded-xl bg-growth-500/20 group-hover:bg-growth-500/30 transition-colors">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-growth-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl sm:text-4xl font-bold text-white counter number-premium" data-target="{{ $stats['total_bacentas'] }}">0</p>
                    </div>
                    @endif

                    @if(isset($stats['weekly_attendance']))
                    <div class="glass-premium rounded-2xl p-5 sm:p-6 sm:min-w-[160px] animate-float stagger-3 transition-all duration-300 hover:scale-105 group">
                        <div class="flex items-center justify-between mb-3 gap-2">
                            <span class="text-white/80 text-xs sm:text-sm font-semibold uppercase tracking-wider truncate">Présences</span>
                            <div class="p-2 rounded-xl bg-blue-500/20 group-hover:bg-blue-500/30 transition-colors">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl sm:text-4xl font-bold text-white counter number-premium" data-target="{{ $stats['weekly_attendance'] }}">0</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Quick Action Buttons - Premium Style -->
            <div class="mt-10 flex flex-col sm:flex-row flex-wrap gap-4">
                @can('reports.create')
                <a href="{{ route('reports.create') }}"
                   class="btn-premium group inline-flex items-center justify-center px-6 py-3.5 bg-white text-primary-700 font-semibold rounded-2xl shadow-lg shadow-black/10 focus-ring">
                    <svg class="w-5 h-5 mr-2.5 group-hover:rotate-90 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nouveau rapport
                </a>
                @endcan
                @can('finances.create')
                <a href="{{ route('finances.create') }}"
                   class="btn-premium inline-flex items-center justify-center px-6 py-3.5 glass-premium text-white font-semibold rounded-2xl focus-ring">
                    <svg class="w-5 h-5 mr-2.5 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Enregistrer un don
                </a>
                @endcan
            </div>
        </div>
    </section>

    <!-- Main Stats Grid - Premium Design -->
    <section class="grid grid-cols-2 lg:grid-cols-4 gap-5 md:gap-6 mb-12" aria-label="Statistiques principales">
        @if(isset($stats['weekly_offerings']))
        <article class="stat-card-premium stat-card-glow col-span-2 lg:col-span-1 bg-gradient-to-br from-gold-500 via-gold-500 to-gold-600 rounded-[1.25rem] p-6 sm:p-7 text-white relative overflow-hidden animate-fade-up">
            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-32 h-32 sm:w-40 sm:h-40 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-sm" aria-hidden="true"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 sm:w-28 sm:h-28 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/2 blur-sm" aria-hidden="true"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-48 h-48 bg-white/5 rounded-full blur-2xl" aria-hidden="true"></div>

            <div class="relative">
                <div class="flex items-center justify-between mb-4 sm:mb-5">
                    <span class="text-white/95 text-xs sm:text-sm font-bold uppercase tracking-wider">Offrandes</span>
                    <div class="p-2.5 bg-white/20 rounded-xl backdrop-blur-sm shadow-inner" aria-hidden="true">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-4xl sm:text-5xl font-bold mb-2 number-premium tracking-tight">{{ number_format($stats['weekly_offerings'], 0, ',', ' ') }}</p>
                <p class="text-white/85 text-sm font-medium flex items-center gap-2">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-white/20 backdrop-blur-sm">XOF</span>
                    cette semaine
                </p>
            </div>
        </article>
        @endif

        @if(isset($stats['total_zones']))
        <article class="stat-card-premium bg-white rounded-[1.25rem] p-6 sm:p-7 border border-gray-100 shadow-sm shadow-gray-100/50 relative overflow-hidden group animate-fade-up stagger-1">
            <!-- Hover gradient overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-primary-50/80 via-primary-50/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500" aria-hidden="true"></div>

            <div class="relative">
                <div class="flex items-center justify-between mb-4 sm:mb-5">
                    <span class="text-gray-500 text-xs sm:text-sm font-bold uppercase tracking-wider">Zones</span>
                    <div class="p-2.5 bg-primary-100 rounded-xl group-hover:bg-primary-200 group-hover:scale-110 transition-all duration-300" aria-hidden="true">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-4xl sm:text-5xl font-bold text-gray-900 mb-2 counter number-premium tracking-tight" data-target="{{ $stats['total_zones'] }}">0</p>
                <p class="text-gray-500 text-sm font-medium">zones actives</p>
            </div>
        </article>
        @endif

        @if(isset($stats['total_branches']))
        <article class="stat-card-premium bg-white rounded-[1.25rem] p-6 sm:p-7 border border-gray-100 shadow-sm shadow-gray-100/50 relative overflow-hidden group animate-fade-up stagger-2">
            <!-- Hover gradient overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-growth-50/80 via-growth-50/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500" aria-hidden="true"></div>

            <div class="relative">
                <div class="flex items-center justify-between mb-4 sm:mb-5">
                    <span class="text-gray-500 text-xs sm:text-sm font-bold uppercase tracking-wider">Branches</span>
                    <div class="p-2.5 bg-growth-100 rounded-xl group-hover:bg-growth-200 group-hover:scale-110 transition-all duration-300" aria-hidden="true">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-growth-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                </div>
                <p class="text-4xl sm:text-5xl font-bold text-gray-900 mb-2 counter number-premium tracking-tight" data-target="{{ $stats['total_branches'] }}">0</p>
                <p class="text-gray-500 text-sm font-medium">branches établies</p>
            </div>
        </article>
        @endif

        @if(isset($stats['pending_reports']))
        <article class="stat-card-premium bg-white rounded-[1.25rem] p-6 sm:p-7 border border-gray-100 shadow-sm shadow-gray-100/50 relative overflow-hidden group animate-fade-up stagger-3">
            <!-- Hover gradient overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-orange-50/80 via-orange-50/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500" aria-hidden="true"></div>

            <div class="relative">
                <div class="flex items-center justify-between mb-4 sm:mb-5">
                    <span class="text-gray-500 text-xs sm:text-sm font-bold uppercase tracking-wider">En attente</span>
                    <div class="p-2.5 bg-orange-100 rounded-xl group-hover:bg-orange-200 transition-all duration-300 animate-pulse-ring" aria-hidden="true">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-4xl sm:text-5xl font-bold text-orange-600 mb-2 number-premium tracking-tight">{{ $stats['pending_reports'] ?? 0 }}</p>
                <div class="flex items-center gap-2">
                    <p class="text-gray-500 text-sm font-medium">rapports à soumettre</p>
                    @if(($stats['pending_reports'] ?? 0) > 0)
                    <span class="badge-premium bg-orange-100 text-orange-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span>
                        Action requise
                    </span>
                    @endif
                </div>
            </div>
        </article>
        @endif
    </section>

    <!-- Charts & Data Section - Premium Design -->
    <section class="grid grid-cols-1 xl:grid-cols-3 gap-6 md:gap-8 mb-12" aria-label="Graphiques et données">
        <!-- Main Attendance Chart -->
        @if(isset($charts['attendance']))
        <article class="xl:col-span-2 chart-container-premium bg-white rounded-[1.25rem] shadow-sm shadow-gray-100/50 border border-gray-100 overflow-hidden animate-fade-up">
            <header class="p-6 sm:p-8 border-b border-gray-100/80 bg-gradient-to-r from-gray-50/50 to-white">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="section-header-premium pb-2">
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 tracking-tight">Évolution des présences</h3>
                        <p class="text-gray-500 text-sm mt-1.5 font-medium">Tendance sur les 8 dernières semaines</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="badge-premium bg-primary-50 text-primary-700 border border-primary-100">
                            <span class="w-2 h-2 bg-primary-500 rounded-full" aria-hidden="true"></span>
                            Présences
                        </span>
                    </div>
                </div>
            </header>
            <div class="p-6 sm:p-8">
                <div class="h-80 sm:h-96">
                    <canvas id="attendanceChart" aria-label="Graphique d'évolution des présences"></canvas>
                </div>
            </div>
        </article>
        @endif

        <!-- Finance Donut Chart -->
        @if(isset($stats['monthly_tithes']) || isset($stats['weekly_offerings']))
        <article class="chart-container-premium bg-white rounded-[1.25rem] shadow-sm shadow-gray-100/50 border border-gray-100 overflow-hidden animate-fade-up stagger-2">
            <header class="p-6 sm:p-8 border-b border-gray-100/80 bg-gradient-to-r from-gray-50/50 to-white">
                <div class="section-header-premium pb-2">
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 tracking-tight">Finances du mois</h3>
                    <p class="text-gray-500 text-sm mt-1.5 font-medium">Répartition des revenus</p>
                </div>
            </header>
            <div class="p-6 sm:p-8">
                <div class="relative h-64 sm:h-72 flex items-center justify-center">
                    <canvas id="financeChart" aria-label="Graphique de répartition des finances"></canvas>
                    <!-- Center Total Display -->
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none" aria-hidden="true">
                        <div class="text-center p-4 rounded-full bg-white/80 backdrop-blur-sm">
                            <p class="text-3xl sm:text-4xl font-bold text-gray-900 number-premium">{{ number_format(($stats['monthly_tithes'] ?? 0) + ($stats['weekly_offerings'] ?? 0), 0, ',', ' ') }}</p>
                            <p class="text-gray-500 text-sm font-semibold uppercase tracking-wider mt-1">XOF Total</p>
                        </div>
                    </div>
                </div>
                <!-- Legend -->
                <div class="mt-6 grid grid-cols-2 gap-4">
                    <div class="flex items-center p-3 rounded-xl bg-gray-50/80 hover:bg-gray-100/80 transition-all duration-200 cursor-default group">
                        <span class="w-4 h-4 bg-gradient-to-br from-primary-400 to-primary-600 rounded-lg mr-3 shrink-0 shadow-sm group-hover:scale-110 transition-transform" aria-hidden="true"></span>
                        <div>
                            <span class="text-sm text-gray-900 font-semibold">Dîmes</span>
                            <p class="text-xs text-gray-500 number-premium">{{ number_format($stats['monthly_tithes'] ?? 0, 0, ',', ' ') }} XOF</p>
                        </div>
                    </div>
                    <div class="flex items-center p-3 rounded-xl bg-gray-50/80 hover:bg-gray-100/80 transition-all duration-200 cursor-default group">
                        <span class="w-4 h-4 bg-gradient-to-br from-gold-400 to-gold-600 rounded-lg mr-3 shrink-0 shadow-sm group-hover:scale-110 transition-transform" aria-hidden="true"></span>
                        <div>
                            <span class="text-sm text-gray-900 font-semibold">Offrandes</span>
                            <p class="text-xs text-gray-500 number-premium">{{ number_format($stats['weekly_offerings'] ?? 0, 0, ',', ' ') }} XOF</p>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        @endif
    </section>

    <!-- Bottom Section: Rankings & Recent Activity - Premium Design -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8" aria-label="Classements et activité récente">
        <!-- Top Bacentas Ranking -->
        @if(isset($topBacentas) && $topBacentas->count() > 0)
        <article class="bg-white rounded-[1.25rem] shadow-sm shadow-gray-100/50 border border-gray-100 overflow-hidden animate-fade-up stagger-3">
            <header class="p-6 sm:p-8 border-b border-gray-100/80 bg-gradient-to-r from-gold-50/60 via-gold-50/30 to-white">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-gradient-to-br from-gold-400 to-gold-600 rounded-2xl shadow-lg shadow-gold-500/25 animate-glow" aria-hidden="true">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <div class="section-header-premium pb-1">
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 tracking-tight">Top Bacentas</h3>
                        <p class="text-gray-500 text-sm mt-1 font-medium">Meilleures performances cette semaine</p>
                    </div>
                </div>
            </header>
            <div class="p-4 sm:p-6">
                <ul class="space-y-3" role="list">
                    @foreach($topBacentas as $index => $bacenta)
                    <li class="ranking-premium flex items-center p-4 sm:p-5 rounded-2xl bg-gray-50/60 hover:bg-gold-50/50 group animate-slide-in stagger-{{ $index + 1 }}">
                        <div class="shrink-0">
                            @if($index === 0)
                            <div class="w-12 h-12 sm:w-14 sm:h-14 flex items-center justify-center bg-gradient-to-br from-gold-400 via-gold-500 to-gold-600 text-white rounded-2xl shadow-lg shadow-gold-500/30 shimmer-premium" aria-label="1ère place">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            @elseif($index === 1)
                            <div class="w-12 h-12 sm:w-14 sm:h-14 flex items-center justify-center bg-gradient-to-br from-gray-300 via-gray-350 to-gray-400 text-white rounded-2xl shadow-lg" aria-label="2ème place">
                                <span class="text-xl sm:text-2xl font-bold">2</span>
                            </div>
                            @elseif($index === 2)
                            <div class="w-12 h-12 sm:w-14 sm:h-14 flex items-center justify-center bg-gradient-to-br from-amber-500 via-amber-600 to-amber-700 text-white rounded-2xl shadow-lg" aria-label="3ème place">
                                <span class="text-xl sm:text-2xl font-bold">3</span>
                            </div>
                            @else
                            <div class="w-12 h-12 sm:w-14 sm:h-14 flex items-center justify-center bg-gray-100 text-gray-500 rounded-2xl group-hover:bg-gold-100 group-hover:text-gold-700 transition-all duration-300" aria-label="{{ $index + 1 }}ème place">
                                <span class="text-xl sm:text-2xl font-bold">{{ $index + 1 }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="ml-4 sm:ml-5 flex-1 min-w-0">
                            <p class="font-bold text-gray-900 truncate text-base sm:text-lg">{{ $bacenta->name }}</p>
                            <p class="text-sm text-gray-500 truncate mt-0.5 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                {{ $bacenta->zone->name ?? 'Zone non assignée' }}
                            </p>
                        </div>
                        <div class="text-right ml-3 flex flex-col items-end">
                            <p class="text-2xl sm:text-3xl font-bold text-primary-700 number-premium">{{ $bacenta->total_attendance ?? 0 }}</p>
                            <span class="badge-premium bg-primary-50 text-primary-600 text-[10px] sm:text-xs mt-1">
                                présences
                            </span>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </article>
        @endif

        <!-- Recent Reports Activity -->
        @if(isset($recentReports) && $recentReports->count() > 0)
        <article class="bg-white rounded-[1.25rem] shadow-sm shadow-gray-100/50 border border-gray-100 overflow-hidden animate-fade-up stagger-4">
            <header class="p-6 sm:p-8 border-b border-gray-100/80 bg-gradient-to-r from-primary-50/60 via-primary-50/30 to-white">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-gradient-to-br from-primary-500 to-primary-700 rounded-2xl shadow-lg shadow-primary-500/25" aria-hidden="true">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div class="section-header-premium pb-1">
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-900 tracking-tight">Activité récente</h3>
                            <p class="text-gray-500 text-sm mt-1 font-medium">Derniers rapports soumis</p>
                        </div>
                    </div>
                    <a href="{{ route('reports.index') }}"
                       class="btn-premium text-sm font-semibold text-primary-600 hover:text-primary-700 inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-primary-50 hover:bg-primary-100 focus-ring transition-all duration-300">
                        Voir tout
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </header>
            <ul class="divide-y divide-gray-100/80" role="list">
                @foreach($recentReports->take(5) as $index => $report)
                <li class="activity-premium p-4 sm:p-5 animate-slide-in stagger-{{ $index + 1 }}">
                    <div class="flex items-center">
                        <div class="shrink-0 w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-primary-100 via-primary-100 to-primary-200 rounded-2xl flex items-center justify-center shadow-sm" aria-hidden="true">
                            <span class="text-lg sm:text-xl font-bold text-primary-700">{{ strtoupper(substr($report->bacenta->name, 0, 2)) }}</span>
                        </div>
                        <div class="ml-4 sm:ml-5 flex-1 min-w-0">
                            <div class="flex items-center flex-wrap gap-2 sm:gap-2.5">
                                <p class="font-bold text-gray-900 truncate text-base sm:text-lg">{{ $report->bacenta->name }}</p>
                                @if($report->report_type === 'sunday_service')
                                <span class="badge-premium bg-primary-50 text-primary-700 border border-primary-100">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    Dimanche
                                </span>
                                @else
                                <span class="badge-premium bg-gray-100 text-gray-600 border border-gray-200">
                                    Bacenta
                                </span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-500 mt-1 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <time datetime="{{ $report->report_date->toDateString() }}">{{ $report->report_date->diffForHumans() }}</time>
                            </p>
                        </div>
                        <div class="text-right ml-3 flex flex-col items-end gap-1.5">
                            <div class="flex items-center gap-1.5 bg-gray-50 px-3 py-1.5 rounded-xl">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="font-bold text-gray-900 text-base number-premium">{{ $report->attendance_count }}</span>
                            </div>
                            <div class="flex items-center gap-1.5 bg-gold-50 px-3 py-1.5 rounded-xl">
                                <svg class="w-4 h-4 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="font-bold text-gold-700 text-sm number-premium">{{ number_format($report->offering_amount, 0, ',', ' ') }}</span>
                            </div>
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
        // Premium Counter Animation with easing
        document.querySelectorAll('.counter').forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 2500;
            let startTime = null;

            // Easing function for smooth animation
            const easeOutExpo = (t) => t === 1 ? 1 : 1 - Math.pow(2, -10 * t);

            const updateCounter = (timestamp) => {
                if (!startTime) startTime = timestamp;
                const progress = Math.min((timestamp - startTime) / duration, 1);
                const easedProgress = easeOutExpo(progress);
                const current = Math.floor(easedProgress * target);

                counter.textContent = current.toLocaleString('fr-FR');

                if (progress < 1) {
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target.toLocaleString('fr-FR');
                }
            };

            // Start animation when element is visible
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        requestAnimationFrame(updateCounter);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.3 });
            observer.observe(counter);
        });

        // Premium Attendance Chart
        @if(isset($charts['attendance']))
        const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');

        // Create premium gradient
        const gradient = attendanceCtx.createLinearGradient(0, 0, 0, 380);
        gradient.addColorStop(0, 'rgba(31, 77, 43, 0.35)');
        gradient.addColorStop(0.4, 'rgba(31, 77, 43, 0.15)');
        gradient.addColorStop(0.8, 'rgba(31, 77, 43, 0.05)');
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
                    tension: 0.45,
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#1F4D2B',
                    pointBorderWidth: 3,
                    pointRadius: 0,
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
                        borderColor: 'rgba(255,255,255,0.15)',
                        borderWidth: 1,
                        cornerRadius: 16,
                        padding: { top: 14, bottom: 14, left: 18, right: 18 },
                        displayColors: false,
                        titleFont: { size: 13, weight: '500', family: 'Inter' },
                        bodyFont: { size: 22, weight: '700', family: 'Inter' },
                        titleMarginBottom: 8,
                        callbacks: {
                            title: (ctx) => 'Semaine du ' + ctx[0].label,
                            label: (ctx) => ctx.parsed.y.toLocaleString('fr-FR') + ' présences'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        border: { display: false },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.04)',
                            drawBorder: false,
                            lineWidth: 1
                        },
                        ticks: {
                            color: '#9ca3af',
                            font: { size: 12, family: 'Inter', weight: '500' },
                            padding: 12,
                            callback: (value) => value.toLocaleString('fr-FR')
                        }
                    },
                    x: {
                        border: { display: false },
                        grid: { display: false },
                        ticks: {
                            color: '#9ca3af',
                            font: { size: 12, family: 'Inter', weight: '500' },
                            padding: 12
                        }
                    }
                },
                animation: {
                    duration: 1500,
                    easing: 'easeOutQuart'
                }
            }
        });
        @endif

        // Premium Finance Donut Chart
        @if(isset($stats['monthly_tithes']) || isset($stats['weekly_offerings']))
        const financeCtx = document.getElementById('financeChart').getContext('2d');

        // Create gradients for donut segments
        const primaryGradient = financeCtx.createLinearGradient(0, 0, 0, 300);
        primaryGradient.addColorStop(0, '#2d6a3c');
        primaryGradient.addColorStop(1, '#1F4D2B');

        const goldGradient = financeCtx.createLinearGradient(0, 0, 0, 300);
        goldGradient.addColorStop(0, '#e6b84d');
        goldGradient.addColorStop(1, '#D4A853');

        new Chart(financeCtx, {
            type: 'doughnut',
            data: {
                labels: ['Dîmes', 'Offrandes'],
                datasets: [{
                    data: [{{ $stats['monthly_tithes'] ?? 0 }}, {{ $stats['weekly_offerings'] ?? 0 }}],
                    backgroundColor: [primaryGradient, goldGradient],
                    borderColor: ['#ffffff', '#ffffff'],
                    borderWidth: 5,
                    hoverOffset: 15,
                    borderRadius: 6,
                    spacing: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.85)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        cornerRadius: 16,
                        padding: { top: 14, bottom: 14, left: 18, right: 18 },
                        titleFont: { size: 13, weight: '500', family: 'Inter' },
                        bodyFont: { size: 18, weight: '700', family: 'Inter' },
                        callbacks: {
                            label: (ctx) => ctx.label + ': ' + ctx.parsed.toLocaleString('fr-FR') + ' XOF'
                        }
                    }
                },
                animation: {
                    animateRotate: true,
                    animateScale: true,
                    duration: 1500,
                    easing: 'easeOutQuart'
                }
            }
        });
        @endif

        // Add scroll-triggered animations for sections
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.animate-fade-up, .animate-slide-in');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0) translateX(0)';
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

            elements.forEach(el => {
                el.style.opacity = '0';
                observer.observe(el);
            });
        };

        // Initialize scroll animations
        document.addEventListener('DOMContentLoaded', animateOnScroll);
    </script>
    @endpush
</x-app-layout>
