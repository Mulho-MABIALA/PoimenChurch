<x-app-layout>
    <x-slot name="title">{{ __('app.finances.my_donations') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.finances.my_donations'))

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-2xl font-bold text-primary-700">{{ __('app.finances.my_donations') }}</h2>

        <form method="GET" class="flex items-center gap-2">
            <select name="year" class="input" onchange="this.form.submit()">
                @foreach($years as $y)
                    <option value="{{ $y }}" {{ $currentYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="stat-card">
            <p class="stat-label">{{ __('app.finances.total_tithes') }}</p>
            <p class="stat-value">{{ number_format($summary['total_tithes'] ?? 0, 0, ',', ' ') }} XOF</p>
        </div>
        <div class="kpi-card">
            <p class="stat-label">{{ __('app.finances.total_offerings') }}</p>
            <p class="kpi-value">{{ number_format($summary['total_offerings'] ?? 0, 0, ',', ' ') }} XOF</p>
        </div>
        <div class="stat-card">
            <p class="stat-label">Total</p>
            <p class="stat-value">{{ number_format(($summary['total_tithes'] ?? 0) + ($summary['total_offerings'] ?? 0) + ($summary['total_special'] ?? 0), 0, ',', ' ') }} XOF</p>
        </div>
    </div>

    <!-- Donations List -->
    <div class="card">
        <h3 class="text-lg font-semibold text-primary-700 mb-4">Historique des dons</h3>
        @if($donations->count() > 0)
        <div class="overflow-x-auto">
            <table class="table-base">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>{{ __('app.finances.payment_method') }}</th>
                        <th class="text-right">{{ __('app.finances.amount') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donations as $donation)
                    <tr>
                        <td>{{ $donation->transaction_date->format('d/m/Y') }}</td>
                        <td>
                            @if($donation->transaction_type === 'tithe')
                                <span class="badge-success">{{ __('app.finances.tithe') }}</span>
                            @elseif($donation->transaction_type === 'offering')
                                <span class="badge-warning">{{ __('app.finances.offering') }}</span>
                            @else
                                <span class="badge-info">{{ __('app.finances.special_offering') }}</span>
                            @endif
                        </td>
                        <td>{{ __('app.finances.' . $donation->payment_method) }}</td>
                        <td class="text-right font-semibold">{{ number_format($donation->amount, 0, ',', ' ') }} XOF</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($donations->hasPages())
        <div class="mt-4">
            {{ $donations->links() }}
        </div>
        @endif
        @else
        <p class="text-text-secondary text-center py-4">{{ __('app.no_data') }}</p>
        @endif
    </div>
</x-app-layout>
