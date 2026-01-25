<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#1f4d2b">

    <title>{{ $title ?? config('app.name', 'Poimen Church') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Global UX Improvements */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Smooth page transitions */
        .page-enter {
            animation: page-fade-in 0.3s ease-out;
        }

        @keyframes page-fade-in {
            from {
                opacity: 0;
                transform: translateY(8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Alert animations */
        .alert-enter {
            animation: alert-slide-in 0.3s ease-out;
        }

        @keyframes alert-slide-in {
            from {
                opacity: 0;
                transform: translateY(-12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Focus improvements */
        :focus-visible {
            outline: 2px solid var(--color-primary-500, #4f6f3a);
            outline-offset: 2px;
        }

        /* Better scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
    </style>

    @stack('styles')
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-background">
        <!-- Sidebar -->
        <aside id="sidebar"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-primary-700 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-xl"
               aria-label="Navigation principale">
            @include('layouts.partials.sidebar')
        </aside>

        <!-- Overlay for mobile -->
        <div id="sidebar-overlay"
             class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm hidden lg:hidden transition-opacity duration-300"
             onclick="toggleSidebar()"
             aria-hidden="true"></div>

        <!-- Main Content -->
        <div class="lg:pl-64 min-h-screen flex flex-col">
            <!-- Top Navigation -->
            <header class="sticky top-0 z-30 bg-white/95 backdrop-blur-sm border-b border-gray-200/80 shadow-sm">
                @include('layouts.partials.header')
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-4 md:p-6 lg:p-8 page-enter">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert-success alert-enter mb-6 flex items-start gap-3 p-4 rounded-xl" role="alert">
                        <div class="shrink-0 w-5 h-5 mt-0.5">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium">{{ session('success') }}</p>
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" class="shrink-0 p-1 rounded-lg hover:bg-black/5 transition-colors" aria-label="Fermer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert-error alert-enter mb-6 flex items-start gap-3 p-4 rounded-xl" role="alert">
                        <div class="shrink-0 w-5 h-5 mt-0.5">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium">{{ session('error') }}</p>
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" class="shrink-0 p-1 rounded-lg hover:bg-black/5 transition-colors" aria-label="Fermer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endif

                @if(session('warning'))
                    <div class="alert-warning alert-enter mb-6 flex items-start gap-3 p-4 rounded-xl" role="alert">
                        <div class="shrink-0 w-5 h-5 mt-0.5">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium">{{ session('warning') }}</p>
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" class="shrink-0 p-1 rounded-lg hover:bg-black/5 transition-colors" aria-label="Fermer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endif

                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="py-4 px-6 text-center text-xs text-gray-500 border-t border-gray-100">
                <p>&copy; {{ date('Y') }} Poimen Church. Tous droits réservés.</p>
            </footer>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');

            // Accessibility: trap focus in sidebar when open on mobile
            if (!sidebar.classList.contains('-translate-x-full')) {
                sidebar.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            } else {
                sidebar.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('[data-dropdown]');
            dropdowns.forEach(dropdown => {
                if (!dropdown.contains(event.target)) {
                    dropdown.querySelector('[data-dropdown-menu]')?.classList.add('hidden');
                }
            });
        });

        // Close sidebar on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const sidebar = document.getElementById('sidebar');
                if (!sidebar.classList.contains('-translate-x-full') && window.innerWidth < 1024) {
                    toggleSidebar();
                }
            }
        });

        // Auto-dismiss alerts after 5 seconds
        document.querySelectorAll('.alert-enter').forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-8px)';
                setTimeout(() => alert.remove(), 300);
            }, 5000);
        });
    </script>

    @stack('scripts')
</body>
</html>
