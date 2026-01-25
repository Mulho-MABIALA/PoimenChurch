<x-app-layout>
    <x-slot name="title">{{ __('app.edit') }} Transaction - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.edit'))

    <div class="max-w-2xl mx-auto">
        <div class="card">
            <h2 class="text-xl font-bold text-primary-700 mb-6">{{ __('app.edit') }} Transaction #{{ $finance->id }}</h2>

            <form method="POST" action="{{ route('finances.update', $finance) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="transaction_type" class="label">{{ __('app.finances.transaction_type') }}</label>
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
                    <label for="amount" class="label">{{ __('app.finances.amount') }} (XOF)</label>
                    <input type="number" id="amount" name="amount" value="{{ old('amount', $finance->amount) }}" required min="0" step="1"
                        class="input @error('amount') input-error @enderror">
                    @error('amount')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="transaction_date" class="label">{{ __('app.finances.transaction_date') }}</label>
                    <input type="date" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', $finance->transaction_date->format('Y-m-d')) }}" required
                        class="input @error('transaction_date') input-error @enderror">
                    @error('transaction_date')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="payment_method" class="label">{{ __('app.finances.payment_method') }}</label>
                    <select id="payment_method" name="payment_method" required class="input @error('payment_method') input-error @enderror">
                        <option value="cash" {{ old('payment_method', $finance->payment_method) === 'cash' ? 'selected' : '' }}>{{ __('app.finances.cash') }}</option>
                        <option value="mobile_money" {{ old('payment_method', $finance->payment_method) === 'mobile_money' ? 'selected' : '' }}>{{ __('app.finances.mobile_money') }}</option>
                        <option value="bank_transfer" {{ old('payment_method', $finance->payment_method) === 'bank_transfer' ? 'selected' : '' }}>{{ __('app.finances.bank_transfer') }}</option>
                        <option value="check" {{ old('payment_method', $finance->payment_method) === 'check' ? 'selected' : '' }}>{{ __('app.finances.check') }}</option>
                    </select>
                    @error('payment_method')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="user_id" class="label">{{ __('app.finances.donor') }}</label>
                    <select id="user_id" name="user_id" class="input @error('user_id') input-error @enderror">
                        <option value="">-- {{ __('app.none') }} --</option>
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

                <div class="form-group">
                    <label for="description" class="label">{{ __('app.finances.description') }}</label>
                    <textarea id="description" name="description" rows="2"
                        class="input @error('description') input-error @enderror">{{ old('description', $finance->description) }}</textarea>
                    @error('description')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4">
                    <a href="{{ route('finances.index') }}" class="btn-outline">{{ __('app.cancel') }}</a>
                    <button type="submit" class="btn-primary">{{ __('app.update') }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
