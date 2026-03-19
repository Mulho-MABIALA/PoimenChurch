<x-app-layout>
    <x-slot name="title">{{ $bacenta->name }} - {{ config('app.name') }}</x-slot>

    @section('page-title', $bacenta->name)

    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-primary-700">{{ $bacenta->name }}</h2>
                <p class="text-text-secondary">{{ $bacenta->zone->name }} - {{ $bacenta->zone->branch->name }}</p>
            </div>
            <div class="flex items-center space-x-2">
                @if($bacenta->is_active)
                    <span class="badge-success">{{ __('app.members.active') }}</span>
                @else
                    <span class="badge-error">{{ __('app.members.inactive') }}</span>
                @endif
                @can('bacentas.edit')
                <a href="{{ route('bacentas.edit', $bacenta) }}" class="btn-outline">
                    {{ __('app.edit') }}
                </a>
                @endcan
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Info Card -->
            <div class="card">
                <h3 class="text-lg font-semibold text-primary-700 mb-4">{{ __('app.details') }}</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm text-text-secondary">{{ __('app.bacentas.shepherd') }}</dt>
                        <dd class="font-medium">{{ $bacenta->shepherd?->full_name ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-text-secondary">{{ __('app.bacentas.zone') }}</dt>
                        <dd class="font-medium">{{ $bacenta->zone->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-text-secondary">{{ __('app.bacentas.meeting_day') }}</dt>
                        <dd class="font-medium">{{ $bacenta->meeting_day ? __('app.days.' . $bacenta->meeting_day) : '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-text-secondary">{{ __('app.bacentas.meeting_location') }}</dt>
                        <dd class="font-medium">{{ $bacenta->meeting_location ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-text-secondary">{{ __('app.bacentas.members_count') }}</dt>
                        <dd class="font-medium">{{ $bacenta->members->count() }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Members List -->
            <div class="lg:col-span-2 card">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-primary-700">{{ __('app.nav.members') }}</h3>
                    @can('bacentas.edit')
                    <a href="{{ route('bacentas.members', $bacenta) }}" class="btn-sm btn-outline">
                        {{ __('app.bacentas.manage_members') }}
                    </a>
                    @endcan
                </div>
                @if($bacenta->members->count() > 0)
                <div class="space-y-2">
                    @foreach($bacenta->members as $member)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="avatar-sm bg-primary-600 flex items-center justify-center text-white text-sm font-medium">
                                {{ substr($member->first_name, 0, 1) }}{{ substr($member->last_name, 0, 1) }}
                            </div>
                            <div class="ml-3">
                                <p class="font-medium">{{ $member->full_name }}</p>
                                <p class="text-sm text-text-secondary">{{ $member->phone ?? $member->email }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-text-secondary text-center py-4">{{ __('app.no_data') }}</p>
                @endif
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('bacentas.index') }}" class="text-primary-600 hover:text-primary-700">
                &larr; {{ __('app.back') }}
            </a>
        </div>
    </div>
</x-app-layout>
