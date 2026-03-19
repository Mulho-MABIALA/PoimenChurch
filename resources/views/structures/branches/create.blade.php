<x-app-layout>
    <x-slot name="title">{{ __('app.branches.add') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.branches.add'))

    <div class="mb-6">
        <a href="{{ route('branches.index') }}" class="text-primary-600 hover:text-primary-700 flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            {{ __('app.back') }}
        </a>
    </div>

    <div class="max-w-2xl">
        <form method="POST" action="{{ route('branches.store') }}" class="card">
            @csrf

            <h3 class="text-lg font-semibold text-primary-700 mb-4">{{ __('app.branches.add') }}</h3>

            <div class="space-y-4">
                <div class="form-group">
                    <label for="name" class="label">{{ __('app.branches.name') }} *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="input @error('name') input-error @enderror">
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="label">{{ __('app.branches.description') }}</label>
                    <textarea id="description" name="description" rows="3" class="input">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label for="address" class="label">{{ __('app.branches.address') }}</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}" class="input">
                    </div>

                    <div class="form-group">
                        <label for="city" class="label">{{ __('app.branches.city') }}</label>
                        <input type="text" id="city" name="city" value="{{ old('city') }}" class="input">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label for="leader_id" class="label">{{ __('app.branches.leader') }}</label>
                        <select id="leader_id" name="leader_id" class="input">
                            <option value="">--</option>
                            @foreach($leaders as $leader)
                                <option value="{{ $leader->id }}" {{ old('leader_id') == $leader->id ? 'selected' : '' }}>
                                    {{ $leader->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="assistant_leader_id" class="label">{{ __('app.branches.assistant') }}</label>
                        <select id="assistant_leader_id" name="assistant_leader_id" class="input">
                            <option value="">--</option>
                            @foreach($leaders as $leader)
                                <option value="{{ $leader->id }}" {{ old('assistant_leader_id') == $leader->id ? 'selected' : '' }}>
                                    {{ $leader->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                        <span class="ml-2 text-sm">{{ __('app.members.is_active') }}</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-3 mt-6">
                <button type="submit" class="btn-primary">{{ __('app.save') }}</button>
                <a href="{{ route('branches.index') }}" class="btn-outline">{{ __('app.cancel') }}</a>
            </div>
        </form>
    </div>
</x-app-layout>
