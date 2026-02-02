<x-app-layout>
    <x-slot name="title">Modifier l'Événement - {{ config('app.name') }}</x-slot>

    @section('page-title', 'Modifier l\'Événement')

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

    <div class="max-w-4xl">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sm:p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Modifier l'événement : {{ $event->title }}</h2>

            <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Informations de base -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Informations de base</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Titre *</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $event->title) }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 @error('title') border-red-500 @enderror"
                                   placeholder="Ex: Conférence Annuelle de la Foi">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type *</label>
                            <select name="type" id="type"
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 bg-white @error('type') border-red-500 @enderror">
                                <option value="">Sélectionner un type</option>
                                @foreach($types as $key => $label)
                                    <option value="{{ $key }}" {{ old('type', $event->type) === $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="branch_id" class="block text-sm font-medium text-gray-700 mb-1">Branche</label>
                            <select name="branch_id" id="branch_id"
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 bg-white">
                                <option value="">Toutes les branches</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" {{ old('branch_id', $event->branch_id) == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description courte</label>
                            <textarea name="description" id="description" rows="2"
                                      class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 @error('description') border-red-500 @enderror"
                                      placeholder="Une brève description de l'événement...">{{ old('description', $event->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Contenu détaillé</label>
                            <textarea name="content" id="content" rows="5"
                                      class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20"
                                      placeholder="Description complète, programme, informations pratiques...">{{ old('content', $event->content) }}</textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                            @if($event->image)
                                <div class="mb-3 flex items-center gap-4">
                                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}"
                                         class="w-24 h-24 object-cover rounded-xl ring-2 ring-gray-100">
                                    <p class="text-sm text-gray-500">Image actuelle</p>
                                </div>
                            @endif
                            <input type="file" name="image" id="image" accept="image/*"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                            <p class="mt-1 text-sm text-gray-500">JPG, PNG ou GIF. Max 2 Mo. Laissez vide pour conserver l'image actuelle.</p>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Date et Horaires -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Date et Horaires</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Date et heure de début *</label>
                            <input type="datetime-local" name="start_date" id="start_date"
                                   value="{{ old('start_date', $event->start_date?->format('Y-m-d\TH:i')) }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 @error('start_date') border-red-500 @enderror">
                            @error('start_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Date et heure de fin</label>
                            <input type="datetime-local" name="end_date" id="end_date"
                                   value="{{ old('end_date', $event->end_date?->format('Y-m-d\TH:i')) }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 @error('end_date') border-red-500 @enderror">
                            @error('end_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Localisation -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Localisation</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Nom du lieu</label>
                            <input type="text" name="location" id="location" value="{{ old('location', $event->location) }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20"
                                   placeholder="Ex: Sanctuaire Principal">
                        </div>

                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Ville</label>
                            <input type="text" name="city" id="city" value="{{ old('city', $event->city) }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20"
                                   placeholder="Ex: Douala">
                        </div>

                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Adresse complète</label>
                            <textarea name="address" id="address" rows="2"
                                      class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20"
                                      placeholder="Adresse détaillée...">{{ old('address', $event->address) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Inscription -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Inscription</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="registration_required" id="registration_required" value="1"
                                   {{ old('registration_required', $event->registration_required) ? 'checked' : '' }}
                                   class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <label for="registration_required" class="ml-2 text-sm font-medium text-gray-700">
                                Inscription requise
                            </label>
                        </div>

                        <div>
                            <label for="registration_fee" class="block text-sm font-medium text-gray-700 mb-1">Frais d'inscription (FCFA)</label>
                            <input type="number" name="registration_fee" id="registration_fee"
                                   value="{{ old('registration_fee', $event->registration_fee) }}"
                                   min="0" step="100"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20"
                                   placeholder="0">
                        </div>

                        <div>
                            <label for="max_participants" class="block text-sm font-medium text-gray-700 mb-1">Nombre max. de participants</label>
                            <input type="number" name="max_participants" id="max_participants"
                                   value="{{ old('max_participants', $event->max_participants) }}"
                                   min="1"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20"
                                   placeholder="Illimité">
                        </div>
                    </div>
                </div>

                <!-- Options de publication -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Options de publication</h3>

                    <div class="flex flex-wrap gap-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_published" id="is_published" value="1"
                                   {{ old('is_published', $event->is_published) ? 'checked' : '' }}
                                   class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <label for="is_published" class="ml-2 text-sm font-medium text-gray-700">
                                Publié
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                   {{ old('is_featured', $event->is_featured) ? 'checked' : '' }}
                                   class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <label for="is_featured" class="ml-2 text-sm font-medium text-gray-700">
                                Mettre en avant (featured)
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.events.index') }}"
                       class="px-6 py-2.5 text-gray-700 font-medium rounded-xl hover:bg-gray-100 transition-colors">
                        Annuler
                    </a>
                    <button type="submit"
                            class="px-6 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-sm">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
