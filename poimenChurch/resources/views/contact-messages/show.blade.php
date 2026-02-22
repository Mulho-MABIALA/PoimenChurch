<x-app-layout>
    <x-slot name="title">Message de {{ $contactMessage->name }} - {{ config('app.name') }}</x-slot>

    @section('page-title', 'Detail du Message')

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <a href="{{ route('admin.contact-messages.index') }}"
               class="inline-flex items-center text-sm text-gray-500 hover:text-primary-600 transition-colors mb-2">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Retour aux messages
            </a>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Message de {{ $contactMessage->name }}</h2>
            <p class="text-gray-500 mt-1">Recu le {{ $contactMessage->created_at->format('d/m/Y a H:i') }}</p>
        </div>

        <!-- Status Selector -->
        <form action="{{ route('admin.contact-messages.update-status', $contactMessage) }}" method="POST" class="flex items-center gap-3">
            @csrf
            @method('PATCH')
            <select name="status"
                    class="px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors bg-white text-sm font-medium">
                <option value="nouveau"  {{ $contactMessage->status === 'nouveau'  ? 'selected' : '' }}>Nouveau</option>
                <option value="lu"       {{ $contactMessage->status === 'lu'       ? 'selected' : '' }}>Lu</option>
                <option value="repondu"  {{ $contactMessage->status === 'repondu'  ? 'selected' : '' }}>Repondu</option>
                <option value="archive"  {{ $contactMessage->status === 'archive'  ? 'selected' : '' }}>Archive</option>
            </select>
            <button type="submit"
                    class="px-4 py-2.5 bg-primary-600 text-white font-medium rounded-xl hover:bg-primary-700 transition-colors text-sm">
                Mettre a jour
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid lg:grid-cols-3 gap-6">

        <!-- Message Content -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Main Message -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Message</h3>
                    @php
                        $colorMap = [
                            'nouveau' => 'bg-blue-100 text-blue-700',
                            'lu'      => 'bg-gray-100 text-gray-600',
                            'repondu' => 'bg-green-100 text-green-700',
                            'archive' => 'bg-yellow-100 text-yellow-700',
                        ];
                    @endphp
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $colorMap[$contactMessage->status] ?? 'bg-gray-100 text-gray-600' }}">
                        {{ $contactMessage->statusLabel() }}
                    </span>
                </div>

                <div class="mb-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-50 text-primary-700">
                        {{ $contactMessage->subject }}
                    </span>
                </div>

                <div class="prose prose-gray max-w-none">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $contactMessage->message }}</p>
                </div>
            </div>

            <!-- Reply Helper -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Repondre par email</h3>
                <p class="text-sm text-gray-500 mb-4">Cliquez sur le bouton ci-dessous pour ouvrir votre client de messagerie et repondre directement a {{ $contactMessage->name }}.</p>
                <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ urlencode($contactMessage->subject) }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-600 text-white font-medium rounded-xl hover:bg-primary-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Repondre a {{ $contactMessage->email }}
                </a>
            </div>

            <!-- Admin Notes -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Notes internes</h3>
                <form action="{{ route('admin.contact-messages.update-notes', $contactMessage) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <textarea name="admin_notes" rows="4"
                              placeholder="Ajoutez des notes internes (non visibles par le client)..."
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors resize-none text-sm">{{ $contactMessage->admin_notes }}</textarea>
                    <div class="mt-3 flex justify-end">
                        <button type="submit"
                                class="px-5 py-2.5 bg-gray-700 text-white font-medium rounded-xl hover:bg-gray-800 transition-colors text-sm">
                            Enregistrer les notes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar: Contact Info -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations de contact</h3>

                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 bg-primary-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-0.5">Nom</p>
                            <p class="text-sm font-medium text-gray-900">{{ $contactMessage->name }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 bg-primary-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-0.5">Email</p>
                            <a href="mailto:{{ $contactMessage->email }}" class="text-sm font-medium text-primary-600 hover:underline break-all">{{ $contactMessage->email }}</a>
                        </div>
                    </div>

                    @if($contactMessage->phone)
                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 bg-primary-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-0.5">Telephone</p>
                            <a href="tel:{{ $contactMessage->phone }}" class="text-sm font-medium text-gray-900 hover:text-primary-600">{{ $contactMessage->phone }}</a>
                        </div>
                    </div>
                    @endif

                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 bg-primary-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-0.5">Sujet</p>
                            <p class="text-sm font-medium text-gray-900">{{ $contactMessage->subject }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-9 h-9 bg-primary-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-0.5">Date de reception</p>
                            <p class="text-sm font-medium text-gray-900">{{ $contactMessage->created_at->format('d/m/Y a H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="bg-white rounded-2xl border border-red-100 shadow-sm p-6">
                <h3 class="text-sm font-semibold text-red-700 mb-3">Zone de danger</h3>
                <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST"
                      onsubmit="return confirm('Supprimer definitivement ce message ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full px-4 py-2.5 border border-red-300 text-red-600 font-medium rounded-xl hover:bg-red-50 transition-colors text-sm">
                        Supprimer ce message
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
