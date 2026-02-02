<div class="flex flex-col h-full">
    <!-- Logo Area - Premium Design -->
    <div class="flex items-center h-[4.5rem] px-5 bg-gradient-to-b from-primary-800/60 to-primary-800/30 border-b border-primary-500/20">
        <a href="{{ route('dashboard') }}"
           class="flex items-center space-x-3.5 group focus:outline-none focus-visible:ring-2 focus-visible:ring-gold-400 focus-visible:ring-offset-2 focus-visible:ring-offset-primary-800 rounded-xl px-2.5 py-2 -mx-2 transition-all duration-300 hover:bg-white/5">
            <div class="relative">
                <div class="w-10 h-10 bg-gradient-to-br from-gold-400 via-gold-500 to-gold-600 rounded-xl flex items-center justify-center shadow-lg shadow-gold-500/20 group-hover:shadow-gold-500/40 transition-all duration-300 group-hover:scale-105">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <!-- Glow effect -->
                <div class="absolute inset-0 bg-gold-400/20 rounded-xl blur-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300" aria-hidden="true"></div>
            </div>
            <div class="flex flex-col">
                <span class="text-xl font-bold text-white leading-tight tracking-tight">Poimen</span>
                <span class="text-[10px] text-gold-400 uppercase tracking-[0.2em] font-semibold">Church Admin</span>
            </div>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto scrollbar-thin" aria-label="Navigation principale">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="nav-link {{ request()->routeIs('dashboard') ? 'nav-link-active' : '' }}"
           {{ request()->routeIs('dashboard') ? 'aria-current=page' : '' }}>
            <span class="nav-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </span>
            <span class="nav-text">{{ __('app.dashboard.title') }}</span>
        </a>

        @can('members.view')
        <!-- Members -->
        <a href="{{ route('members.index') }}"
           class="nav-link {{ request()->routeIs('members.*') ? 'nav-link-active' : '' }}"
           {{ request()->routeIs('members.*') ? 'aria-current=page' : '' }}>
            <span class="nav-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                </svg>
            </span>
            <span class="nav-text">{{ __('app.nav.members') }}</span>
        </a>
        @endcan

        <!-- Structures Section -->
        @canany(['branches.view', 'zones.view', 'bacentas.view', 'departments.view'])
        <div class="nav-section">
            <span class="nav-section-title">{{ __('app.nav.structures') }}</span>
        </div>

        @can('branches.view')
        <a href="{{ route('branches.index') }}"
           class="nav-link {{ request()->routeIs('branches.*') ? 'nav-link-active' : '' }}"
           {{ request()->routeIs('branches.*') ? 'aria-current=page' : '' }}>
            <span class="nav-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </span>
            <span class="nav-text">{{ __('app.nav.branches') }}</span>
        </a>
        @endcan

        @can('zones.view')
        <a href="{{ route('zones.index') }}"
           class="nav-link {{ request()->routeIs('zones.*') ? 'nav-link-active' : '' }}"
           {{ request()->routeIs('zones.*') ? 'aria-current=page' : '' }}>
            <span class="nav-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                </svg>
            </span>
            <span class="nav-text">{{ __('app.nav.zones') }}</span>
        </a>
        @endcan

        @can('bacentas.view')
        <a href="{{ route('bacentas.index') }}"
           class="nav-link {{ request()->routeIs('bacentas.*') ? 'nav-link-active' : '' }}"
           {{ request()->routeIs('bacentas.*') ? 'aria-current=page' : '' }}>
            <span class="nav-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </span>
            <span class="nav-text">{{ __('app.nav.bacentas') }}</span>
        </a>
        @endcan

        @can('departments.view')
        <a href="{{ route('departments.index') }}"
           class="nav-link {{ request()->routeIs('departments.*') ? 'nav-link-active' : '' }}"
           {{ request()->routeIs('departments.*') ? 'aria-current=page' : '' }}>
            <span class="nav-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </span>
            <span class="nav-text">{{ __('app.nav.departments') }}</span>
        </a>
        @endcan
        @endcanany

        <!-- Reports Section -->
        @can('reports.view')
        <div class="nav-section">
            <span class="nav-section-title">{{ __('app.nav.reports') }}</span>
        </div>

        <a href="{{ route('reports.index') }}"
           class="nav-link {{ request()->routeIs('reports.index') || request()->routeIs('reports.show') ? 'nav-link-active' : '' }}"
           {{ request()->routeIs('reports.index') ? 'aria-current=page' : '' }}>
            <span class="nav-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </span>
            <span class="nav-text">{{ __('app.nav.attendance') }}</span>
        </a>

        @can('reports.create')
        <a href="{{ route('reports.create') }}"
           class="nav-link nav-link-accent {{ request()->routeIs('reports.create') ? 'nav-link-active' : '' }}"
           {{ request()->routeIs('reports.create') ? 'aria-current=page' : '' }}>
            <span class="nav-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </span>
            <span class="nav-text">{{ __('app.attendance.submit_report') }}</span>
        </a>
        @endcan

        <a href="{{ route('reports.weekly') }}"
           class="nav-link {{ request()->routeIs('reports.weekly') ? 'nav-link-active' : '' }}"
           {{ request()->routeIs('reports.weekly') ? 'aria-current=page' : '' }}>
            <span class="nav-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </span>
            <span class="nav-text">{{ __('app.attendance.weekly_report') }}</span>
        </a>
        @endcan

        <!-- Finances Section -->
        @canany(['finances.view', 'finances.view.own'])
        <div class="nav-section">
            <span class="nav-section-title">{{ __('app.nav.finances') }}</span>
        </div>

        @can('finances.view')
        <a href="{{ route('finances.index') }}"
           class="nav-link {{ request()->routeIs('finances.index') || request()->routeIs('finances.show') ? 'nav-link-active' : '' }}"
           {{ request()->routeIs('finances.index') ? 'aria-current=page' : '' }}>
            <span class="nav-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </span>
            <span class="nav-text">{{ __('app.finances.title') }}</span>
        </a>
        @endcan

        <a href="{{ route('finances.my-donations') }}"
           class="nav-link {{ request()->routeIs('finances.my-donations') ? 'nav-link-active' : '' }}"
           {{ request()->routeIs('finances.my-donations') ? 'aria-current=page' : '' }}>
            <span class="nav-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </span>
            <span class="nav-text">{{ __('app.finances.my_donations') }}</span>
        </a>

        @can('finances.view')
        <a href="{{ route('finances.annual') }}"
           class="nav-link {{ request()->routeIs('finances.annual') ? 'nav-link-active' : '' }}"
           {{ request()->routeIs('finances.annual') ? 'aria-current=page' : '' }}>
            <span class="nav-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </span>
            <span class="nav-text">{{ __('app.finances.annual_summary') }}</span>
        </a>
        @endcan
        @endcanany

        <!-- Events Section -->
        <div class="nav-section">
            <span class="nav-section-title">Contenu</span>
        </div>

        <a href="{{ route('admin.events.index') }}"
           class="nav-link {{ request()->routeIs('admin.events.*') ? 'nav-link-active' : '' }}"
           {{ request()->routeIs('admin.events.*') ? 'aria-current=page' : '' }}>
            <span class="nav-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </span>
            <span class="nav-text">Événements</span>
        </a>

        <a href="{{ route('admin.schedules.index') }}"
           class="nav-link {{ request()->routeIs('admin.schedules.*') ? 'nav-link-active' : '' }}"
           {{ request()->routeIs('admin.schedules.*') ? 'aria-current=page' : '' }}>
            <span class="nav-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </span>
            <span class="nav-text">Horaires des Cultes</span>
        </a>

        <a href="{{ route('admin.testimonials.index') }}"
           class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'nav-link-active' : '' }}"
           {{ request()->routeIs('admin.testimonials.*') ? 'aria-current=page' : '' }}>
            <span class="nav-icon">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
            </span>
            <span class="nav-text">Temoignages</span>
        </a>
    </nav>

    <!-- User Info - Premium Design -->
    <div class="p-4 border-t border-primary-500/20 bg-gradient-to-t from-primary-900/50 to-transparent">
        <a href="{{ route('profile.show') }}"
           class="flex items-center p-3 rounded-2xl bg-white/5 hover:bg-white/10 transition-all duration-300 group focus:outline-none focus-visible:ring-2 focus-visible:ring-gold-400 border border-transparent hover:border-white/10">
            @if(auth()->user()->photo)
                <img src="{{ Storage::url(auth()->user()->photo) }}" alt="" class="w-11 h-11 rounded-xl object-cover ring-2 ring-white/20 group-hover:ring-gold-400/50 transition-all duration-300 group-hover:scale-105">
            @else
                <div class="w-11 h-11 bg-gradient-to-br from-primary-400 to-primary-600 rounded-xl flex items-center justify-center text-white text-sm font-bold ring-2 ring-white/20 group-hover:ring-gold-400/50 transition-all duration-300 group-hover:scale-105 shadow-lg">
                    {{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
                </div>
            @endif
            <div class="ml-3.5 flex-1 min-w-0">
                <p class="text-sm font-bold text-white truncate">{{ auth()->user()->full_name }}</p>
                <p class="text-xs text-white/50 truncate flex items-center gap-1.5 mt-0.5">
                    <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span>
                    {{ auth()->user()->roles->first()?->name ?? 'Membre' }}
                </p>
            </div>
            <div class="p-1.5 rounded-lg bg-white/5 group-hover:bg-gold-500/20 transition-all duration-300">
                <svg class="w-4 h-4 text-white/50 group-hover:text-gold-400 transition-colors shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </a>
    </div>
</div>

<style>
    /* Premium Navigation Link Styles */
    .nav-link {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        color: rgba(255, 255, 255, 0.7);
        border-radius: 0.875rem;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        font-size: 0.875rem;
        font-weight: 500;
        letter-spacing: 0.01em;
    }

    .nav-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 0;
        background: linear-gradient(180deg, var(--color-gold-400, #d4cc82), var(--color-gold-500, #c9a227));
        border-radius: 0 4px 4px 0;
        transition: height 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .nav-link:hover {
        background: linear-gradient(90deg, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0.04) 100%);
        color: white;
        transform: translateX(4px);
    }

    .nav-link:hover::before {
        height: 50%;
    }

    .nav-link:focus {
        outline: none;
    }

    .nav-link:focus-visible {
        outline: 2px solid var(--color-gold-400, #d4cc82);
        outline-offset: 2px;
    }

    .nav-link:active {
        transform: translateX(2px) scale(0.99);
    }

    .nav-link-active {
        background: linear-gradient(90deg, rgba(255, 255, 255, 0.12) 0%, rgba(255, 255, 255, 0.05) 100%);
        color: white;
        box-shadow:
            0 4px 12px -4px rgba(0, 0, 0, 0.2),
            inset 0 1px 0 rgba(255, 255, 255, 0.08);
    }

    .nav-link-active::before {
        height: 60%;
    }

    .nav-link-active:hover {
        transform: none;
    }

    .nav-link-accent:not(.nav-link-active) {
        background: linear-gradient(90deg, rgba(201, 162, 39, 0.18) 0%, rgba(201, 162, 39, 0.08) 100%);
        border: 1px solid rgba(201, 162, 39, 0.25);
        color: rgba(255, 255, 255, 0.9);
    }

    .nav-link-accent:not(.nav-link-active):hover {
        background: linear-gradient(90deg, rgba(201, 162, 39, 0.28) 0%, rgba(201, 162, 39, 0.15) 100%);
        border-color: rgba(201, 162, 39, 0.4);
        color: white;
    }

    .nav-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        margin-right: 0.75rem;
        opacity: 0.8;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        background: rgba(255, 255, 255, 0.05);
        border-radius: 0.625rem;
        padding: 0.375rem;
    }

    .nav-link:hover .nav-icon {
        opacity: 1;
        transform: scale(1.08);
        background: rgba(255, 255, 255, 0.1);
    }

    .nav-link-active .nav-icon {
        opacity: 1;
        background: rgba(201, 162, 39, 0.15);
    }

    .nav-text {
        flex: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Premium Section Styles */
    .nav-section {
        padding-top: 1.5rem;
        padding-bottom: 0.5rem;
    }

    .nav-section-title {
        display: flex;
        align-items: center;
        padding: 0 1rem;
        font-size: 0.625rem;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.35);
        text-transform: uppercase;
        letter-spacing: 0.15em;
    }

    .nav-section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        margin-left: 0.75rem;
        background: linear-gradient(90deg, rgba(255, 255, 255, 0.1), transparent);
    }

    /* Accessibility: Respect reduced motion */
    @media (prefers-reduced-motion: reduce) {
        .nav-link,
        .nav-icon,
        .nav-link::before {
            transition: none;
        }
        .nav-link:hover {
            transform: none;
        }
    }
</style>
