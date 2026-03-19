<x-app-layout>
    <x-slot name="title">{{ __('app.zones.add') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.zones.add'))

    <div class="max-w-2xl mx-auto">
        <div class="card">
            <h2 class="text-xl font-bold text-primary-700 mb-6">{{ __('app.zones.add') }}</h2>

            <form method="POST" action="{{ route('zones.store') }}" class="space-y-4">
                @csrf

                <div class="form-group">
                    <label for="name" class="label">{{ __('app.zones.name') }}</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="input @error('name') input-error @enderror">
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="branch_id" class="label">{{ __('app.zones.branch') }}</label>
                    <select id="branch_id" name="branch_id" required class="input @error('branch_id') input-error @enderror">
                        <option value="">-- {{ __('app.select') }} --</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('branch_id')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="leader_id" class="label">{{ __('app.zones.leader') }}</label>
                    <select id="leader_id" name="leader_id" class="input @error('leader_id') input-error @enderror">
                        <option value="">-- {{ __('app.none') }} --</option>
                        @foreach($leaders as $leader)
                            <option value="{{ $leader->id }}" {{ old('leader_id') == $leader->id ? 'selected' : '' }}>
                                {{ $leader->full_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('leader_id')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                        <span class="ml-2">{{ __('app.members.is_active') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4">
                    <a href="{{ route('zones.index') }}" class="btn-outline">{{ __('app.cancel') }}</a>
                    <button type="submit" class="btn-primary">{{ __('app.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
