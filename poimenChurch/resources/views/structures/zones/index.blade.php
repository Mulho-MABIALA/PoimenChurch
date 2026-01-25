<x-app-layout>
    <x-slot name="title">{{ __('app.zones.title') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.zones.title'))

    <style>
        .table-row-hover {
            transition: background-color 0.15s ease;
        }
        .table-row-hover:hover {
            background-color: #f8fafc;
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
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">{{ __('app.zones.title') }}</h2>
            <p class="text-gray-500 mt-1">
                <span class="font-semibold text-primary-600">{{ $zones->total() }}</span> zones au total
            </p>
        </div>
        @can('zones.create')
        <a href="{{ route('zones.create') }}"
           class="inline-flex items-center justify-center px-4 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 transition-colors shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            {{ __('app.zones.add') }}
        </a>
        @endcan
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-5 mb-6">
        <form method="GET" action="{{ route('zones.index') }}" class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4">
            <div class="flex-1 min-w-[200px]">
                <label for="search" class="sr-only">Rechercher</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           placeholder="{{ __('app.search') }}..."
                           class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors">
                </div>
            </div>
            <div class="w-full sm:w-48">
                <label for="branch_id" class="sr-only">Branche</label>
                <select name="branch_id" id="branch_id"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors bg-white">
                    <option value="">{{ __('app.all') }} branches</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="w-full sm:w-36">
                <label for="status" class="sr-only">Statut</label>
                <select name="status" id="status"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors bg-white">
                    <option value="">{{ __('app.all') }}</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>{{ __('app.members.active') }}</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>{{ __('app.members.inactive') }}</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit"
                        class="flex-1 sm:flex-none px-5 py-2.5 bg-primary-600 text-white font-medium rounded-xl hover:bg-primary-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 transition-colors">
                    {{ __('app.filter') }}
                </button>
                @if(request()->hasAny(['search', 'branch_id', 'status']))
                <a href="{{ route('zones.index') }}"
                   class="px-3 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-colors"
                   title="Réinitialiser les filtres">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('app.zones.name') }}</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('app.zones.branch') }}</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('app.zones.leader') }}</th>
                        <th class="px-5 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('app.zones.bacentas_count') }}</th>
                        <th class="px-5 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('app.members.status') }}</th>
                        <th class="px-5 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($zones as $zone)
                    <tr class="table-row-hover">
                        <td class="px-5 py-4">
                            <a href="{{ route('zones.show', $zone) }}"
                               class="font-semibold text-primary-600 hover:text-primary-700 hover:underline transition-colors">
                                {{ $zone->name }}
                            </a>
                        </td>
                        <td class="px-5 py-4 text-gray-600">{{ $zone->branch?->name ?? '-' }}</td>
                        <td class="px-5 py-4">
                            @if($zone->leader)
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 bg-primary-100 rounded-lg flex items-center justify-center text-primary-700 text-xs font-semibold">
                                    {{ substr($zone->leader->first_name, 0, 1) }}{{ substr($zone->leader->last_name, 0, 1) }}
                                </div>
                                <span class="text-gray-700">{{ $zone->leader->full_name }}</span>
                            </div>
                            @else
                            <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-primary-100 text-primary-700">
                                {{ $zone->bacentas_count }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-center">
                            @if($zone->is_active)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                    {{ __('app.members.active') }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                    {{ __('app.members.inactive') }}
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('zones.show', $zone) }}"
                                   class="action-btn text-gray-500 hover:text-primary-600"
                                   title="{{ __('app.view') }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                @can('zones.edit')
                                <a href="{{ route('zones.edit', $zone) }}"
                                   class="action-btn text-gray-500 hover:text-blue-600"
                                   title="{{ __('app.edit') }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                @endcan
                                @can('zones.delete')
                                <form action="{{ route('zones.destroy', $zone) }}" method="POST" class="inline"
                                      onsubmit="return confirm('{{ __('app.confirm_delete') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="action-btn text-gray-500 hover:text-red-600"
                                            title="{{ __('app.delete') }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                    </svg>
                                </div>
                                <p class="text-gray-500 font-medium">{{ __('app.no_data') }}</p>
                                <p class="text-gray-400 text-sm mt-1">Aucune zone trouvée avec ces critères</p>
                                @can('zones.create')
                                <a href="{{ route('zones.create') }}" class="mt-4 text-primary-600 hover:text-primary-700 font-medium text-sm">
                                    + Créer une nouvelle zone
                                </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($zones->hasPages())
        <div class="px-5 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $zones->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
