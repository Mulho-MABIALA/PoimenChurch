<x-app-layout>
    <x-slot name="title">{{ $department->name }} - {{ config('app.name') }}</x-slot>

    @section('page-title', $department->name)

    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-primary-700">{{ $department->name }}</h2>
                <p class="text-text-secondary">{{ $department->description }}</p>
            </div>
            <div class="flex items-center space-x-2">
                @if($department->is_active)
                    <span class="badge-success">{{ __('app.members.active') }}</span>
                @else
                    <span class="badge-error">{{ __('app.members.inactive') }}</span>
                @endif
                @can('departments.edit')
                <a href="{{ route('departments.edit', $department) }}" class="btn-outline">
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
                        <dt class="text-sm text-text-secondary">{{ __('app.departments.leader') }}</dt>
                        <dd class="font-medium">{{ $department->leader?->full_name ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-text-secondary">{{ __('app.departments.members_count') }}</dt>
                        <dd class="font-medium">{{ $department->members->count() }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Members List -->
            <div class="lg:col-span-2 card">
                <h3 class="text-lg font-semibold text-primary-700 mb-4">{{ __('app.nav.members') }}</h3>
                @if($department->members->count() > 0)
                <div class="space-y-2">
                    @foreach($department->members as $member)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="avatar-sm bg-primary-600 flex items-center justify-center text-white text-sm font-medium">
                                {{ substr($member->first_name, 0, 1) }}{{ substr($member->last_name, 0, 1) }}
                            </div>
                            <div class="ml-3">
                                <p class="font-medium">{{ $member->full_name }}</p>
                                <p class="text-sm text-text-secondary">{{ $member->email }}</p>
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
            <a href="{{ route('departments.index') }}" class="text-primary-600 hover:text-primary-700">
                &larr; {{ __('app.back') }}
            </a>
        </div>
    </div>
</x-app-layout>
