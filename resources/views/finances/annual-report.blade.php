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

    <!-- Main Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="p-5 rounded-2xl shadow-sm bg-gradient-to-br from-green-500 to-green-600 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm">Total Entrées</p>
                    <p class="text-2xl font-bold mt-1">{{ number_format($summary['total_incomes'] ?? 0, 0, ',', ' ') }} CDF</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="p-5 rounded-2xl shadow-sm bg-gradient-to-br from-red-500 to-red-600 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-sm">Total Dépenses</p>
                    <p class="text-2xl font-bold mt-1">{{ number_format($summary['total_expenses'] ?? 0, 0, ',', ' ') }} CDF</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="p-5 rounded-2xl shadow-sm {{ ($summary['balance'] ?? 0) >= 0 ? 'bg-gradient-to-br from-blue-500 to-blue-600' : 'bg-gradient-to-br from-orange-500 to-orange-600' }} text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white/80 text-sm">Solde</p>
                    <p class="text-2xl font-bold mt-1">{{ number_format($summary['balance'] ?? 0, 0, ',', ' ') }} CDF</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Income Breakdown Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="card">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">{{ __('app.finances.total_tithes') }}</p>
                    <p class="text-xl font-bold text-gray-900">{{ number_format($summary['total_tithes'] ?? 0, 0, ',', ' ') }}</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">{{ __('app.finances.total_offerings') }}</p>
                    <p class="text-xl font-bold text-gray-900">{{ number_format($summary['total_offerings'] ?? 0, 0, ',', ' ') }}</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">{{ __('app.finances.total_special') }}</p>
                    <p class="text-xl font-bold text-gray-900">{{ number_format($summary['total_special'] ?? 0, 0, ',', ' ') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Monthly Income Breakdown -->
        <div class="card">
            <h3 class="text-lg font-semibold text-primary-700 mb-4">{{ __('app.finances.monthly_summary') }} - Entrées</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="px-3 py-2 text-left font-medium text-gray-500">Mois</th>
                            <th class="px-3 py-2 text-right font-medium text-gray-500">{{ __('app.finances.tithe') }}</th>
                            <th class="px-3 py-2 text-right font-medium text-gray-500">{{ __('app.finances.offering') }}</th>
                            <th class="px-3 py-2 text-right font-medium text-gray-500">Spéciale</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @php
                            $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
                        @endphp
                        @for($m = 1; $m <= 12; $m++)
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-2">{{ $months[$m-1] }}</td>
                                <td class="px-3 py-2 text-right text-green-600">{{ number_format($monthlyTotals[$m]['tithe'] ?? 0, 0, ',', ' ') }}</td>
                                <td class="px-3 py-2 text-right text-green-600">{{ number_format($monthlyTotals[$m]['offering'] ?? 0, 0, ',', ' ') }}</td>
                                <td class="px-3 py-2 text-right text-green-600">{{ number_format($monthlyTotals[$m]['special_offering'] ?? 0, 0, ',', ' ') }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Expenses by Category -->
        <div class="card">
            <h3 class="text-lg font-semibold text-red-700 mb-4">Répartition des Dépenses</h3>
            @if(count($expensesByCategory) > 0)
                <div class="space-y-3">
                    @foreach($expensesByCategory as $key => $expense)
                        @if($expense['total'] > 0)
                            <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                                <span class="text-sm text-gray-700">{{ $expense['label'] }}</span>
                                <span class="font-semibold text-red-600">{{ number_format($expense['total'], 0, ',', ' ') }} CDF</span>
                            </div>
                        @endif
                    @endforeach
                </div>
                @php
                    $hasExpenses = collect($expensesByCategory)->sum('total') > 0;
                @endphp
                @if(!$hasExpenses)
                    <p class="text-gray-500 text-center py-4">Aucune dépense enregistrée pour cette année</p>
                @endif
            @else
                <p class="text-gray-500 text-center py-4">Aucune dépense enregistrée pour cette année</p>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top Tithers -->
        <div class="card">
            <h3 class="text-lg font-semibold text-primary-700 mb-4">Top 10 - {{ __('app.finances.tithe') }}</h3>
            @if($topTithers->count() > 0)
            <div class="space-y-3">
                @foreach($topTithers as $index => $tither)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <span class="w-8 h-8 flex items-center justify-center bg-primary-100 text-primary-700 font-bold rounded-full text-sm">
                            {{ $index + 1 }}
                        </span>
                        <div class="ml-3">
                            <p class="font-medium">{{ $tither->full_name }}</p>
                        </div>
                    </div>
                    <p class="font-semibold text-primary-700">{{ number_format($tither->total_tithes ?? 0, 0, ',', ' ') }} CDF</p>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-500 text-center py-4">{{ __('app.no_data') }}</p>
            @endif
        </div>

        <!-- Quick Links -->
        <div class="card">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Rapports détaillés</h3>
            <div class="space-y-3">
                <a href="{{ route('finances.incomes') }}" class="flex items-center justify-between p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <span class="font-medium text-gray-700">Voir toutes les entrées</span>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="{{ route('finances.expenses') }}" class="flex items-center justify-between p-4 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                        </div>
                        <span class="font-medium text-gray-700">Voir toutes les dépenses</span>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="{{ route('finances.zones') }}" class="flex items-center justify-between p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <span class="font-medium text-gray-700">Rapport par zone</span>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('finances.incomes') }}" class="text-primary-600 hover:text-primary-700 flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            {{ __('app.back') }}
        </a>
    </div>
</x-app-layout>
