<x-app-layout>
    <x-slot name="title">{{ __('app.bacentas.edit') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.bacentas.edit'))

    <div class="max-w-2xl mx-auto">
        <div class="card">
            <h2 class="text-xl font-bold text-primary-700 mb-6">{{ __('app.bacentas.edit') }}: {{ $bacenta->name }}</h2>

            <form method="POST" action="{{ route('bacentas.update', $bacenta) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name" class="label">{{ __('app.bacentas.name') }}</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $bacenta->name) }}" required
                        class="input @error('name') input-error @enderror">
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="zone_id" class="label">{{ __('app.bacentas.zone') }}</label>
                    <select id="zone_id" name="zone_id" required class="input @error('zone_id') input-error @enderror">
                        <option value="">-- {{ __('app.select') }} --</option>
                        @foreach($zones as $zone)
                            <option value="{{ $zone->id }}" {{ old('zone_id', $bacenta->zone_id) == $zone->id ? 'selected' : '' }}>
                                {{ $zone->name }} ({{ $zone->branch->name }})
                            </option>
                        @endforeach
                    </select>
                    @error('zone_id')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="shepherd_id" class="label">{{ __('app.bacentas.shepherd') }}</label>
                    <select id="shepherd_id" name="shepherd_id" class="input @error('shepherd_id') input-error @enderror">
                        <option value="">-- {{ __('app.none') }} --</option>
                        @foreach($shepherds as $shepherd)
                            <option value="{{ $shepherd->id }}" {{ old('shepherd_id', $bacenta->shepherd_id) == $shepherd->id ? 'selected' : '' }}>
                                {{ $shepherd->full_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('shepherd_id')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label for="meeting_day" class="label">{{ __('app.bacentas.meeting_day') }}</label>
                        <select id="meeting_day" name="meeting_day" class="input @error('meeting_day') input-error @enderror">
                            <option value="">-- {{ __('app.select') }} --</option>
                            @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                                <option value="{{ $day }}" {{ old('meeting_day', $bacenta->meeting_day) === $day ? 'selected' : '' }}>
                                    {{ __('app.days.' . $day) }}
                                </option>
                            @endforeach
                        </select>
                        @error('meeting_day')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="meeting_time" class="label">{{ __('app.bacentas.meeting_time') }}</label>
                        <input type="time" id="meeting_time" name="meeting_time" value="{{ old('meeting_time', $bacenta->meeting_time) }}"
                            class="input @error('meeting_time') input-error @enderror">
                        @error('meeting_time')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="meeting_location" class="label">{{ __('app.bacentas.meeting_location') }}</label>
                    <input type="text" id="meeting_location" name="meeting_location" value="{{ old('meeting_location', $bacenta->meeting_location) }}"
                        class="input @error('meeting_location') input-error @enderror">
                    @error('meeting_location')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $bacenta->is_active) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                        <span class="ml-2">{{ __('app.members.is_active') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4">
                    <a href="{{ route('bacentas.index') }}" class="btn-outline">{{ __('app.cancel') }}</a>
                    <button type="submit" class="btn-primary">{{ __('app.update') }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
