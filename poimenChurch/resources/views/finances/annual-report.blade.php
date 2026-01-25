<x-app-layout>
    <x-slot name="title">{{ __('app.finances.annual_summary') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.finances.annual_summary'))

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-2xl font-bold text-primary-700">{{ __('app.finances.annual_summary') }} {{ $year }}</h2>

        <form method="GET" class="flex items-center gap-2">
            <select name="year" class="input" onchange="this.form.submit()">
                @foreach($years as $y)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="stat-card">
            <p class="stat-label">{{ __('app.finances.total_tithes') }}</p>
            <p class="stat-value">{{ number_format($summary['total_tithes'] ?? 0, 0, ',', ' ') }} XOF</p>
        </div>
        <div class="kpi-card">
            <p class="stat-label">{{ __('app.finances.total_offerings') }}</p>
            <p class="kpi-value">{{ number_format($summary['total_offerings'] ?? 0, 0, ',', ' ') }} XOF</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">{{ __('app.finances.total_special') }}</p>
            <p class="stat-value">{{ number_format($summary['total_special'] ?? 0, 0, ',', ' ') }} XOF</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Monthly Breakdown -->
        <div class="card">
            <h3 class="text-lg font-semibold text-primary-700 mb-4">{{ __('app.finances.monthly_summary') }}</h3>
            <div class="overflow-x-auto">
                <table class="table-base">
                    <thead>
                        <tr>
                            <th>Mois</th>
                            <th class="text-right">{{ __('app.finances.tithe') }}</th>
                            <th class="text-right">{{ __('app.finances.offering') }}</th>
                            <th class="text-right">{{ __('app.finances.special_offering') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $months = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
                        @endphp
                        @for($m = 1; $m <= 12; $m++)
                            <tr>
                                <td>{{ $months[$m-1] }}</td>
                                <td class="text-right">{{ number_format($monthlyTotals[$m]['tithe'] ?? 0, 0, ',', ' ') }}</td>
                                <td class="text-right">{{ number_format($monthlyTotals[$m]['offering'] ?? 0, 0, ',', ' ') }}</td>
                                <td class="text-right">{{ number_format($monthlyTotals[$m]['special_offering'] ?? 0, 0, ',', ' ') }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top Tithers -->
        <div class="card">
            <h3 class="text-lg font-semibold text-primary-700 mb-4">Top 10 - {{ __('app.finances.tithe') }}</h3>
            @if($topTithers->count() > 0)
            <div class="space-y-3">
                @foreach($topTithers as $index => $tither)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <span class="w-8 h-8 flex items-center justify-center bg-gold-100 text-gold-700 font-bold rounded-full text-sm">
                            {{ $index + 1 }}
                        </span>
                        <div class="ml-3">
                            <p class="font-medium">{{ $tither->full_name }}</p>
                        </div>
                    </div>
                    <p class="font-semibold text-primary-700">{{ number_format($tither->total_tithes ?? 0, 0, ',', ' ') }} XOF</p>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-text-secondary text-center py-4">{{ __('app.no_data') }}</p>
            @endif
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('finances.index') }}" class="text-primary-600 hover:text-primary-700">
            &larr; {{ __('app.back') }}
        </a>
    </div>
</x-app-layout>
