<x-app-layout>
    <x-slot name="title">Gestion des Événements - {{ config('app.name') }}</x-slot>

    @section('page-title', 'Événements')

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Gestion des Événements</h2>
            <p class="text-gray-500 mt-1">
                <span class="font-semibold text-primary-600">{{ $events->total() }}</span> événement(s)
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.events.archived') }}"
               class="inline-flex items-center justify-center px-4 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                </svg>
                Archives
            </a>
            <a href="{{ route('admin.events.create') }}"
               class="inline-flex items-center justify-center px-4 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nouvel Événement
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-5 mb-6">
        <form method="GET" action="{{ route('admin.events.index') }}" class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4">
            <div class="flex-1 min-w-[200px]">
                <label for="search" class="sr-only">Rechercher</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           placeholder="Rechercher un événement..."
                           class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors">
                </div>
            </div>
            <div class="w-full sm:w-48">
                <label for="type" class="sr-only">Type</label>
                <select name="type" id="type"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors bg-white">
                    <option value="">Tous les types</option>
                    @foreach($types as $key => $label)
                        <option value="{{ $key }}" {{ request('type') === $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="w-full sm:w-40">
                <label for="status" class="sr-only">Statut</label>
                <select name="status" id="status"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors bg-white">
                    <option value="">Tous</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Publiés</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Brouillons</option>
                    <option value="upcoming" {{ request('status') === 'upcoming' ? 'selected' : '' }}>À venir</option>
                    <option value="past" {{ request('status') === 'past' ? 'selected' : '' }}>Passés</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit"
                        class="flex-1 sm:flex-none px-5 py-2.5 bg-primary-600 text-white font-medium rounded-xl hover:bg-primary-700 transition-colors">
                    Filtrer
                </button>
                @if(request()->hasAny(['search', 'type', 'status']))
                <a href="{{ route('admin.events.index') }}"
                   class="px-3 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-colors"
                   title="Réinitialiser les filtres">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Events Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Événement</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date & Horaire</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                        <th class="px-5 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                        <th class="px-5 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Publication</th>
                        <th class="px-5 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($events as $event)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                @if($event->image)
                                    <img src="{{ Storage::url($event->image) }}" alt=""
                                         class="w-12 h-12 rounded-xl object-cover ring-2 ring-gray-100">
                                @else
                                    <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-600 rounded-xl flex items-center justify-center text-white">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <a href="{{ route('admin.events.show', $event) }}"
                                       class="font-semibold text-gray-900 hover:text-primary-600 transition-colors truncate block">
                                        {{ $event->title }}
                                    </a>
                                    <p class="text-sm text-gray-500 truncate">{{ $event->location ?? 'Lieu non défini' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <div class="text-sm">
                                <div class="font-medium text-gray-900">{{ $event->formatted_date }}</div>
                                <div class="text-gray-500">{{ $event->formatted_time }}</div>
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-primary-100 text-primary-700">
                                {{ $event->type_label }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                @if($event->status_color === 'green') bg-green-100 text-green-700
                                @elseif($event->status_color === 'blue') bg-blue-100 text-blue-700
                                @else bg-gray-100 text-gray-700 @endif">
                                <span class="w-1.5 h-1.5 rounded-full mr-1.5
                                    @if($event->status_color === 'green') bg-green-500
                                    @elseif($event->status_color === 'blue') bg-blue-500
                                    @else bg-gray-500 @endif"></span>
                                {{ $event->status }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <form action="{{ route('admin.events.toggle-publish', $event) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 {{ $event->is_published ? 'bg-primary-600' : 'bg-gray-200' }}"
                                        title="{{ $event->is_published ? 'Dépublier' : 'Publier' }}">
                                    <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $event->is_published ? 'translate-x-5' : 'translate-x-0' }}"></span>
                                </button>
                            </form>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-1">
                                <a href="{{ route('admin.events.show', $event) }}"
                                   class="p-2 text-gray-500 hover:text-primary-600 hover:bg-gray-100 rounded-lg transition-colors"
                                   title="Voir">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.events.edit', $event) }}"
                                   class="p-2 text-gray-500 hover:text-blue-600 hover:bg-gray-100 rounded-lg transition-colors"
                                   title="Modifier">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir archiver cet événement ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="p-2 text-gray-500 hover:text-red-600 hover:bg-gray-100 rounded-lg transition-colors"
                                            title="Archiver">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <p class="text-gray-500 font-medium">Aucun événement trouvé</p>
                                <p class="text-gray-400 text-sm mt-1">Créez votre premier événement</p>
                                <a href="{{ route('admin.events.create') }}" class="mt-4 text-primary-600 hover:text-primary-700 font-medium text-sm">
                                    + Créer un événement
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($events->hasPages())
        <div class="px-5 py-4 border-t border-gray-100 bg-gray-50/50">
            {{ $events->links() }}
        </div>
        @endif
    </div>
</x-app-layout>
