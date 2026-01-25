<x-app-layout>
    <x-slot name="title">{{ __('app.branches.title') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.branches.title'))

    <style>
        .branch-card {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .branch-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        }
        .stat-pill {
            transition: all 0.15s ease;
        }
        .branch-card:hover .stat-pill {
            transform: scale(1.05);
        }
        .action-btn {
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.15s ease;
        }
        .action-btn:hover {
            background-color: #f3f4f6;
        }
        .action-btn:focus-visible {
            outline: 2px solid var(--color-primary-500);
            outline-offset: 2px;
        }
    </style>

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">{{ __('app.branches.title') }}</h2>
            <p class="text-gray-500 mt-1">Gérer les branches de l'église</p>
        </div>
        @can('branches.create')
        <a href="{{ route('branches.create') }}"
           class="inline-flex items-center justify-center px-4 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 transition-colors shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            {{ __('app.branches.add') }}
        </a>
        @endcan
    </div>

    <!-- Grid View -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($branches as $branch)
        <article class="branch-card bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-start justify-between mb-4">
                <div class="flex-1 min-w-0">
                    <h3 class="font-semibold text-gray-900 truncate">
                        <a href="{{ route('branches.show', $branch) }}"
                           class="text-primary-600 hover:text-primary-700 hover:underline transition-colors">
                            {{ $branch->name }}
                        </a>
                    </h3>
                    <p class="text-sm text-gray-500 mt-0.5 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                        {{ $branch->city ?? 'N/A' }}
                    </p>
                </div>
                @if($branch->is_active)
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 ml-3">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                        {{ __('app.members.active') }}
                    </span>
                @else
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700 ml-3">
                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                        {{ __('app.members.inactive') }}
                    </span>
                @endif
            </div>

            <!-- Leader -->
            <div class="flex items-center gap-2.5 mb-4 text-sm text-gray-600">
                <div class="w-7 h-7 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-gray-400 uppercase tracking-wide">{{ __('app.branches.leader') }}</p>
                    <p class="font-medium text-gray-700 truncate">{{ $branch->leader?->full_name ?? '-' }}</p>
                </div>
            </div>

            <!-- Stats -->
            <div class="flex items-center gap-3 mb-4">
                <div class="stat-pill flex-1 bg-blue-50 rounded-xl p-3 text-center">
                    <p class="text-lg font-bold text-blue-700">{{ $branch->zones_count }}</p>
                    <p class="text-xs text-blue-600">Zones</p>
                </div>
                <div class="stat-pill flex-1 bg-primary-50 rounded-xl p-3 text-center">
                    <p class="text-lg font-bold text-primary-700">{{ $branch->members_count }}</p>
                    <p class="text-xs text-primary-600">{{ __('app.nav.members') }}</p>
                </div>
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <a href="{{ route('branches.show', $branch) }}"
                   class="text-primary-600 hover:text-primary-700 text-sm font-medium inline-flex items-center gap-1 transition-colors group">
                    {{ __('app.view') }}
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <div class="flex items-center gap-1">
                    @can('branches.edit')
                    <a href="{{ route('branches.edit', $branch) }}"
                       class="action-btn text-gray-500 hover:text-blue-600"
                       title="{{ __('app.edit') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </a>
                    @endcan
                </div>
            </div>
        </article>
        @empty
        <div class="col-span-full">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm py-16 px-5 text-center">
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 font-medium">{{ __('app.no_data') }}</p>
                    <p class="text-gray-400 text-sm mt-1">Aucune branche trouvée</p>
                    @can('branches.create')
                    <a href="{{ route('branches.create') }}" class="mt-4 text-primary-600 hover:text-primary-700 font-medium text-sm">
                        + Créer une nouvelle branche
                    </a>
                    @endcan
                </div>
            </div>
        </div>
        @endforelse
    </div>

    @if($branches->hasPages())
    <div class="mt-6">
        {{ $branches->links() }}
    </div>
    @endif
</x-app-layout>
