<x-app-layout>
    <x-slot name="title">{{ __('app.reports.monthly') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.reports.monthly'))

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-2xl font-bold text-primary-700">
            {{ __('app.reports.monthly') }} - {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }} {{ $year }}
        </h2>

        <form method="GET" class="flex items-center gap-2">
            <select name="month" class="input" onchange="this.form.submit()">
                @for($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                    </option>
                @endfor
            </select>
            <select name="year" class="input" onchange="this.form.submit()">
                @for($y = now()->year; $y >= now()->year - 5; $y--)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </form>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="card bg-blue-50">
            <p class="text-sm text-blue-600">{{ __('app.attendance.bacenta_meeting') }}</p>
            <p class="text-2xl font-bold text-blue-700">{{ number_format($summary['total_bacenta_attendance']) }}</p>
        </div>
        <div class="card bg-green-50">
            <p class="text-sm text-green-600">{{ __('app.attendance.sunday_service') }}</p>
            <p class="text-2xl font-bold text-green-700">{{ number_format($summary['total_sunday_attendance']) }}</p>
        </div>
        <div class="card bg-purple-50">
            <p class="text-sm text-purple-600">{{ __('app.reports.total_reports') }}</p>
            <p class="text-2xl font-bold text-purple-700">{{ $summary['reports_count'] }}</p>
        </div>
        <div class="card bg-yellow-50">
            <p class="text-sm text-yellow-600">{{ __('app.finances.total_offerings') }}</p>
            <p class="text-2xl font-bold text-yellow-700">{{ number_format($summary['total_offerings'], 0, ',', ' ') }} XOF</p>
        </div>
    </div>

    <!-- Weekly Breakdown -->
    <div class="card">
        <h3 class="text-lg font-semibold text-primary-700 mb-4">{{ __('app.reports.weekly_breakdown') }}</h3>
        <div class="overflow-x-auto">
            <table class="table-base">
                <thead>
                    <tr>
                        <th>{{ __('app.reports.week') }}</th>
                        <th class="text-right">{{ __('app.attendance.sunday_service') }}</th>
                        <th class="text-right">{{ __('app.finances.total_offerings') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($weeklyData as $week)
                    <tr>
                        <td class="font-medium">{{ $week['week'] }}</td>
                        <td class="text-right">{{ number_format($week['attendance']) }}</td>
                        <td class="text-right">{{ number_format($week['offerings'], 0, ',', ' ') }} XOF</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-text-secondary">{{ __('app.no_data') }}</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-gray-50 font-semibold">
                        <td>Total</td>
                        <td class="text-right">{{ number_format($summary['total_sunday_attendance']) }}</td>
                        <td class="text-right text-primary-700">{{ number_format($summary['total_offerings'], 0, ',', ' ') }} XOF</td>
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
