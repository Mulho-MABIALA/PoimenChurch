<x-app-layout>
    <x-slot name="title">{{ __('app.reports.weekly_by_zone') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.reports.weekly_by_zone'))

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-2xl font-bold text-primary-700">{{ __('app.reports.weekly_by_zone') }}</h2>

        <form method="GET" class="flex items-center gap-2">
            <input type="date" name="week_start" value="{{ $startOfWeek }}" class="input" onchange="this.form.submit()">
        </form>
    </div>

    <div class="mb-4 text-text-secondary">
        {{ \Carbon\Carbon::parse($startOfWeek)->format('d/m/Y') }} - {{ $endOfWeek->format('d/m/Y') }}
    </div>

    <div class="card">
        <div class="overflow-x-auto">
            <table class="table-base">
                <thead>
                    <tr>
                        <th>{{ __('app.zones.title') }}</th>
                        <th class="text-center">{{ __('app.attendance.bacenta_meeting') }}</th>
                        <th class="text-center">{{ __('app.attendance.sunday_service') }}</th>
                        <th class="text-right">{{ __('app.attendance.total_attendance') }}</th>
                        <th class="text-right">{{ __('app.finances.total_offerings') }}</th>
                        <th class="text-center">{{ __('app.reports.reports_count') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($zones as $zoneData)
                    <tr>
                        <td class="font-medium">{{ $zoneData['zone']->name }}</td>
                        <td class="text-center">{{ $zoneData['bacenta_attendance'] }}</td>
                        <td class="text-center">{{ $zoneData['sunday_attendance'] }}</td>
                        <td class="text-right font-medium">{{ $zoneData['bacenta_attendance'] + $zoneData['sunday_attendance'] }}</td>
                        <td class="text-right">{{ number_format($zoneData['total_offerings'], 0, ',', ' ') }} XOF</td>
                        <td class="text-center">
                            <span class="@if($zoneData['reports_submitted'] >= $zoneData['bacentas_count'] * 2) text-green-600 @else text-yellow-600 @endif">
                                {{ $zoneData['reports_submitted'] }} / {{ $zoneData['bacentas_count'] * 2 }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-text-secondary">{{ __('app.no_data') }}</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-gray-50 font-semibold">
                        <td>Total</td>
                        <td class="text-center">{{ $zones->sum('bacenta_attendance') }}</td>
                        <td class="text-center">{{ $zones->sum('sunday_attendance') }}</td>
                        <td class="text-right">{{ $zones->sum('bacenta_attendance') + $zones->sum('sunday_attendance') }}</td>
                        <td class="text-right text-primary-700">{{ number_format($zones->sum('total_offerings'), 0, ',', ' ') }} XOF</td>
                        <td class="text-center">{{ $zones->sum('reports_submitted') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('reports.index') }}" class="text-primary-600 hover:text-primary-700">
            &larr; {{ __('app.back') }}
        </a>
    </div>
</x-app-layout>
