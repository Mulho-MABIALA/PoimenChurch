<x-app-layout>
    <x-slot name="title">Entrées - {{ config('app.name') }}</x-slot>

    @section('page-title', 'Gestion des Entrées')

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="card bg-gradient-to-br from-green-500 to-green-600 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm">Total Entrées {{ $currentYear }}</p>
                    <p class="text-2xl font-bold mt-1">{{ number_format($stats['total_incomes'], 0, ',', ' ') }} CDF</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card bg-gradient-to-br from-red-500 to-red-600 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-sm">Total Dépenses {{ $currentYear }}</p>
                    <p class="text-2xl font-bold mt-1">{{ number_format($stats['total_expenses'], 0, ',', ' ') }} CDF</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card {{ $stats['balance'] >= 0 ? 'bg-gradient-to-br from-blue-500 to-blue-600' : 'bg-gradient-to-br from-orange-500 to-orange-600' }} text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white/80 text-sm">Solde {{ $currentYear }}</p>
                    <p class="text-2xl font-bold mt-1">{{ number_format($stats['balance'], 0, ',', ' ') }} CDF</p>
                </div>
                <div class="bg-white/20 p-3 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Incomes by Type -->
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
                    <p class="text-xl font-bold text-gray-900">{{ number_format($stats['total_tithes'], 0, ',', ' ') }}</p>
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
                    <p class="text-xl font-bold text-gray-900">{{ number_format($stats['total_offerings'], 0, ',', ' ') }}</p>
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
                    <p class="text-xl font-bold text-gray-900">{{ number_format($stats['total_special'], 0, ',', ' ') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div class="flex items-center gap-4">
            <span class="text-primary-600 font-semibold border-b-2 border-primary-600 pb-1">
                Entrées
            </span>
            <a href="{{ route('finances.expenses') }}" class="text-gray-500 hover:text-primary-600 font-medium">
                Sorties
            </a>
        </div>
        @can('finances.create')
        <a href="{{ route('finances.create') }}"
           class="inline-flex items-center justify-center px-4 py-2.5 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-colors shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nouvelle entrée
        </a>
        @endcan
    </div>

    <!-- Filters -->
    <div class="card mb-6">
        <form method="GET" action="{{ route('finances.incomes') }}" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher par donateur..."
                    class="input">
            </div>

            <div class="w-44">
                <select name="type" class="input">
                    <option value="">Tous les types</option>
                    <option value="tithe" {{ request('type') === 'tithe' ? 'selected' : '' }}>{{ __('app.finances.tithe') }}</option>
                    <option value="offering" {{ request('type') === 'offering' ? 'selected' : '' }}>{{ __('app.finances.offering') }}</option>
                    <option value="special_offering" {{ request('type') === 'special_offering' ? 'selected' : '' }}>{{ __('app.finances.special_offering') }}</option>
                </select>
            </div>

            <div class="w-44">
                <select name="payment_method" class="input">
                    <option value="">Tous les paiements</option>
                    <option value="cash" {{ request('payment_method') === 'cash' ? 'selected' : '' }}>{{ __('app.finances.cash') }}</option>
                    <option value="mobile_money" {{ request('payment_method') === 'mobile_money' ? 'selected' : '' }}>{{ __('app.finances.mobile_money') }}</option>
                    <option value="bank_transfer" {{ request('payment_method') === 'bank_transfer' ? 'selected' : '' }}>{{ __('app.finances.bank_transfer') }}</option>
                </select>
            </div>

            <div class="w-32">
                <select name="year" class="input">
                    @for($y = now()->year; $y >= now()->year - 5; $y--)
                        <option value="{{ $y }}" {{ request('year', now()->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>

            <button type="submit" class="btn-primary">Filtrer</button>
            @if(request()->hasAny(['search', 'type', 'payment_method', 'year']))
                <a href="{{ route('finances.incomes') }}" class="btn-outline">Réinitialiser</a>
            @endif
        </form>
    </div>

    <!-- Transactions Table -->
    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('app.finances.transaction_date') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('app.finances.transaction_type') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('app.finances.donor') }}</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">{{ __('app.finances.amount') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('app.finances.payment_method') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('app.finances.recorded_by') }}</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">{{ __('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($transactions as $transaction)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $transaction->transaction_date->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($transaction->transaction_type === 'tithe')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                    {{ __('app.finances.tithe') }}
                                </span>
                            @elseif($transaction->transaction_type === 'offering')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                    {{ __('app.finances.offering') }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ __('app.finances.special_offering') }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($transaction->user)
                                <a href="{{ route('members.show', $transaction->user) }}"
                                   class="text-primary-600 hover:text-primary-700 hover:underline font-medium">
                                    {{ $transaction->user->full_name }}
                                </a>
                            @else
                                <span class="text-gray-400 italic">Anonyme</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold text-green-600 text-right">
                            +{{ number_format($transaction->amount, 0, ',', ' ') }} {{ $transaction->currency }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $transaction->payment_method_label }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $transaction->recordedBy?->full_name ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('finances.show', $transaction) }}" class="text-gray-400 hover:text-primary-600" title="{{ __('app.view') }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                @can('finances.edit')
                                <a href="{{ route('finances.edit', $transaction) }}" class="text-gray-400 hover:text-yellow-600" title="{{ __('app.edit') }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                @endcan
                                @can('finances.delete')
                                <form action="{{ route('finances.destroy', $transaction) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Supprimer cette entrée ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-600" title="{{ __('app.delete') }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <p class="text-gray-500 font-medium">Aucune entrée trouvée</p>
                                @can('finances.create')
                                <a href="{{ route('finances.create') }}" class="mt-4 text-primary-600 hover:text-primary-700 font-medium text-sm">
                                    + Enregistrer une entrée
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
        <div class="px-6 py-4 border-t">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
