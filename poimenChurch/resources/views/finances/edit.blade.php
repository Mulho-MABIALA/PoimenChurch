<x-app-layout>
    <x-slot name="title">{{ __('app.edit') }} Transaction - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.edit'))

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
            <div class="flex items-center gap-3 mb-6">
                @if($finance->category === 'expense')
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Modifier la dépense #{{ $finance->id }}</h2>
                @else
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Modifier l'entrée #{{ $finance->id }}</h2>
                @endif
            </div>

            <form method="POST" action="{{ route('finances.update', $finance) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="category" value="{{ $finance->category }}">

                <div class="space-y-4">
                    @if($finance->category === 'income')
                        {{-- Income-specific fields --}}
                        <div class="form-group">
                            <label for="transaction_type" class="label">{{ __('app.finances.transaction_type') }} *</label>
                            <select id="transaction_type" name="transaction_type" required class="input @error('transaction_type') input-error @enderror">
                                <option value="tithe" {{ old('transaction_type', $finance->transaction_type) === 'tithe' ? 'selected' : '' }}>{{ __('app.finances.tithe') }}</option>
                                <option value="offering" {{ old('transaction_type', $finance->transaction_type) === 'offering' ? 'selected' : '' }}>{{ __('app.finances.offering') }}</option>
                                <option value="special_offering" {{ old('transaction_type', $finance->transaction_type) === 'special_offering' ? 'selected' : '' }}>{{ __('app.finances.special_offering') }}</option>
                            </select>
                            @error('transaction_type')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="user_id" class="label">{{ __('app.finances.donor') }}</label>
                            <select id="user_id" name="user_id" class="input @error('user_id') input-error @enderror">
                                <option value="">-- Anonyme --</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}" {{ old('user_id', $finance->user_id) == $member->id ? 'selected' : '' }}>
                                        {{ $member->full_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    @else
                        {{-- Expense-specific fields --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label for="expense_category" class="label">Catégorie de dépense *</label>
                                <select id="expense_category" name="expense_category" required class="input @error('expense_category') input-error @enderror">
                                    <option value="">-- Sélectionner --</option>
                                    @foreach($expenseCategories as $key => $label)
                                        <option value="{{ $key }}" {{ old('expense_category', $finance->expense_category) === $key ? 'selected' : '' }}>
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
                                    <option value="treasury" {{ old('funding_source', $finance->funding_source) === 'treasury' ? 'selected' : '' }}>
                                        Caisse de l'église (diminue le solde)
                                    </option>
                                    <option value="external" {{ old('funding_source', $finance->funding_source) === 'external' ? 'selected' : '' }}>
                                        Source externe (n'affecte pas le solde)
                                    </option>
                                </select>
                                @error('funding_source')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label for="vendor" class="label">Fournisseur / Bénéficiaire</label>
                                <input type="text" id="vendor" name="vendor" value="{{ old('vendor', $finance->vendor) }}"
                                    class="input @error('vendor') input-error @enderror" placeholder="Nom du fournisseur...">
                                @error('vendor')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="invoice_number" class="label">N° Facture / Reçu</label>
                                <input type="text" id="invoice_number" name="invoice_number" value="{{ old('invoice_number', $finance->invoice_number) }}"
                                    class="input @error('invoice_number') input-error @enderror" placeholder="FAC-001...">
                                @error('invoice_number')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @endif

                    {{-- Common fields --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="amount" class="label">{{ __('app.finances.amount') }} (CDF) *</label>
                            <input type="number" id="amount" name="amount" value="{{ old('amount', $finance->amount) }}" required min="1" step="1"
                                class="input @error('amount') input-error @enderror" placeholder="0">
                            @error('amount')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="transaction_date" class="label">{{ __('app.finances.transaction_date') }} *</label>
                            <input type="date" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', $finance->transaction_date->format('Y-m-d')) }}" required
                                class="input @error('transaction_date') input-error @enderror" max="{{ now()->format('Y-m-d') }}">
                            @error('transaction_date')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="payment_method" class="label">{{ __('app.finances.payment_method') }} *</label>
                            <select id="payment_method" name="payment_method" required class="input @error('payment_method') input-error @enderror">
                                <option value="cash" {{ old('payment_method', $finance->payment_method) === 'cash' ? 'selected' : '' }}>{{ __('app.finances.cash') }}</option>
                                <option value="mobile_money" {{ old('payment_method', $finance->payment_method) === 'mobile_money' ? 'selected' : '' }}>{{ __('app.finances.mobile_money') }}</option>
                                <option value="bank_transfer" {{ old('payment_method', $finance->payment_method) === 'bank_transfer' ? 'selected' : '' }}>{{ __('app.finances.bank_transfer') }}</option>
                                <option value="check" {{ old('payment_method', $finance->payment_method) === 'check' ? 'selected' : '' }}>{{ __('app.finances.check') }}</option>
                                <option value="other" {{ old('payment_method', $finance->payment_method) === 'other' ? 'selected' : '' }}>Autre</option>
                            </select>
                            @error('payment_method')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="payment_reference" class="label">Référence paiement</label>
                            <input type="text" id="payment_reference" name="payment_reference" value="{{ old('payment_reference', $finance->payment_reference) }}"
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
                                    <option value="{{ $branch->id }}" {{ old('branch_id', $finance->branch_id) == $branch->id ? 'selected' : '' }}>
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
                                    <option value="{{ $zone->id }}" {{ old('zone_id', $finance->zone_id) == $zone->id ? 'selected' : '' }}>
                                        {{ $zone->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="label">{{ __('app.finances.description') }}</label>
                        <textarea id="description" name="description" rows="3" class="input @error('description') input-error @enderror"
                            placeholder="Détails de la transaction...">{{ old('description', $finance->description) }}</textarea>
                        @error('description')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="btn-primary flex-1 {{ $finance->category === 'expense' ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }}">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ __('app.update') }}
                    </button>
                    @if($finance->category === 'expense')
                        <a href="{{ route('finances.expenses') }}" class="btn-outline">{{ __('app.cancel') }}</a>
                    @else
                        <a href="{{ route('finances.incomes') }}" class="btn-outline">{{ __('app.cancel') }}</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
