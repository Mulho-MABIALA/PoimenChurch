<x-app-layout>
    <x-slot name="title">{{ __('app.departments.manage_members') }} - {{ $department->name }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.departments.manage_members'))

    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-primary-700">{{ $department->name }}</h2>
            <p class="text-text-secondary">{{ __('app.departments.manage_members') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Current Members -->
            <div class="card">
                <h3 class="text-lg font-semibold text-primary-700 mb-4">{{ __('app.departments.current_members') }} ({{ $department->members->count() }})</h3>
                @if($department->members->count() > 0)
                <div class="space-y-2 max-h-96 overflow-y-auto">
                    @foreach($department->members as $member)
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
                        <form method="POST" action="{{ route('departments.members.remove', [$department, $member]) }}"
                            onsubmit="return confirm('{{ __('app.confirm_delete') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-text-secondary text-center py-4">{{ __('app.no_data') }}</p>
                @endif
            </div>

            <!-- Add Members -->
            <div class="card">
                <h3 class="text-lg font-semibold text-primary-700 mb-4">{{ __('app.departments.add_member') }}</h3>
                <form method="POST" action="{{ route('departments.members.add', $department) }}" class="mb-4">
                    @csrf
                    <div class="flex gap-2">
                        <select name="user_id" required class="input flex-1 @error('user_id') input-error @enderror">
                            <option value="">-- {{ __('app.select') }} --</option>
                            @foreach($availableMembers as $member)
                                <option value="{{ $member->id }}">{{ $member->full_name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </button>
                    </div>
                    @error('user_id')
                        <p class="form-error mt-1">{{ $message }}</p>
                    @enderror
                </form>

                @if($availableMembers->count() > 0)
                <div class="space-y-2 max-h-80 overflow-y-auto">
                    @foreach($availableMembers as $member)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="avatar-sm bg-gray-400 flex items-center justify-center text-white text-sm font-medium">
                                {{ substr($member->first_name, 0, 1) }}{{ substr($member->last_name, 0, 1) }}
                            </div>
                            <div class="ml-3">
                                <p class="font-medium">{{ $member->full_name }}</p>
                                <p class="text-sm text-text-secondary">{{ $member->phone ?? $member->email }}</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('departments.members.add', $department) }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $member->id }}">
                            <button type="submit" class="text-primary-600 hover:text-primary-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-text-secondary text-center py-4">{{ __('app.departments.no_available_members') }}</p>
                @endif
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('departments.show', $department) }}" class="text-primary-600 hover:text-primary-700">
                &larr; {{ __('app.back') }}
            </a>
        </div>
    </div>
</x-app-layout>
