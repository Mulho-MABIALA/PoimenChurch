<x-app-layout>
    <x-slot name="title">{{ $event->title }} - {{ config('app.name') }}</x-slot>

    @section('page-title', $event->title)

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.events.index') }}"
           class="inline-flex items-center text-gray-600 hover:text-primary-600 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Retour aux événements
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Event Header -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                @if($event->image)
                    <div class="h-64 w-full">
                        <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}"
                             class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="h-64 w-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
                        <svg class="w-24 h-24 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif

                <div class="p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-700">
                            {{ $event->type_label }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                            @if($event->status_color === 'green') bg-green-100 text-green-700
                            @elseif($event->status_color === 'blue') bg-blue-100 text-blue-700
                            @else bg-gray-100 text-gray-700 @endif">
                            {{ $event->status }}
                        </span>
                        @if($event->is_featured)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-700">
                                En vedette
                            </span>
                        @endif
                        @if(!$event->is_published)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-700">
                                Brouillon
                            </span>
                        @endif
                    </div>

                    <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $event->title }}</h1>

                    @if($event->description)
                        <p class="text-gray-600">{{ $event->description }}</p>
                    @endif
                </div>
            </div>

            <!-- Content -->
            @if($event->content)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Description détaillée</h2>
                <div class="prose prose-sm max-w-none text-gray-600">
                    {!! nl2br(e($event->content)) !!}
                </div>
            </div>
            @endif

            <!-- Actions -->
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.events.edit', $event) }}"
                   class="inline-flex items-center px-5 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Modifier
                </a>

                <form action="{{ route('admin.events.toggle-publish', $event) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                            class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors">
                        @if($event->is_published)
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                            </svg>
                            Dépublier
                        @else
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Publier
                        @endif
                    </button>
                </form>

                <a href="{{ route('events.show', $event->slug) }}" target="_blank"
                   class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Voir sur le site
                </a>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Date & Time -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Date et horaires</h3>

                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Date</p>
                            <p class="font-medium text-gray-900">{{ $event->formatted_date }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Horaires</p>
                            <p class="font-medium text-gray-900">{{ $event->formatted_time }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Location -->
            @if($event->location || $event->address || $event->city)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Lieu</h3>

                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        @if($event->location)
                            <p class="font-medium text-gray-900">{{ $event->location }}</p>
                        @endif
                        @if($event->address)
                            <p class="text-sm text-gray-600">{{ $event->address }}</p>
                        @endif
                        @if($event->city)
                            <p class="text-sm text-gray-500">{{ $event->city }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Registration -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Inscription</h3>

                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Inscription requise</span>
                        <span class="font-medium {{ $event->registration_required ? 'text-green-600' : 'text-gray-500' }}">
                            {{ $event->registration_required ? 'Oui' : 'Non' }}
                        </span>
                    </div>

                    @if($event->registration_fee)
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Frais</span>
                        <span class="font-medium text-gray-900">{{ number_format($event->registration_fee, 0, ',', ' ') }} FCFA</span>
                    </div>
                    @endif

                    @if($event->max_participants)
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Places</span>
                        <span class="font-medium text-gray-900">{{ $event->max_participants }} max</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Metadata -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations</h3>

                <div class="space-y-3 text-sm">
                    @if($event->branch)
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Branche</span>
                        <span class="font-medium text-gray-900">{{ $event->branch->name }}</span>
                    </div>
                    @endif

                    @if($event->creator)
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Créé par</span>
                        <span class="font-medium text-gray-900">{{ $event->creator->full_name }}</span>
                    </div>
                    @endif

                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Créé le</span>
                        <span class="font-medium text-gray-900">{{ $event->created_at->format('d/m/Y H:i') }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Modifié le</span>
                        <span class="font-medium text-gray-900">{{ $event->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
