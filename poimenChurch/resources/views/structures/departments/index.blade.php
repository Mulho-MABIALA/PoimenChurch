<x-app-layout>
    <x-slot name="title">{{ __('app.departments.title') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.departments.title'))

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-2xl font-bold text-primary-700">{{ __('app.departments.title') }}</h2>
        @can('departments.create')
        <a href="{{ route('departments.create') }}" class="btn-primary">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            {{ __('app.departments.add') }}
        </a>
        @endcan
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($departments as $department)
        <div class="card hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h3 class="text-lg font-semibold text-primary-700">{{ $department->name }}</h3>
                    <p class="text-sm text-text-secondary">{{ Str::limit($department->description, 50) ?? 'N/A' }}</p>
                </div>
                @if($department->is_active)
                    <span class="badge-success">{{ __('app.members.active') }}</span>
                @else
                    <span class="badge-error">{{ __('app.members.inactive') }}</span>
                @endif
            </div>

            <div class="space-y-2 mb-4">
                <div class="flex items-center text-sm">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="text-text-secondary">{{ __('app.departments.leader') }}:</span>
                    <span class="ml-1 font-medium">{{ $department->leader?->full_name ?? '-' }}</span>
                </div>
                <div class="flex items-center text-sm">
                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="text-text-secondary">{{ __('app.departments.members_count') }}:</span>
                    <span class="ml-1 font-medium">{{ $department->members_count ?? 0 }}</span>
                </div>
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <a href="{{ route('departments.show', $department) }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium">
                    {{ __('app.view') }} &rarr;
                </a>
                <div class="flex items-center space-x-2">
                    @can('departments.edit')
                    <a href="{{ route('departments.edit', $department) }}" class="text-blue-600 hover:text-blue-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </a>
                    @endcan
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-text-secondary">
            {{ __('app.no_data') }}
        </div>
        @endforelse
    </div>

    @if($departments->hasPages())
    <div class="mt-6">
        {{ $departments->links() }}
    </div>
    @endif
</x-app-layout>
