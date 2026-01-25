<x-app-layout>
    <x-slot name="title">{{ __('app.attendance.title') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.attendance.title'))

    <style>
        .stat-card-enhanced {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .stat-card-enhanced:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .table-row-hover {
            transition: background-color 0.15s ease;
        }
        .table-row-hover:hover {
            background-color: #f8fafc;
        }
        .action-btn {
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.15s ease;
        }
        .action-btn:hover {
            background-color: #f3f4f6;
        }
        .action-btn:focus-visible {
            outline: 2px solid var(--color-primary-500);
            outline-offset: 2px;
        }
    </style>

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">{{ __('app.attendance.report') }}</h2>
            <p class="text-gray-500 mt-1">
                <span class="font-semibold text-primary-600">{{ $reports->total() }}</span> rapports enregistrés
            </p>
        </div>
        @can('reports.create')
        <a href="{{ route('reports.create') }}"
           class="inline-flex items-center justify-center px-4 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 transition-colors shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            {{ __('app.attendance.submit_report') }}
        </a>
        @endcan
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-5 mb-6">
        <form method="GET" action="{{ route('reports.index') }}" class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4">
            <div class="w-full sm:w-44">
                <label for="type" class="sr-only">Type de rapport</label>
                <select name="type" id="type"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors bg-white">
                    <option value="">{{ __('app.all') }} types</option>
                    <option value="bacenta_meeting" {{ request('type') === 'bacenta_meeting' ? 'selected' : '' }}>
                        {{ __('app.attendance.bacenta_meeting') }}
                    </option>
                    <option value="sunday_service" {{ request('type') === 'sunday_service' ? 'selected' : '' }}>
                        {{ __('app.attendance.sunday_service') }}
                    </option>
                </select>
            </div>
            <div class="w-full sm:w-48">
                <label for="bacenta_id" class="sr-only">Bacenta</label>
                <select name="bacenta_id" id="bacenta_id"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors bg-white">
                    <option value="">{{ __('app.all') }} bacentas</option>
                    @foreach($bacentas as $bacenta)
                        <option value="{{ $bacenta->id }}" {{ request('bacenta_id') == $bacenta->id ? 'selected' : '' }}>
                            {{ $bacenta->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="w-full sm:w-40">
                <label for="date_from" class="sr-only">Date de début</label>
                <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors">
            </div>
            <div class="w-full sm:w-40">
                <label for="date_to" class="sr-only">Date de fin</label>
                <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors">
            </div>
            <div class="flex gap-2">
                <button type="submit"
                        class="flex-1 sm:flex-none px-5 py-2.5 bg-primary-600 text-white font-medium rounded-xl hover:bg-primary-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 transition-colors">
                    {{ __('app.filter') }}
                </button>
                @if(request()->hasAny(['type', 'bacenta_id', 'date_from', 'date_to']))
                <a href="{{ route('reports.index') }}"
                   class="px-3 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-colors"
                   title="Réinitialiser les filtres">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Stats Summary -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="stat-card-enhanced bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500">Total Rapports</p>
            </div>
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_reports'] }}</p>
        </div>

        <div class="stat-card-enhanced bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500">{{ __('app.attendance.total_attendance') }}</p>
            </div>
            <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_attendance']) }}</p>
        </div>

        <div class="stat-card-enhanced bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500">{{ __('app.attendance.average_attendance') }}</p>
            </div>
            <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['avg_attendance'], 1) }}</p>
        </div>

        <div class="stat-card-enhanced bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl shadow-sm p-5 text-white">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-sm font-medium text-white/80">Total Offrandes</p>
            </div>
            <p class="text-2xl font-bold">{{ number_format($stats['total_offerings'], 0, ',', ' ') }}</p>
            <p class="text-xs text-white/60 mt-1">XOF</p>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('app.attendance.date') }}</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Bacenta</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Zone</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('app.attendance.type') }}</th>
                        <th class="px-5 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('app.attendance.count') }}</th>
                        <th class="px-5 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('app.attendance.offering') }}</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Soumis par</th>
                        <th class="px-5 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($reports as $report)
                    <tr class="table-row-hover">
                        <td class="px-5 py-4">
                            <time datetime="{{ $report->report_date->format('Y-m-d') }}" class="font-medium text-gray-900">
                                {{ $report->report_date->format('d/m/Y') }}
                            </time>
                        </td>
                        <td class="px-5 py-4">
                            <a href="{{ route('bacentas.show', $report->bacenta) }}"
                               class="text-primary-600 hover:text-primary-700 hover:underline font-medium transition-colors">
                                {{ $report->bacenta->name }}
                            </a>
                        </td>
                        <td class="px-5 py-4 text-gray-600">{{ $report->bacenta->zone?->name ?? '-' }}</td>
                        <td class="px-5 py-4">
                            @if($report->report_type === 'sunday_service')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-amber-100 text-amber-700">
                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                    {{ __('app.attendance.sunday_service') }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-primary-100 text-primary-700">
                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    {{ __('app.attendance.bacenta_meeting') }}
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-sm font-bold bg-primary-100 text-primary-700">
                                {{ $report->attendance_count }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-right">
                            <span class="font-bold text-amber-600">{{ number_format($report->offering_amount, 0, ',', ' ') }}</span>
                            <span class="text-xs text-gray-400 ml-1">XOF</span>
                        </td>
                        <td class="px-5 py-4 text-gray-600">{{ $report->submittedBy?->full_name ?? '-' }}</td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('reports.show', $report) }}"
                                   class="action-btn text-gray-500 hover:text-primary-600"
                                   title="{{ __('app.view') }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                @can('reports.edit')
                                <a href="{{ route('reports.edit', $report) }}"
                                   class="action-btn text-gray-500 hover:text-blue-600"
                                   title="{{ __('app.edit') }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-5 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                    </svg>
                                </div>
                                <p class="text-gray-500 font-medium">{{ __('app.no_data') }}</p>
                                <p class="text-gray-400 text-sm mt-1">Aucun rapport trouvé avec ces critères</p>
                                @can('reports.create')
                                <a href="{{ route('reports.create') }}" class="mt-4 text-primary-600 hover:text-primary-700 font-medium text-sm">
                                    + Soumettre un rapport
                                </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($reports->hasPages())
        <div class="px-5 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $reports->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
