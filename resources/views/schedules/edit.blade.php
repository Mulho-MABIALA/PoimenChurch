<x-app-layout>
    <x-slot name="title">Modifier l'Horaire - {{ config('app.name') }}</x-slot>

    @section('page-title', 'Modifier l\'Horaire')

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.schedules.index') }}"
           class="inline-flex items-center text-gray-600 hover:text-primary-600 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Retour aux horaires
        </a>
    </div>

    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sm:p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Modifier : {{ $schedule->title }}</h2>

            <form action="{{ route('admin.schedules.update', $schedule) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Titre *</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $schedule->title) }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 @error('title') border-red-500 @enderror"
                               placeholder="Ex: Culte du Dimanche">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <input type="text" name="description" id="description" value="{{ old('description', $schedule->description) }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20"
                               placeholder="Ex: Notre célébration principale de la semaine">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="day_of_week" class="block text-sm font-medium text-gray-700 mb-1">Jour *</label>
                            <select name="day_of_week" id="day_of_week"
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 bg-white @error('day_of_week') border-red-500 @enderror">
                                <option value="">Sélectionner un jour</option>
                                @foreach($days as $key => $label)
                                    <option value="{{ $key }}" {{ old('day_of_week', $schedule->day_of_week) === $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('day_of_week')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lieu</label>
                            <input type="text" name="location" id="location" value="{{ old('location', $schedule->location) }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20"
                                   placeholder="Ex: Sanctuaire Principal">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Heure de début *</label>
                            <input type="time" name="start_time" id="start_time"
                                   value="{{ old('start_time', is_string($schedule->start_time) ? $schedule->start_time : (is_object($schedule->start_time) ? $schedule->start_time->format('H:i') : substr($schedule->start_time, 0, 5))) }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 @error('start_time') border-red-500 @enderror">
                            @error('start_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">Heure de fin</label>
                            <input type="time" name="end_time" id="end_time"
                                   value="{{ old('end_time', $schedule->end_time ? (is_string($schedule->end_time) ? $schedule->end_time : (is_object($schedule->end_time) ? $schedule->end_time->format('H:i') : substr($schedule->end_time, 0, 5))) : '') }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">Icône</label>
                            <select name="icon" id="icon"
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 bg-white">
                                <option value="">Aucune icône</option>
                                @foreach($icons as $key => $label)
                                    <option value="{{ $key }}" {{ old('icon', $schedule->icon) === $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="icon_color" class="block text-sm font-medium text-gray-700 mb-1">Couleur</label>
                            <select name="icon_color" id="icon_color"
                                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 bg-white">
                                @foreach($colors as $key => $label)
                                    <option value="{{ $key }}" {{ old('icon_color', $schedule->icon_color) === $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Ordre d'affichage</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $schedule->order) }}" min="0"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20"
                               placeholder="0">
                        <p class="mt-1 text-sm text-gray-500">Plus le nombre est petit, plus l'horaire apparaîtra en premier.</p>
                    </div>

                    <div class="flex flex-wrap gap-6 pt-2">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                   {{ old('is_featured', $schedule->is_featured) ? 'checked' : '' }}
                                   class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <label for="is_featured" class="ml-2 text-sm font-medium text-gray-700">
                                Afficher sur la page d'accueil
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1"
                                   {{ old('is_active', $schedule->is_active) ? 'checked' : '' }}
                                   class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">
                                Actif
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-4 pt-6 mt-6 border-t border-gray-200">
                    <a href="{{ route('admin.schedules.index') }}"
                       class="px-6 py-2.5 text-gray-700 font-medium rounded-xl hover:bg-gray-100 transition-colors">
                        Annuler
                    </a>
                    <button type="submit"
                            class="px-6 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-sm">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
