<x-app-layout>
    <x-slot name="title">Nouvelle dépense - {{ config('app.name') }}</x-slot>

    @section('page-title', 'Nouvelle dépense')

    <div class="mb-6">
        <a href="{{ route('finances.expenses') }}" class="text-primary-600 hover:text-primary-700 flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            {{ __('app.back') }}
        </a>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="card">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-900">Enregistrer une dépense</h2>
            </div>

            <form method="POST" action="{{ route('finances.store') }}">
                @csrf
                <input type="hidden" name="category" value="expense">

                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="expense_category" class="label">Catégorie de dépense *</label>
                            <select id="expense_category" name="expense_category" required class="input @error('expense_category') input-error @enderror">
                                <option value="">-- Sélectionner --</option>
                                @foreach($expenseCategories as $key => $label)
                                    <option value="{{ $key }}" {{ old('expense_category') === $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('expense_category')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="funding_source" class="label">Source de financement *</label>
                            <select id="funding_source" name="funding_source" required class="input @error('funding_source') input-error @enderror">
                                <option value="treasury" {{ old('funding_source', 'treasury') === 'treasury' ? 'selected' : '' }}>
                                    Caisse de l'église (diminue le solde)
                                </option>
                                <option value="external" {{ old('funding_source') === 'external' ? 'selected' : '' }}>
                                    Source externe (n'affecte pas le solde)
                                </option>
                            </select>
                            @error('funding_source')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">
                                Si l'argent provient de la caisse, le solde sera diminué.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="amount" class="label">Montant (CDF) *</label>
                            <input type="number" id="amount" name="amount" value="{{ old('amount') }}" required min="1" step="1"
                                class="input @error('amount') input-error @enderror" placeholder="0">
                            @error('amount')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="transaction_date" class="label">Date *</label>
                            <input type="date" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', now()->format('Y-m-d')) }}" required
                                class="input @error('transaction_date') input-error @enderror" max="{{ now()->format('Y-m-d') }}">
                            @error('transaction_date')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="vendor" class="label">Fournisseur / Bénéficiaire</label>
                            <input type="text" id="vendor" name="vendor" value="{{ old('vendor') }}"
                                class="input @error('vendor') input-error @enderror" placeholder="Nom du fournisseur...">
                            @error('vendor')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="invoice_number" class="label">N° Facture / Reçu</label>
                            <input type="text" id="invoice_number" name="invoice_number" value="{{ old('invoice_number') }}"
                                class="input @error('invoice_number') input-error @enderror" placeholder="FAC-001...">
                            @error('invoice_number')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="payment_method" class="label">Mode de paiement *</label>
                            <select id="payment_method" name="payment_method" required class="input @error('payment_method') input-error @enderror">
                                <option value="cash" {{ old('payment_method', 'cash') === 'cash' ? 'selected' : '' }}>Espèces</option>
                                <option value="mobile_money" {{ old('payment_method') === 'mobile_money' ? 'selected' : '' }}>Mobile Money</option>
                                <option value="bank_transfer" {{ old('payment_method') === 'bank_transfer' ? 'selected' : '' }}>Virement bancaire</option>
                                <option value="check" {{ old('payment_method') === 'check' ? 'selected' : '' }}>Chèque</option>
                                <option value="other" {{ old('payment_method') === 'other' ? 'selected' : '' }}>Autre</option>
                            </select>
                            @error('payment_method')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="payment_reference" class="label">Référence paiement</label>
                            <input type="text" id="payment_reference" name="payment_reference" value="{{ old('payment_reference') }}"
                                class="input @error('payment_reference') input-error @enderror" placeholder="N° chèque, référence mobile...">
                            @error('payment_reference')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="branch_id" class="label">Branche</label>
                            <select id="branch_id" name="branch_id" class="input">
                                <option value="">-- Sélectionner --</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="zone_id" class="label">Zone</label>
                            <select id="zone_id" name="zone_id" class="input">
                                <option value="">-- Sélectionner --</option>
                                @foreach($zones as $zone)
                                    <option value="{{ $zone->id }}" {{ old('zone_id') == $zone->id ? 'selected' : '' }}>
                                        {{ $zone->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="label">Description / Justification</label>
                        <textarea id="description" name="description" rows="3" class="input @error('description') input-error @enderror"
                            placeholder="Détails de la dépense...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="btn-primary flex-1 bg-red-600 hover:bg-red-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Enregistrer la dépense
                    </button>
                    <a href="{{ route('finances.expenses') }}" class="btn-outline">{{ __('app.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
