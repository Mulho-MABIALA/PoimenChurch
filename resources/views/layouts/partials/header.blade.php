<header class="flex items-center justify-between h-16 px-4 sm:px-6">
    <!-- Left side -->
    <div class="flex items-center gap-3">
        <!-- Mobile menu button -->
        <button onclick="toggleSidebar()"
                type="button"
                class="lg:hidden p-2 rounded-xl text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 transition-colors duration-200"
                aria-label="Ouvrir le menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <!-- Page Title -->
        <h1 class="text-base sm:text-lg font-semibold text-gray-900 truncate">
            @yield('page-title', __('app.dashboard.title'))
        </h1>
    </div>

    <!-- Right side -->
    <div class="flex items-center gap-2 sm:gap-3">
        <!-- Language Switcher -->
        <div class="relative" data-dropdown>
            <button onclick="this.nextElementSibling.classList.toggle('hidden')"
                    type="button"
                    class="flex items-center gap-1.5 px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-colors duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500"
                    aria-haspopup="true"
                    aria-label="Changer de langue">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                </svg>
                <span class="font-medium">{{ strtoupper(app()->getLocale()) }}</span>
                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div data-dropdown-menu class="dropdown-menu hidden" role="menu">
                <a href="{{ route('lang.switch', 'fr') }}"
                   class="dropdown-menu-item {{ app()->getLocale() === 'fr' ? 'dropdown-menu-item-active' : '' }}"
                   role="menuitem">
                    <span class="w-6 text-center">🇫🇷</span>
                    <span>Français</span>
                    @if(app()->getLocale() === 'fr')
                    <svg class="w-4 h-4 ml-auto text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    @endif
                </a>
                <a href="{{ route('lang.switch', 'en') }}"
                   class="dropdown-menu-item {{ app()->getLocale() === 'en' ? 'dropdown-menu-item-active' : '' }}"
                   role="menuitem">
                    <span class="w-6 text-center">🇬🇧</span>
                    <span>English</span>
                    @if(app()->getLocale() === 'en')
                    <svg class="w-4 h-4 ml-auto text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    @endif
                </a>
            </div>
        </div>

        <!-- User Menu -->
        <div class="relative" data-dropdown>
            <button onclick="this.nextElementSibling.classList.toggle('hidden')"
                    type="button"
                    class="flex items-center gap-2 p-1.5 sm:pr-3 rounded-xl hover:bg-gray-100 transition-colors duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500"
                    aria-haspopup="true"
                    aria-label="Menu utilisateur">
                @if(auth()->user()->photo)
                    <img src="{{ Storage::url(auth()->user()->photo) }}" alt="" class="w-8 h-8 rounded-lg object-cover ring-2 ring-gray-100">
                @else
                    <div class="w-8 h-8 bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg flex items-center justify-center text-white text-xs font-semibold ring-2 ring-gray-100">
                        {{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
                    </div>
                @endif
                <span class="hidden sm:block text-sm font-medium text-gray-700 max-w-[120px] truncate">{{ auth()->user()->full_name }}</span>
                <svg class="hidden sm:block w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div data-dropdown-menu class="dropdown-menu hidden w-56" role="menu">
                <!-- User Info Header -->
                <div class="px-4 py-3 border-b border-gray-100">
                    <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->full_name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                </div>

                <div class="py-1">
                    <a href="{{ route('profile.show') }}" class="dropdown-menu-item" role="menuitem">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>{{ __('app.nav.profile') }}</span>
                    </a>
                    <a href="{{ route('profile.edit') }}" class="dropdown-menu-item" role="menuitem">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>{{ __('app.nav.settings') }}</span>
                    </a>
                </div>

                <div class="border-t border-gray-100 py-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-menu-item dropdown-menu-item-danger w-full" role="menuitem">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>{{ __('app.nav.logout') }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    /* Dropdown Menu Styles */
    .dropdown-menu {
        position: absolute;
        right: 0;
        margin-top: 0.5rem;
        min-width: 12rem;
        background-color: white;
        border-radius: 0.75rem;
        box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.15), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.05);
        z-index: 50;
        overflow: hidden;
        animation: dropdown-enter 0.15s ease-out;
    }

    @keyframes dropdown-enter {
        from {
            opacity: 0;
            transform: translateY(-8px) scale(0.96);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .dropdown-menu-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.625rem 1rem;
        font-size: 0.875rem;
        color: #374151;
        transition: background-color 0.15s ease, color 0.15s ease;
    }

    .dropdown-menu-item:hover {
        background-color: #f9fafb;
    }

    .dropdown-menu-item:focus {
        outline: none;
        background-color: #f3f4f6;
    }

    .dropdown-menu-item-active {
        background-color: #f0f5f1;
        color: var(--color-primary-700, #1f4d2b);
    }

    .dropdown-menu-item-danger {
        color: #dc2626;
    }

    .dropdown-menu-item-danger:hover {
        background-color: #fef2f2;
    }

    /* Accessibility: Respect reduced motion */
    @media (prefers-reduced-motion: reduce) {
        .dropdown-menu {
            animation: none;
        }
    }
</style>
