<x-app-layout>
    <x-slot name="title">{{ $member->full_name }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.members.title'))

    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('members.index') }}" class="text-primary-600 hover:text-primary-700 flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            {{ __('app.back') }}
        </a>
        @can('members.edit')
        <a href="{{ route('members.edit', $member) }}" class="btn-primary">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
            {{ __('app.edit') }}
        </a>
        @endcan
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Card -->
        <div class="card text-center">
            @if($member->photo)
                <img src="{{ Storage::url($member->photo) }}" alt="" class="avatar-xl mx-auto mb-4">
            @else
                <div class="avatar-xl bg-primary-100 flex items-center justify-center text-primary-700 text-2xl font-bold mx-auto mb-4">
                    {{ substr($member->first_name, 0, 1) }}{{ substr($member->last_name, 0, 1) }}
                </div>
            @endif

            <h2 class="text-xl font-bold text-gray-900">{{ $member->full_name }}</h2>
            <p class="text-text-secondary">{{ $member->email }}</p>

            <div class="mt-4 flex flex-wrap justify-center gap-2">
                @foreach($member->roles as $role)
                    <span class="badge-primary">{{ __('app.roles.' . $role->name) }}</span>
                @endforeach
            </div>

            <div class="mt-4">
                @if($member->is_active)
                    <span class="badge-success">{{ __('app.members.active') }}</span>
                @else
                    <span class="badge-error">{{ __('app.members.inactive') }}</span>
                @endif
            </div>

            <hr class="my-4">

            <div class="text-left space-y-2">
                @if($member->phone)
                <div class="flex items-center text-sm">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    {{ $member->phone }}
                </div>
                @endif

                @if($member->address)
                <div class="flex items-start text-sm">
                    <svg class="w-4 h-4 mr-2 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{ $member->address }}
                </div>
                @endif

                @if($member->date_of_birth)
                <div class="flex items-center text-sm">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ $member->date_of_birth->format('d/m/Y') }}
                </div>
                @endif
            </div>
        </div>

        <!-- Stats & Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="stat-card">
                    <p class="stat-label">{{ __('app.members.attendance_rate') }}</p>
                    <p class="stat-value">{{ $stats['attendance_rate'] }}%</p>
                    <p class="text-xs text-text-secondary">Derniers 6 mois</p>
                </div>

                <div class="kpi-card">
                    <p class="stat-label">{{ __('app.finances.total_tithes') }} {{ now()->year }}</p>
                    <p class="kpi-value">{{ number_format($stats['total_tithes_year'], 0, ',', ' ') }}</p>
                    <p class="text-xs text-text-secondary">XOF</p>
                </div>

                <div class="stat-card">
                    <p class="stat-label">Total dons {{ now()->year }}</p>
                    <p class="stat-value">{{ number_format($stats['total_donations_year'], 0, ',', ' ') }}</p>
                    <p class="text-xs text-text-secondary">XOF</p>
                </div>
            </div>

            <!-- Details -->
            <div class="card">
                <h3 class="text-lg font-semibold text-primary-700 mb-4">Informations detaillees</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-text-secondary">{{ __('app.members.occupation') }}</p>
                        <p class="font-medium">{{ $member->occupation ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-text-secondary">{{ __('app.members.workplace') }}</p>
                        <p class="font-medium">{{ $member->workplace ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-text-secondary">{{ __('app.members.member_since') }}</p>
                        <p class="font-medium">{{ $member->member_since?->format('d/m/Y') ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-text-secondary">{{ __('app.members.baptism_date') }}</p>
                        <p class="font-medium">{{ $member->baptism_date?->format('d/m/Y') ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-text-secondary">{{ __('app.members.church_class') }}</p>
                        <p class="font-medium">{{ $member->church_class ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-text-secondary">{{ __('app.members.school_class') }}</p>
                        <p class="font-medium">{{ $member->school_class ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Affiliations -->
            <div class="card">
                <h3 class="text-lg font-semibold text-primary-700 mb-4">Rattachements</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <p class="text-sm text-text-secondary mb-2">Zones</p>
                        @forelse($member->zones as $zone)
                            <span class="badge-primary mr-1 mb-1">{{ $zone->name }}</span>
                        @empty
                            <p class="text-gray-400">-</p>
                        @endforelse
                    </div>
                    <div>
                        <p class="text-sm text-text-secondary mb-2">Bacentas</p>
                        @forelse($member->bacentas as $bacenta)
                            <span class="badge-primary mr-1 mb-1">{{ $bacenta->name }}</span>
                        @empty
                            <p class="text-gray-400">-</p>
                        @endforelse
                    </div>
                    <div>
                        <p class="text-sm text-text-secondary mb-2">{{ __('app.nav.departments') }}</p>
                        @forelse($member->departments as $department)
                            <span class="badge-gold mr-1 mb-1">{{ $department->name }}</span>
                        @empty
                            <p class="text-gray-400">-</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
