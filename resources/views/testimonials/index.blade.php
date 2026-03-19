<x-app-layout>
    <x-slot name="title">Gestion des Temoignages - {{ config('app.name') }}</x-slot>

    @section('page-title', 'Temoignages')

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Temoignages</h2>
            <p class="text-gray-500 mt-1">
                <span class="font-semibold text-primary-600">{{ $testimonials->total() }}</span> temoignage(s)
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.testimonials.create') }}"
               class="inline-flex items-center justify-center px-4 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition-colors shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nouveau Temoignage
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sm:p-5 mb-6">
        <form method="GET" action="{{ route('admin.testimonials.index') }}" class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4">
            <div class="flex-1 min-w-[200px]">
                <label for="search" class="sr-only">Rechercher</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                           placeholder="Rechercher par nom ou contenu..."
                           class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors">
                </div>
            </div>
            <div class="w-full sm:w-48">
                <label for="featured" class="sr-only">Mis en avant</label>
                <select name="featured" id="featured"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-colors bg-white">
                    <option value="">Tous</option>
                    <option value="1" {{ request('featured') === '1' ? 'selected' : '' }}>Mis en avant</option>
                    <option value="0" {{ request('featured') === '0' ? 'selected' : '' }}>Non mis en avant</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit"
                        class="flex-1 sm:flex-none px-5 py-2.5 bg-primary-600 text-white font-medium rounded-xl hover:bg-primary-700 transition-colors">
                    Filtrer
                </button>
                @if(request()->hasAny(['search', 'featured', 'active']))
                <a href="{{ route('admin.testimonials.index') }}"
                   class="px-3 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Testimonials Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($testimonials as $testimonial)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow">
            <!-- Card Header -->
            <div class="p-5 border-b border-gray-100">
                <div class="flex items-center gap-4">
                    <img src="{{ $testimonial->photo_url }}" alt="{{ $testimonial->author_name }}"
                         class="w-14 h-14 rounded-xl object-cover border-2 border-gray-100">
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 truncate">{{ $testimonial->author_name }}</h3>
                        @if($testimonial->author_role)
                        <p class="text-sm text-gray-500 truncate">{{ $testimonial->author_role }}</p>
                        @endif
                    </div>
                    <!-- Status Badges -->
                    <div class="flex flex-col gap-1">
                        @if($testimonial->is_featured)
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gold-100 text-gold-700">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            Vedette
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-5">
                <!-- Rating -->
                <div class="flex items-center gap-1 mb-3">
                    @for($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 {{ $i <= $testimonial->rating ? 'text-gold-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    @endfor
                </div>

                <!-- Content -->
                <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                    "{{ $testimonial->content }}"
                </p>

                @if($testimonial->testimonial_date)
                <p class="text-xs text-gray-400 mt-3">
                    {{ $testimonial->testimonial_date->format('d/m/Y') }}
                </p>
                @endif
            </div>

            <!-- Card Footer -->
            <div class="px-5 py-4 bg-gray-50/50 border-t border-gray-100 flex items-center justify-between">
                <!-- Toggle Active -->
                <form action="{{ route('admin.testimonials.toggle-active', $testimonial) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 {{ $testimonial->is_active ? 'bg-primary-600' : 'bg-gray-200' }}"
                            title="{{ $testimonial->is_active ? 'Desactiver' : 'Activer' }}">
                        <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $testimonial->is_active ? 'translate-x-5' : 'translate-x-0' }}"></span>
                    </button>
                </form>

                <!-- Actions -->
                <div class="flex items-center gap-1">
                    <form action="{{ route('admin.testimonials.toggle-featured', $testimonial) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                                class="p-2 {{ $testimonial->is_featured ? 'text-gold-500' : 'text-gray-400' }} hover:text-gold-600 hover:bg-gray-100 rounded-lg transition-colors"
                                title="{{ $testimonial->is_featured ? 'Retirer de la vedette' : 'Mettre en vedette' }}">
                            <svg class="w-5 h-5" fill="{{ $testimonial->is_featured ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                            </svg>
                        </button>
                    </form>

                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                       class="p-2 text-gray-500 hover:text-blue-600 hover:bg-gray-100 rounded-lg transition-colors"
                       title="Modifier">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </a>

                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="inline"
                          onsubmit="return confirm('Etes-vous sur de vouloir supprimer ce temoignage ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="p-2 text-gray-500 hover:text-red-600 hover:bg-gray-100 rounded-lg transition-colors"
                                title="Supprimer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-16 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <p class="text-gray-500 font-medium">Aucun temoignage trouve</p>
                <a href="{{ route('admin.testimonials.create') }}" class="mt-4 inline-flex items-center text-primary-600 hover:text-primary-700 font-medium text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Creer un temoignage
                </a>
            </div>
        </div>
        @endforelse
    </div>

    @if($testimonials->hasPages())
    <div class="mt-6">
        {{ $testimonials->links() }}
    </div>
    @endif
</x-app-layout>
