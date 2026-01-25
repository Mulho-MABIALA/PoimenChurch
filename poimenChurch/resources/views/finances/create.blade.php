<x-app-layout>
    <x-slot name="title">{{ __('app.finances.add_transaction') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.finances.add_transaction'))

    <div class="mb-6">
        <a href="{{ route('finances.index') }}" class="text-primary-600 hover:text-primary-700 flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            {{ __('app.back') }}
        </a>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="card">
            <h2 class="text-xl font-bold text-primary-700 mb-6">{{ __('app.finances.add_transaction') }}</h2>

            <form method="POST" action="{{ route('finances.store') }}">
                @csrf

                <div class="space-y-4">
                    <div class="form-group">
                        <label for="transaction_type" class="label">{{ __('app.finances.transaction_type') }} *</label>
                        <select id="transaction_type" name="transaction_type" required class="input @error('transaction_type') input-error @enderror">
                            <option value="tithe" {{ old('transaction_type') === 'tithe' ? 'selected' : '' }}>{{ __('app.finances.tithe') }}</option>
                            <option value="offering" {{ old('transaction_type') === 'offering' ? 'selected' : '' }}>{{ __('app.finances.offering') }}</option>
                            <option value="special_offering" {{ old('transaction_type') === 'special_offering' ? 'selected' : '' }}>{{ __('app.finances.special_offering') }}</option>
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
                                <option value="{{ $member->id }}" {{ old('user_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->full_name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="form-help">Laisser vide pour un don anonyme</p>
                        @error('user_id')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="amount" class="label">{{ __('app.finances.amount') }} (XOF) *</label>
                            <input type="number" id="amount" name="amount" value="{{ old('amount') }}" required min="0" step="1"
                                class="input @error('amount') input-error @enderror" placeholder="0">
                            @error('amount')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="transaction_date" class="label">{{ __('app.finances.transaction_date') }} *</label>
                            <input type="date" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', now()->format('Y-m-d')) }}" required
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
                                <option value="cash" {{ old('payment_method', 'cash') === 'cash' ? 'selected' : '' }}>{{ __('app.finances.cash') }}</option>
                                <option value="mobile_money" {{ old('payment_method') === 'mobile_money' ? 'selected' : '' }}>{{ __('app.finances.mobile_money') }}</option>
                                <option value="bank_transfer" {{ old('payment_method') === 'bank_transfer' ? 'selected' : '' }}>{{ __('app.finances.bank_transfer') }}</option>
                                <option value="check" {{ old('payment_method') === 'check' ? 'selected' : '' }}>{{ __('app.finances.check') }}</option>
                                <option value="other" {{ old('payment_method') === 'other' ? 'selected' : '' }}>{{ __('app.finances.other') }}</option>
                            </select>
                            @error('payment_method')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="payment_reference" class="label">Reference (optionnel)</label>
                            <input type="text" id="payment_reference" name="payment_reference" value="{{ old('payment_reference') }}"
                                class="input @error('payment_reference') input-error @enderror" placeholder="N de cheque, reference mobile...">
                            @error('payment_reference')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="branch_id" class="label">Branche</label>
                            <select id="branch_id" name="branch_id" class="input">
                                <option value="">-- Selectionner --</option>
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
                                <option value="">-- Selectionner --</option>
                                @foreach($zones as $zone)
                                    <option value="{{ $zone->id }}" {{ old('zone_id') == $zone->id ? 'selected' : '' }}>
                                        {{ $zone->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="label">{{ __('app.finances.description') }}</label>
                        <textarea id="description" name="description" rows="2" class="input @error('description') input-error @enderror" placeholder="Notes additionnelles...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex gap-3">
                    <button type="submit" class="btn-primary flex-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ __('app.save') }}
                    </button>
                    <a href="{{ route('finances.index') }}" class="btn-outline">{{ __('app.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
