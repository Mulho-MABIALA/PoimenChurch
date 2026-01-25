<x-app-layout>
    <x-slot name="title">{{ $zone->name }} - {{ config('app.name') }}</x-slot>

    @section('page-title', $zone->name)

    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-primary-700">{{ $zone->name }}</h2>
                <p class="text-text-secondary">{{ $zone->branch->name }}</p>
            </div>
            <div class="flex items-center space-x-2">
                @if($zone->is_active)
                    <span class="badge-success">{{ __('app.members.active') }}</span>
                @else
                    <span class="badge-error">{{ __('app.members.inactive') }}</span>
                @endif
                @can('zones.edit')
                <a href="{{ route('zones.edit', $zone) }}" class="btn-outline">
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
                        <dt class="text-sm text-text-secondary">{{ __('app.zones.leader') }}</dt>
                        <dd class="font-medium">{{ $zone->leader?->full_name ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-text-secondary">{{ __('app.zones.branch') }}</dt>
                        <dd class="font-medium">{{ $zone->branch->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-text-secondary">{{ __('app.zones.bacentas_count') }}</dt>
                        <dd class="font-medium">{{ $zone->bacentas->count() }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Bacentas List -->
            <div class="lg:col-span-2 card">
                <h3 class="text-lg font-semibold text-primary-700 mb-4">{{ __('app.nav.bacentas') }}</h3>
                @if($zone->bacentas->count() > 0)
                <div class="space-y-2">
                    @foreach($zone->bacentas as $bacenta)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-medium">{{ $bacenta->name }}</p>
                            <p class="text-sm text-text-secondary">
                                {{ __('app.bacentas.shepherd') }}: {{ $bacenta->shepherd?->full_name ?? '-' }}
                            </p>
                        </div>
                        <a href="{{ route('bacentas.show', $bacenta) }}" class="text-primary-600 hover:text-primary-700 text-sm">
                            {{ __('app.view') }} &rarr;
                        </a>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-text-secondary text-center py-4">{{ __('app.no_data') }}</p>
                @endif
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('zones.index') }}" class="text-primary-600 hover:text-primary-700">
                &larr; {{ __('app.back') }}
            </a>
        </div>
    </div>
</x-app-layout>
