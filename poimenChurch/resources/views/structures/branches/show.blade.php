<x-app-layout>
    <x-slot name="title">{{ $branch->name }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.nav.branches'))

    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('branches.index') }}" class="text-primary-600 hover:text-primary-700 flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            {{ __('app.back') }}
        </a>
        @can('branches.edit')
        <a href="{{ route('branches.edit', $branch) }}" class="btn-primary">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            {{ __('app.edit') }}
        </a>
        @endcan
    </div>

    <!-- Header -->
    <div class="card mb-6">
        <div class="flex items-start justify-between">
            <div>
                <h2 class="text-2xl font-bold text-primary-700">{{ $branch->name }}</h2>
                <p class="text-text-secondary">{{ $branch->city ?? '' }} {{ $branch->address ? '- ' . $branch->address : '' }}</p>
            </div>
            @if($branch->is_active)
                <span class="badge-success">{{ __('app.members.active') }}</span>
            @else
                <span class="badge-error">{{ __('app.members.inactive') }}</span>
            @endif
        </div>

        @if($branch->description)
        <p class="mt-4 text-gray-600">{{ $branch->description }}</p>
        @endif

        <div class="mt-4 flex flex-wrap gap-4">
            @if($branch->leader)
            <div class="flex items-center">
                <span class="text-sm text-text-secondary mr-2">{{ __('app.branches.leader') }}:</span>
                <span class="font-medium">{{ $branch->leader->full_name }}</span>
            </div>
            @endif
            @if($branch->assistantLeader)
            <div class="flex items-center">
                <span class="text-sm text-text-secondary mr-2">{{ __('app.branches.assistant') }}:</span>
                <span class="font-medium">{{ $branch->assistantLeader->full_name }}</span>
            </div>
            @endif
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="stat-card">
            <p class="stat-label">{{ __('app.branches.zones_count') }}</p>
            <p class="stat-value">{{ $stats['total_zones'] }}</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">{{ __('app.dashboard.total_bacentas') }}</p>
            <p class="stat-value">{{ $stats['total_bacentas'] }}</p>
        </div>
        <div class="kpi-card">
            <p class="stat-label">{{ __('app.dashboard.weekly_attendance') }}</p>
            <p class="kpi-value">{{ $stats['weekly_attendance'] }}</p>
        </div>
        <div class="kpi-card">
            <p class="stat-label">{{ __('app.dashboard.weekly_offerings') }}</p>
            <p class="kpi-value">{{ number_format($stats['weekly_offerings'], 0, ',', ' ') }}</p>
            <p class="text-xs text-text-secondary">XOF</p>
        </div>
    </div>

    <!-- Zones List -->
    <div class="card">
        <h3 class="text-lg font-semibold text-primary-700 mb-4">Zones de cette branche</h3>

        @if($branch->zones->count() > 0)
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('app.zones.name') }}</th>
                        <th>{{ __('app.zones.leader') }}</th>
                        <th>Bacentas</th>
                        <th>{{ __('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($branch->zones as $zone)
                    <tr>
                        <td class="font-medium">{{ $zone->name }}</td>
                        <td>{{ $zone->leader?->full_name ?? '-' }}</td>
                        <td>{{ $zone->bacentas->count() }}</td>
                        <td>
                            <a href="{{ route('zones.show', $zone) }}" class="text-primary-600 hover:text-primary-700">
                                {{ __('app.view') }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-text-secondary text-center py-8">Aucune zone dans cette branche</p>
        @endif
    </div>
</x-app-layout>
