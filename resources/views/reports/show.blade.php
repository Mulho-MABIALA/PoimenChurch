<x-app-layout>
    <x-slot name="title">{{ __('app.reports.details') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.reports.details'))

    <div class="max-w-2xl mx-auto">
        <div class="card">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-bold text-primary-700">{{ $report->bacenta->name }}</h2>
                    <p class="text-text-secondary">{{ $report->report_date->format('d/m/Y') }} - {{ __('app.reports.types.' . $report->report_type) }}</p>
                </div>
                @can('reports.edit')
                <a href="{{ route('reports.edit', $report) }}" class="btn-outline">
                    {{ __('app.edit') }}
                </a>
                @endcan
            </div>

            <dl class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <dt class="text-sm text-text-secondary">{{ __('app.reports.report_type') }}</dt>
                        <dd class="text-xl font-bold text-primary-700">{{ __('app.reports.types.' . $report->report_type) }}</dd>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <dt class="text-sm text-text-secondary">{{ __('app.reports.report_date') }}</dt>
                        <dd class="text-xl font-bold text-primary-700">{{ $report->report_date->format('d/m/Y') }}</dd>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue-50 rounded-lg p-4">
                        <dt class="text-sm text-blue-600">{{ __('app.reports.attendance') }}</dt>
                        <dd class="text-2xl font-bold text-blue-700">{{ $report->attendance_count }}</dd>
                    </div>
                    <div class="bg-green-50 rounded-lg p-4">
                        <dt class="text-sm text-green-600">{{ __('app.reports.offering') }}</dt>
                        <dd class="text-2xl font-bold text-green-700">{{ number_format($report->offering_amount, 0, ',', ' ') }} XOF</dd>
                    </div>
                </div>

                <div class="border-t pt-4">
                    <dt class="text-sm text-text-secondary mb-2">{{ __('app.reports.bacenta') }}</dt>
                    <dd class="font-medium">{{ $report->bacenta->name }}</dd>
                    <dd class="text-sm text-text-secondary">{{ $report->bacenta->zone->name }} - {{ $report->bacenta->zone->branch->name }}</dd>
                </div>

                @if($report->notes)
                <div class="border-t pt-4">
                    <dt class="text-sm text-text-secondary mb-2">{{ __('app.reports.notes') }}</dt>
                    <dd class="text-gray-700">{{ $report->notes }}</dd>
                </div>
                @endif

                <div class="border-t pt-4 text-sm text-text-secondary">
                    <p>{{ __('app.created_by') }}: {{ $report->submittedBy?->full_name ?? '-' }}</p>
                    <p>{{ __('app.created_at') }}: {{ $report->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </dl>
        </div>

        <div class="mt-6">
            <a href="{{ route('reports.index') }}" class="text-primary-600 hover:text-primary-700">
                &larr; {{ __('app.back') }}
            </a>
        </div>
    </div>
</x-app-layout>
