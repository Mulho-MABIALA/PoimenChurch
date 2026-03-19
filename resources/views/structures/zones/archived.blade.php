<x-app-layout>
    <x-slot name="title">Zones archivées - {{ config('app.name') }}</x-slot>

    @section('page-title', 'Zones archivées')

    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('zones.index') }}" class="text-primary-600 hover:text-primary-700 flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Retour aux zones actives
        </a>
    </div>

    <!-- Search -->
    <div class="card mb-6">
        <form method="GET" action="{{ route('zones.archived') }}" class="flex gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..."
                    class="input">
            </div>
            <button type="submit" class="btn-primary">Rechercher</button>
            @if(request()->hasAny(['search']))
                <a href="{{ route('zones.archived') }}" class="btn-outline">Réinitialiser</a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Zone</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Branche</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Leader</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Archivée le</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($zones as $zone)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $zone->name }}</div>
                            @if($zone->description)
                                <div class="text-sm text-gray-500">{{ Str::limit($zone->description, 50) }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $zone->branch?->name ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $zone->leader?->full_name ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $zone->deleted_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('zones.restore', $zone->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-green-600 hover:text-green-900 font-medium text-sm">
                                    Restaurer
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            Aucune zone archivée
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($zones->hasPages())
        <div class="px-6 py-4 border-t">
            {{ $zones->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
