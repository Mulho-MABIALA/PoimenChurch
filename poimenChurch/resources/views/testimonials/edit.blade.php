<x-app-layout>
    <x-slot name="title">Modifier le Temoignage - {{ config('app.name') }}</x-slot>

    @section('page-title', 'Modifier le Temoignage')

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admin.testimonials.index') }}"
           class="inline-flex items-center text-gray-600 hover:text-primary-600 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Retour aux temoignages
        </a>
    </div>

    <div class="max-w-2xl">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sm:p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Modifier le temoignage</h2>

            <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <!-- Author Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="author_name" class="block text-sm font-medium text-gray-700 mb-1">Nom de l'auteur *</label>
                            <input type="text" name="author_name" id="author_name" value="{{ old('author_name', $testimonial->author_name) }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 @error('author_name') border-red-500 @enderror"
                                   placeholder="Ex: Jean Kouassi">
                            @error('author_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="author_role" class="block text-sm font-medium text-gray-700 mb-1">Role / Statut</label>
                            <input type="text" name="author_role" id="author_role" value="{{ old('author_role', $testimonial->author_role) }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20"
                                   placeholder="Ex: Membre depuis 2020">
                        </div>
                    </div>

                    <!-- Photo Upload -->
                    <div>
                        <label for="author_photo" class="block text-sm font-medium text-gray-700 mb-1">Photo de l'auteur</label>
                        <div class="flex items-center gap-4">
                            <div id="photo-preview" class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center overflow-hidden">
                                <img src="{{ $testimonial->photo_url }}" alt="{{ $testimonial->author_name }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <input type="file" name="author_photo" id="author_photo" accept="image/*"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100"
                                       onchange="previewPhoto(this)">
                                <p class="mt-1 text-sm text-gray-500">JPEG, PNG ou WebP. Max 2Mo. Laissez vide pour conserver l'image actuelle.</p>
                            </div>
                        </div>
                        @error('author_photo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Temoignage *</label>
                        <textarea name="content" id="content" rows="5"
                                  class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 resize-none @error('content') border-red-500 @enderror"
                                  placeholder="Partagez le temoignage...">{{ old('content', $testimonial->content) }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">Maximum 1000 caracteres.</p>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rating and Date -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Note *</label>
                            <div class="flex items-center gap-2" x-data="{ rating: {{ old('rating', $testimonial->rating) }} }">
                                @for($i = 1; $i <= 5; $i++)
                                <button type="button" @click="rating = {{ $i }}"
                                        class="focus:outline-none transition-transform hover:scale-110">
                                    <svg class="w-8 h-8" :class="rating >= {{ $i }} ? 'text-gold-400' : 'text-gray-200'" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </button>
                                @endfor
                                <input type="hidden" name="rating" :value="rating">
                            </div>
                            @error('rating')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="testimonial_date" class="block text-sm font-medium text-gray-700 mb-1">Date du temoignage</label>
                            <input type="date" name="testimonial_date" id="testimonial_date" value="{{ old('testimonial_date', $testimonial->testimonial_date?->format('Y-m-d')) }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20">
                        </div>
                    </div>

                    <!-- Display Order -->
                    <div>
                        <label for="display_order" class="block text-sm font-medium text-gray-700 mb-1">Ordre d'affichage</label>
                        <input type="number" name="display_order" id="display_order" value="{{ old('display_order', $testimonial->display_order) }}" min="0"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20"
                               placeholder="0">
                        <p class="mt-1 text-sm text-gray-500">Plus le nombre est petit, plus le temoignage apparaitra en premier.</p>
                    </div>

                    <!-- Checkboxes -->
                    <div class="flex flex-wrap gap-6 pt-2">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                   {{ old('is_featured', $testimonial->is_featured) ? 'checked' : '' }}
                                   class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <label for="is_featured" class="ml-2 text-sm font-medium text-gray-700">
                                Mettre en vedette
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1"
                                   {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}
                                   class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">
                                Actif
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-4 pt-6 mt-6 border-t border-gray-200">
                    <a href="{{ route('admin.testimonials.index') }}"
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

    @push('scripts')
    <script>
        function previewPhoto(input) {
            const preview = document.getElementById('photo-preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @endpush
</x-app-layout>
