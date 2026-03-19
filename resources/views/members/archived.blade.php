<x-app-layout>
    <x-slot name="title">Membres archivés - {{ config('app.name') }}</x-slot>

    @section('page-title', 'Membres archivés')

    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('members.index') }}" class="text-primary-600 hover:text-primary-700 flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Retour aux membres actifs
        </a>
    </div>

    <!-- Search -->
    <div class="card mb-6">
        <form method="GET" action="
        {{ route('members.archived') }}" class="flex gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..."
                    class="input">
            </div>
            <button type="submit" class="btn-primary">Rechercher</button>
            @if(request()->hasAny(['search']))
                <a href="{{ route('members.archived') }}" class="btn-outline">Réinitialiser</a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Membre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Structure</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Archivé le</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($members as $member)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($member->photo)
                                    <img src="{{ Storage::url($member->photo) }}" alt="" class="avatar-sm mr-3">
                                @else
                                    <div class="avatar-sm mr-3 bg-gray-200 flex items-center justify-center text-gray-500 font-medium">
                                        {{ strtoupper(substr($member->first_name, 0, 1) . substr($member->last_name, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="font-medium text-gray-900">{{ $member->full_name }}</div>
                                    <div class="text-sm text-gray-500">
                                        @foreach($member->roles as $role)
                                            <span class="badge badge-outline mr-1">{{ __('app.roles.' . $role->name) }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $member->email }}</div>
                            <div class="text-sm text-gray-500">{{ $member->phone }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            @if($member->branches->isNotEmpty())
                                <div>Branche: {{ $member->branches->pluck('name')->join(', ') }}</div>
                            @endif
                            @if($member->zones->isNotEmpty())
                                <div>Zone: {{ $member->zones->pluck('name')->join(', ') }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $member->deleted_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('members.restore', $member->id) }}" method="POST" class="inline">
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
                            Aucun membre archivé
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($members->hasPages())
        <div class="px-6 py-4 border-t">
            {{ $members->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
