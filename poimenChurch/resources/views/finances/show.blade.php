<x-app-layout>
    <x-slot name="title">Transaction #{{ $finance->id }} - {{ config('app.name') }}</x-slot>

    @section('page-title', 'Transaction #' . $finance->id)

    <div class="max-w-2xl mx-auto">
        <div class="card">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-primary-700">{{ __('app.details') }}</h2>
                @can('finances.edit')
                <a href="{{ route('finances.edit', $finance) }}" class="btn-outline">{{ __('app.edit') }}</a>
                @endcan
            </div>

            <dl class="space-y-4">
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
                <div class="flex justify-between py-2 border-b">
                    <dt class="text-text-secondary">{{ __('app.finances.amount') }}</dt>
                    <dd class="font-semibold text-primary-700">{{ number_format($finance->amount, 0, ',', ' ') }} XOF</dd>
                </div>
                <div class="flex justify-between py-2 border-b">
                    <dt class="text-text-secondary">{{ __('app.finances.transaction_date') }}</dt>
                    <dd class="font-medium">{{ $finance->transaction_date->format('d/m/Y') }}</dd>
                </div>
                <div class="flex justify-between py-2 border-b">
                    <dt class="text-text-secondary">{{ __('app.finances.payment_method') }}</dt>
                    <dd class="font-medium">{{ __('app.finances.' . $finance->payment_method) }}</dd>
                </div>
                <div class="flex justify-between py-2 border-b">
                    <dt class="text-text-secondary">{{ __('app.finances.donor') }}</dt>
                    <dd class="font-medium">{{ $finance->user?->full_name ?? '-' }}</dd>
                </div>
                <div class="flex justify-between py-2 border-b">
                    <dt class="text-text-secondary">{{ __('app.finances.recorded_by') }}</dt>
                    <dd class="font-medium">{{ $finance->recordedBy?->full_name ?? '-' }}</dd>
                </div>
                @if($finance->description)
                <div class="py-2">
                    <dt class="text-text-secondary mb-1">{{ __('app.finances.description') }}</dt>
                    <dd class="font-medium">{{ $finance->description }}</dd>
                </div>
                @endif
            </dl>

            <div class="mt-6">
                <a href="{{ route('finances.index') }}" class="text-primary-600 hover:text-primary-700">
                    &larr; {{ __('app.back') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
