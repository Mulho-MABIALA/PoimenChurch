<x-app-layout>
    <x-slot name="title">Messages de Contact - {{ config('app.name') }}</x-slot>

    @section('page-title', 'Messages de Contact')

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Messages de Contact</h2>
            <p class="text-gray-500 mt-1">
                <span class="font-semibold text-primary-600">{{ $messages->total() }}</span> message(s)
                @if($newCount > 0)
                    &mdash; <span class="font-semibold text-blue-600">{{ $newCount }} nouveau(x)</span>
                @endif
            </p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Filters -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-5 mb-6">
        <form method="GET" action="{{ route('admin.contact-messages.index') }}" class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4">
            <div class="flex-1 min-w-[200px]">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Rechercher par nom, email ou sujet..."
                           class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors">
                </div>
            </div>

            <div class="w-full sm:w-44">
                <select name="status" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors bg-white">
                    <option value="">Tous les statuts</option>
                    <option value="nouveau"  {{ request('status') === 'nouveau'  ? 'selected' : '' }}>Nouveau</option>
                    <option value="lu"       {{ request('status') === 'lu'       ? 'selected' : '' }}>Lu</option>
                    <option value="repondu"  {{ request('status') === 'repondu'  ? 'selected' : '' }}>Repondu</option>
                    <option value="archive"  {{ request('status') === 'archive'  ? 'selected' : '' }}>Archive</option>
                </select>
            </div>

            <div class="w-full sm:w-52">
                <select name="subject" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors bg-white">
                    <option value="">Tous les sujets</option>
                    <option value="Information generale" {{ request('subject') === 'Information generale' ? 'selected' : '' }}>Information generale</option>
                    <option value="Priere"               {{ request('subject') === 'Priere'               ? 'selected' : '' }}>Demande de priere</option>
                    <option value="Visite pastorale"     {{ request('subject') === 'Visite pastorale'     ? 'selected' : '' }}>Visite pastorale</option>
                    <option value="Rejoindre un ministere" {{ request('subject') === 'Rejoindre un ministere' ? 'selected' : '' }}>Rejoindre un ministere</option>
                    <option value="Autre"                {{ request('subject') === 'Autre'                ? 'selected' : '' }}>Autre</option>
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit"
                        class="flex-1 sm:flex-none px-5 py-2.5 bg-primary-600 text-white font-medium rounded-xl hover:bg-primary-700 transition-colors">
                    Filtrer
                </button>
                @if(request()->hasAny(['search', 'status', 'subject']))
                <a href="{{ route('admin.contact-messages.index') }}"
                   class="px-3 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Messages Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        @forelse($messages as $message)
        <div class="flex items-start gap-4 px-5 py-4 border-b border-gray-100 last:border-0 hover:bg-gray-50/50 transition-colors {{ $message->isNew() ? 'bg-blue-50/30' : '' }}">
            <!-- Icon -->
            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5
                {{ $message->isNew() ? 'bg-blue-100' : 'bg-gray-100' }}">
                <svg class="w-5 h-5 {{ $message->isNew() ? 'text-blue-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>

            <!-- Content -->
            <div class="flex-1 min-w-0">
                <div class="flex flex-wrap items-center gap-2 mb-1">
                    <span class="font-semibold text-gray-900 {{ $message->isNew() ? 'font-bold' : '' }}">{{ $message->name }}</span>
                    @php
                        $colorMap = [
                            'nouveau' => 'bg-blue-100 text-blue-700',
                            'lu'      => 'bg-gray-100 text-gray-600',
                            'repondu' => 'bg-green-100 text-green-700',
                            'archive' => 'bg-yellow-100 text-yellow-700',
                        ];
                    @endphp
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $colorMap[$message->status] ?? 'bg-gray-100 text-gray-600' }}">
                        {{ $message->statusLabel() }}
                    </span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-primary-50 text-primary-700">
                        {{ $message->subject }}
                    </span>
                </div>
                <p class="text-sm text-gray-500 truncate">{{ $message->email }}{{ $message->phone ? ' &bull; ' . $message->phone : '' }}</p>
                <p class="text-sm text-gray-600 mt-1 line-clamp-1">{{ $message->message }}</p>
            </div>

            <!-- Date + Actions -->
            <div class="flex flex-col items-end gap-2 flex-shrink-0">
                <span class="text-xs text-gray-400 whitespace-nowrap">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                <div class="flex items-center gap-1">
                    <a href="{{ route('admin.contact-messages.show', $message) }}"
                       class="p-1.5 text-gray-500 hover:text-primary-600 hover:bg-gray-100 rounded-lg transition-colors"
                       title="Voir le message">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </a>
                    <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST" class="inline"
                          onsubmit="return confirm('Supprimer ce message ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="p-1.5 text-gray-500 hover:text-red-600 hover:bg-gray-100 rounded-lg transition-colors"
                                title="Supprimer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="p-16 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <p class="text-gray-500 font-medium">Aucun message trouve</p>
        </div>
        @endforelse
    </div>

    @if($messages->hasPages())
    <div class="mt-6">
        {{ $messages->links() }}
    </div>
    @endif
</x-app-layout>
