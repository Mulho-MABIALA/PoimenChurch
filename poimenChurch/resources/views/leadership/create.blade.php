<x-app-layout>
    <x-slot name="title">Nouveau Membre - {{ config('app.name') }}</x-slot>

    @section('page-title', 'Leadership')

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.leadership.index') }}"
           class="inline-flex items-center text-gray-600 hover:text-primary-600 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Retour au leadership
        </a>
    </div>

    <div class="max-w-3xl">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sm:p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Ajouter un membre</h2>

            <form action="{{ route('admin.leadership.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Informations principales -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Informations principales</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom complet *</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 @error('name') border-red-500 @enderror"
                                   placeholder="Ex: Pasteur Jean-Paul Mukendi">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Titre / Rôle *</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 @error('title') border-red-500 @enderror"
                                   placeholder="Ex: Pasteur Principal, Pasteur de la Jeunesse...">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Biographie</label>
                            <textarea name="bio" id="bio" rows="4"
                                      class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20"
                                      placeholder="Présentation, parcours, ministère...">{{ old('bio') }}</textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Photo</label>
                            <input type="file" name="photo" id="photo" accept="image/*"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                            <p class="mt-1 text-sm text-gray-500">JPG, PNG. Max 2 Mo.</p>
                            @error('photo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Réseaux sociaux -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Réseaux sociaux</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="facebook_url" class="block text-sm font-medium text-gray-700 mb-1">Facebook</label>
                            <input type="url" name="facebook_url" id="facebook_url" value="{{ old('facebook_url') }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 @error('facebook_url') border-red-500 @enderror"
                                   placeholder="https://facebook.com/...">
                            @error('facebook_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="twitter_url" class="block text-sm font-medium text-gray-700 mb-1">Twitter / X</label>
                            <input type="url" name="twitter_url" id="twitter_url" value="{{ old('twitter_url') }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 @error('twitter_url') border-red-500 @enderror"
                                   placeholder="https://twitter.com/...">
                            @error('twitter_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Options -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Options d'affichage</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="display_order" class="block text-sm font-medium text-gray-700 mb-1">Ordre d'affichage</label>
                            <input type="number" name="display_order" id="display_order" value="{{ old('display_order', 0) }}"
                                   min="0"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20"
                                   placeholder="0">
                            <p class="mt-1 text-xs text-gray-500">0 = premier affiché</p>
                        </div>

                        <div class="flex flex-col gap-4 pt-1">
                            <div class="flex items-center">
                                <input type="checkbox" name="is_senior_pastor" id="is_senior_pastor" value="1"
                                       {{ old('is_senior_pastor') ? 'checked' : '' }}
                                       class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                <label for="is_senior_pastor" class="ml-2 text-sm font-medium text-gray-700">
                                    Pasteur Principal (grande carte)
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active" value="1"
                                       {{ old('is_active', true) ? 'checked' : '' }}
                                       class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">
                                    Actif (visible sur le site)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.leadership.index') }}"
                       class="px-6 py-2.5 text-gray-700 font-medium rounded-xl hover:bg-gray-100 transition-colors">
                        Annuler
                    </a>
                    <button type="submit"
                            class="px-6 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-sm">
                        Ajouter le membre
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
