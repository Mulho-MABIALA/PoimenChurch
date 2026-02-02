<x-app-layout>
    <x-slot name="title">Transaction #{{ $finance->id }} - {{ config('app.name') }}</x-slot>

    @section('page-title', 'Transaction #' . $finance->id)

    <div class="mb-6">
        @if($finance->category === 'expense')
            <a href="{{ route('finances.expenses') }}" class="text-primary-600 hover:text-primary-700 flex items-center">
        @else
            <a href="{{ route('finances.incomes') }}" class="text-primary-600 hover:text-primary-700 flex items-center">
        @endif
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            {{ __('app.back') }}
        </a>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="card">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    @if($finance->category === 'expense')
                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-red-700">Dépense</h2>
                    @else
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-green-700">Entrée</h2>
                    @endif
                </div>
                @can('finances.edit')
                <a href="{{ route('finances.edit', $finance) }}" class="btn-outline">{{ __('app.edit') }}</a>
                @endcan
            </div>

            <dl class="space-y-4">
                @if($finance->category === 'income')
                    <div class="flex justify-between py-2 border-b">
                        <dt class="text-text-secondary">{{ __('app.finances.transaction_type') }}</dt>
                        <dd class="font-medium">
                            @if($finance->transaction_type === 'tithe')
                                <span class="badge-success">{{ __('app.finances.tithe') }}</span>
                            @elseif($finance->transaction_type === 'offering')
                                <span class="badge-warning">{{ __('app.finances.offering') }}</span>
                            @else
                                <span class="badge-info">{{ __('app.finances.special_offering') }}</span>
                            @endif
                        </dd>
                    </div>
                @else
                    <div class="flex justify-between py-2 border-b">
                        <dt class="text-text-secondary">Catégorie de dépense</dt>
                        <dd class="font-medium">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                {{ $finance->expense_category_label }}
                            </span>
                        </dd>
                    </div>
                    <div class="flex justify-between py-2 border-b">
                        <dt class="text-text-secondary">Source de financement</dt>
                        <dd class="font-medium">
                            @if($finance->funding_source === 'treasury')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                    Caisse de l'église
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Source externe
                                </span>
                            @endif
                        </dd>
                    </div>
                @endif

                <div class="flex justify-between py-2 border-b">
                    <dt class="text-text-secondary">{{ __('app.finances.amount') }}</dt>
                    <dd class="font-semibold {{ $finance->category === 'expense' ? 'text-red-600' : 'text-green-600' }}">
                        {{ $finance->category === 'expense' ? '-' : '+' }}{{ number_format($finance->amount, 0, ',', ' ') }} {{ $finance->currency }}
                    </dd>
                </div>

                <div class="flex justify-between py-2 border-b">
                    <dt class="text-text-secondary">{{ __('app.finances.transaction_date') }}</dt>
                    <dd class="font-medium">{{ $finance->transaction_date->format('d/m/Y') }}</dd>
                </div>

                <div class="flex justify-between py-2 border-b">
                    <dt class="text-text-secondary">{{ __('app.finances.payment_method') }}</dt>
                    <dd class="font-medium">{{ $finance->payment_method_label }}</dd>
                </div>

                @if($finance->payment_reference)
                    <div class="flex justify-between py-2 border-b">
                        <dt class="text-text-secondary">Référence paiement</dt>
                        <dd class="font-medium">{{ $finance->payment_reference }}</dd>
                    </div>
                @endif

                @if($finance->category === 'income')
                    <div class="flex justify-between py-2 border-b">
                        <dt class="text-text-secondary">{{ __('app.finances.donor') }}</dt>
                        <dd class="font-medium">
                            @if($finance->user)
                                <a href="{{ route('members.show', $finance->user) }}" class="text-primary-600 hover:underline">
                                    {{ $finance->user->full_name }}
                                </a>
                            @else
                                <span class="text-gray-400 italic">Anonyme</span>
                            @endif
                        </dd>
                    </div>
                @else
                    @if($finance->vendor)
                        <div class="flex justify-between py-2 border-b">
                            <dt class="text-text-secondary">Fournisseur / Bénéficiaire</dt>
                            <dd class="font-medium">{{ $finance->vendor }}</dd>
                        </div>
                    @endif

                    @if($finance->invoice_number)
                        <div class="flex justify-between py-2 border-b">
                            <dt class="text-text-secondary">N° Facture / Reçu</dt>
                            <dd class="font-medium">{{ $finance->invoice_number }}</dd>
                        </div>
                    @endif
                @endif

                @if($finance->branch)
                    <div class="flex justify-between py-2 border-b">
                        <dt class="text-text-secondary">Branche</dt>
                        <dd class="font-medium">{{ $finance->branch->name }}</dd>
                    </div>
                @endif

                @if($finance->zone)
                    <div class="flex justify-between py-2 border-b">
                        <dt class="text-text-secondary">Zone</dt>
                        <dd class="font-medium">{{ $finance->zone->name }}</dd>
                    </div>
                @endif

                <div class="flex justify-between py-2 border-b">
                    <dt class="text-text-secondary">{{ __('app.finances.recorded_by') }}</dt>
                    <dd class="font-medium">{{ $finance->recordedBy?->full_name ?? '-' }}</dd>
                </div>

                @if($finance->category === 'expense' && $finance->approvedBy)
                    <div class="flex justify-between py-2 border-b">
                        <dt class="text-text-secondary">Approuvé par</dt>
                        <dd class="font-medium">{{ $finance->approvedBy->full_name }}</dd>
                    </div>
                @endif

                @if($finance->description)
                    <div class="py-2">
                        <dt class="text-text-secondary mb-1">{{ __('app.finances.description') }}</dt>
                        <dd class="font-medium bg-gray-50 p-3 rounded-lg">{{ $finance->description }}</dd>
                    </div>
                @endif

                <div class="flex justify-between py-2 text-sm text-gray-400">
                    <dt>Créé le</dt>
                    <dd>{{ $finance->created_at->format('d/m/Y H:i') }}</dd>
                </div>
            </dl>
        </div>
    </div>
</x-app-layout>
