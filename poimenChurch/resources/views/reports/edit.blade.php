<x-app-layout>
    <x-slot name="title">{{ __('app.reports.edit') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.reports.edit'))

    <div class="max-w-2xl mx-auto">
        <div class="card">
            <h2 class="text-xl font-bold text-primary-700 mb-6">{{ __('app.reports.edit') }}</h2>

            <form method="POST" action="{{ route('reports.update', $report) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="bacenta_id" class="label">{{ __('app.reports.bacenta') }}</label>
                    <select id="bacenta_id" name="bacenta_id" required class="input @error('bacenta_id') input-error @enderror">
                        <option value="">-- {{ __('app.select') }} --</option>
                        @foreach($bacentas as $bacenta)
                            <option value="{{ $bacenta->id }}" {{ old('bacenta_id', $report->bacenta_id) == $bacenta->id ? 'selected' : '' }}>
                                {{ $bacenta->name }} ({{ $bacenta->zone->name }})
                            </option>
                        @endforeach
                    </select>
                    @error('bacenta_id')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label for="report_type" class="label">{{ __('app.reports.report_type') }}</label>
                        <select id="report_type" name="report_type" required class="input @error('report_type') input-error @enderror">
                            <option value="midweek" {{ old('report_type', $report->report_type) === 'midweek' ? 'selected' : '' }}>
                                {{ __('app.reports.types.midweek') }}
                            </option>
                            <option value="sunday" {{ old('report_type', $report->report_type) === 'sunday' ? 'selected' : '' }}>
                                {{ __('app.reports.types.sunday') }}
                            </option>
                        </select>
                        @error('report_type')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="report_date" class="label">{{ __('app.reports.report_date') }}</label>
                        <input type="date" id="report_date" name="report_date" value="{{ old('report_date', $report->report_date->format('Y-m-d')) }}" required
                            class="input @error('report_date') input-error @enderror">
                        @error('report_date')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="form-group">
                        <label for="attendance_count" class="label">{{ __('app.reports.attendance') }}</label>
                        <input type="number" id="attendance_count" name="attendance_count" value="{{ old('attendance_count', $report->attendance_count) }}" required min="0"
                            class="input @error('attendance_count') input-error @enderror">
                        @error('attendance_count')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="offering_amount" class="label">{{ __('app.reports.offering') }} (XOF)</label>
                        <input type="number" id="offering_amount" name="offering_amount" value="{{ old('offering_amount', $report->offering_amount) }}" min="0" step="1"
                            class="input @error('offering_amount') input-error @enderror">
                        @error('offering_amount')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="notes" class="label">{{ __('app.reports.notes') }}</label>
                    <textarea id="notes" name="notes" rows="3"
                        class="input @error('notes') input-error @enderror">{{ old('notes', $report->notes) }}</textarea>
                    @error('notes')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4">
                    <a href="{{ route('reports.index') }}" class="btn-outline">{{ __('app.cancel') }}</a>
                    <button type="submit" class="btn-primary">{{ __('app.update') }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
