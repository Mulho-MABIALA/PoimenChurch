<x-app-layout>
    <x-slot name="title">{{ __('app.finances.title') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.finances.title'))

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
        .amount-display {
            font-variant-numeric: tabular-nums;
        }
    </style>

    <!-- Quick Navigation -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <a href="{{ route('finances.incomes') }}" class="card hover:shadow-md transition-shadow flex items-center gap-4 p-4">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-gray-900">Entrées</p>
                <p class="text-sm text-gray-500">Dîmes, offrandes</p>
            </div>
        </a>

        <a href="{{ route('finances.expenses') }}" class="card hover:shadow-md transition-shadow flex items-center gap-4 p-4">
            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-gray-900">Dépenses</p>
                <p class="text-sm text-gray-500">Sorties de caisse</p>
            </div>
        </a>

        <a href="{{ route('finances.annual') }}" class="card hover:shadow-md transition-shadow flex items-center gap-4 p-4">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-gray-900">Rapport annuel</p>
                <p class="text-sm text-gray-500">Résumé {{ now()->year }}</p>
            </div>
        </a>

        <a href="{{ route('finances.zones') }}" class="card hover:shadow-md transition-shadow flex items-center gap-4 p-4">
            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-gray-900">Par zone</p>
                <p class="text-sm text-gray-500">Rapport par zone</p>
            </div>
        </a>
    </div>

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">{{ __('app.finances.title') }}</h2>
            <p class="text-gray-500 mt-1">
                <span class="font-semibold text-primary-600">{{ $transactions->total() }}</span> transactions enregistrées
            </p>
        </div>
        <div class="flex gap-2">
            @can('finances.create')
            <a href="{{ route('finances.create') }}"
               class="inline-flex items-center justify-center px-4 py-2.5 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-colors shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nouvelle entrée
            </a>
            <a href="{{ route('finances.create-expense') }}"
               class="inline-flex items-center justify-center px-4 py-2.5 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 transition-colors shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                </svg>
                Nouvelle dépense
            </a>
            @endcan
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="stat-card-enhanced bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500">{{ __('app.finances.total_tithes') }}</p>
            </div>
            <p class="amount-display text-2xl font-bold text-gray-900">{{ number_format($stats['total_tithes'], 0, ',', ' ') }}</p>
            <p class="text-xs text-gray-400 mt-1">XOF</p>
        </div>

        <div class="stat-card-enhanced bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500">{{ __('app.finances.total_offerings') }}</p>
            </div>
            <p class="amount-display text-2xl font-bold text-gray-900">{{ number_format($stats['total_offerings'], 0, ',', ' ') }}</p>
            <p class="text-xs text-gray-400 mt-1">XOF</p>
        </div>

        <div class="stat-card-enhanced bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-500">{{ __('app.finances.total_special') }}</p>
            </div>
            <p class="amount-display text-2xl font-bold text-gray-900">{{ number_format($stats['total_special'], 0, ',', ' ') }}</p>
            <p class="text-xs text-gray-400 mt-1">XOF</p>
        </div>

        <div class="stat-card-enhanced bg-gradient-to-br from-primary-600 to-primary-700 rounded-2xl shadow-sm p-5 text-white">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <p class="text-sm font-medium text-white/80">Total {{ $currentYear }}</p>
            </div>
            <p class="amount-display text-2xl font-bold">{{ number_format($stats['total_incomes'], 0, ',', ' ') }}</p>
            <p class="text-xs text-white/60 mt-1">XOF</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-5 mb-6">
        <form method="GET" action="{{ route('finances.index') }}" class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4">
            <div class="w-full sm:w-44">
                <label for="type" class="sr-only">Type de transaction</label>
                <select name="type" id="type"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors bg-white">
                    <option value="">{{ __('app.all') }} types</option>
                    <option value="tithe" {{ request('type') === 'tithe' ? 'selected' : '' }}>{{ __('app.finances.tithe') }}</option>
                    <option value="offering" {{ request('type') === 'offering' ? 'selected' : '' }}>{{ __('app.finances.offering') }}</option>
                    <option value="special_offering" {{ request('type') === 'special_offering' ? 'selected' : '' }}>{{ __('app.finances.special_offering') }}</option>
                </select>
            </div>
            <div class="w-full sm:w-44">
                <label for="payment_method" class="sr-only">Méthode de paiement</label>
                <select name="payment_method" id="payment_method"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors bg-white">
                    <option value="">{{ __('app.all') }} paiements</option>
                    <option value="cash" {{ request('payment_method') === 'cash' ? 'selected' : '' }}>{{ __('app.finances.cash') }}</option>
                    <option value="mobile_money" {{ request('payment_method') === 'mobile_money' ? 'selected' : '' }}>{{ __('app.finances.mobile_money') }}</option>
                    <option value="bank_transfer" {{ request('payment_method') === 'bank_transfer' ? 'selected' : '' }}>{{ __('app.finances.bank_transfer') }}</option>
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
                @if(request()->hasAny(['type', 'payment_method', 'date_from', 'date_to']))
                <a href="{{ route('finances.index') }}"
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

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('app.finances.transaction_date') }}</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('app.finances.transaction_type') }}</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('app.finances.donor') }}</th>
                        <th class="px-5 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('app.finances.amount') }}</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('app.finances.payment_method') }}</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('app.finances.recorded_by') }}</th>
                        <th class="px-5 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">{{ __('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($transactions as $transaction)
                    <tr class="table-row-hover">
                        <td class="px-5 py-4">
                            <time datetime="{{ $transaction->transaction_date->format('Y-m-d') }}" class="font-medium text-gray-900">
                                {{ $transaction->transaction_date->format('d/m/Y') }}
                            </time>
                        </td>
                        <td class="px-5 py-4">
                            @if($transaction->transaction_type === 'tithe')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-primary-100 text-primary-700">
                                    {{ __('app.finances.tithe') }}
                                </span>
                            @elseif($transaction->transaction_type === 'offering')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-amber-100 text-amber-700">
                                    {{ __('app.finances.offering') }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-green-100 text-green-700">
                                    {{ __('app.finances.special_offering') }}
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            @if($transaction->user)
                                <a href="{{ route('members.show', $transaction->user) }}"
                                   class="text-primary-600 hover:text-primary-700 hover:underline font-medium transition-colors">
                                    {{ $transaction->user->full_name }}
                                </a>
                            @else
                                <span class="text-gray-400 italic">Anonyme</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-right">
                            <span class="amount-display font-bold text-amber-600">{{ number_format($transaction->amount, 0, ',', ' ') }}</span>
                            <span class="text-xs text-gray-400 ml-1">XOF</span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 text-gray-600">
                                @if($transaction->payment_method === 'cash')
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                @elseif($transaction->payment_method === 'mobile_money')
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                    </svg>
                                @endif
                                {{ $transaction->payment_method_label }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-gray-600">{{ $transaction->recordedBy?->full_name ?? '-' }}</td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('finances.show', $transaction) }}"
                                   class="action-btn text-gray-500 hover:text-primary-600"
                                   title="{{ __('app.view') }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                @can('finances.edit')
                                <a href="{{ route('finances.edit', $transaction) }}"
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
                        <td colspan="7" class="px-5 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <p class="text-gray-500 font-medium">{{ __('app.no_data') }}</p>
                                <p class="text-gray-400 text-sm mt-1">Aucune transaction trouvée avec ces critères</p>
                                @can('finances.create')
                                <a href="{{ route('finances.create') }}" class="mt-4 text-primary-600 hover:text-primary-700 font-medium text-sm">
                                    + Enregistrer une transaction
                                </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transactions->hasPages())
        <div class="px-5 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
