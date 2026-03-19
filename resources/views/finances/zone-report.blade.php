<x-app-layout>
    <x-slot name="title">Rapport par Zone - {{ config('app.name') }}</x-slot>

    @section('page-title', 'Rapport par Zone')

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h2 class="text-2xl font-bold text-primary-700">Rapport Financier par Zone - {{ $year }}</h2>

        <form method="GET" class="flex items-center gap-2">
            <select name="year" class="input" onchange="this.form.submit()">
                @for($y = now()->year; $y >= now()->year - 5; $y--)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </form>
    </div>

    <div class="card">
        <div class="overflow-x-auto">
            <table class="table-base">
                <thead>
                    <tr>
                        <th>Zone</th>
                        <th class="text-right">{{ __('app.finances.total_tithes') }}</th>
                        <th class="text-right">{{ __('app.finances.total_offerings') }}</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($zones as $zone)
                    <tr>
                        <td class="font-medium">{{ $zone->name }}</td>
                        <td class="text-right">{{ number_format($zone->tithe_amount ?? 0, 0, ',', ' ') }}</td>
                        <td class="text-right">{{ number_format($zone->offering_amount ?? 0, 0, ',', ' ') }}</td>
                        <td class="text-right font-semibold text-primary-700">{{ number_format($zone->total_amount ?? 0, 0, ',', ' ') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-text-secondary">{{ __('app.no_data') }}</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-gray-50 font-semibold">
                        <td>Total</td>
                        <td class="text-right">{{ number_format($zones->sum('tithe_amount'), 0, ',', ' ') }}</td>
                        <td class="text-right">{{ number_format($zones->sum('offering_amount'), 0, ',', ' ') }}</td>
                        <td class="text-right text-primary-700">{{ number_format($zones->sum('total_amount'), 0, ',', ' ') }} XOF</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('finances.index') }}" class="text-primary-600 hover:text-primary-700">
            &larr; {{ __('app.back') }}
        </a>
    </div>
</x-app-layout>
