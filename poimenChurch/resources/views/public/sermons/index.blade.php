<x-public-layout>
    <x-slot name="title">Predications - Poimen Church</x-slot>
    <x-slot name="metaDescription">Ecoutez les predications de Poimen Church. Messages inspirants pour nourrir votre foi.</x-slot>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-800 to-primary-900 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Predications</h1>
                <p class="text-xl text-primary-100">Des messages pour nourrir votre foi</p>
            </div>
        </div>
    </section>

    <!-- Search & Filters -->
    <section class="py-8 bg-white border-b">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="relative w-full md:w-96">
                    <input type="text" placeholder="Rechercher une predication..."
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>

                <div class="flex gap-2 flex-wrap">
                    <select class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 focus:ring-2 focus:ring-primary-500">
                        <option>Toutes les series</option>
                        <option>La Foi qui Deplace</option>
                        <option>Famille selon Dieu</option>
                        <option>Vivre Victorieux</option>
                    </select>
                    <select class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 focus:ring-2 focus:ring-primary-500">
                        <option>Tous les orateurs</option>
                        <option>Pasteur Jean-Paul Mukendi</option>
                        <option>Pasteur David Kabongo</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Sermon -->
    <section class="py-12 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-2xl font-bold text-primary-800 mb-6">Derniere predication</h2>

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="grid lg:grid-cols-2">
                        <div class="bg-gradient-to-br from-primary-600 to-primary-800 p-8 lg:p-12 flex items-center justify-center min-h-[300px]">
                            <div class="text-center text-white">
                                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                                <p class="text-sm text-white/70">Cliquez pour ecouter</p>
                            </div>
                        </div>
                        <div class="p-8 lg:p-12">
                            <span class="inline-block bg-gold-100 text-gold-700 px-3 py-1 rounded-full text-sm font-medium mb-4">
                                Nouvelle predication
                            </span>
                            <h3 class="text-2xl font-bold text-primary-800 mb-2">La Foi qui Deplace les Montagnes</h3>
                            <p class="text-gray-500 mb-4">Pasteur Jean-Paul Mukendi • 26 Janvier 2026</p>
                            <p class="text-gray-600 mb-6">
                                Decouvrez comment developper une foi inebranlabre qui surmonte tous les obstacles
                                et vous conduit a la victoire en Christ.
                            </p>
                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('sermons.show', 'foi-deplace-montagnes') }}"
                                    class="inline-flex items-center gap-2 bg-primary-700 hover:bg-primary-800 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                    Ecouter
                                </a>
                                <button class="inline-flex items-center gap-2 border border-gray-300 text-gray-600 font-semibold py-3 px-6 rounded-lg hover:bg-gray-50 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    Telecharger
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- All Sermons -->
    <section class="py-12 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-2xl font-bold text-primary-800 mb-6">Toutes les predications</h2>

                <div class="space-y-4">
                    <!-- Sermon Item 1 -->
                    <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="flex flex-col md:flex-row">
                            <div class="w-full md:w-48 h-32 md:h-auto bg-gradient-to-br from-primary-600 to-primary-800 flex items-center justify-center flex-shrink-0">
                                <svg class="w-12 h-12 text-white/50" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                            <div class="flex-1 p-6">
                                <div class="flex flex-col md:flex-row md:items-center gap-4">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-primary-800 mb-1">Marcher dans la Victoire</h3>
                                        <p class="text-sm text-gray-500">Pasteur David Kabongo • 19 Janvier 2026</p>
                                        <p class="text-gray-600 mt-2 text-sm">
                                            Comment vivre une vie victorieuse dans tous les domaines grace a la puissance de Dieu.
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-400">45 min</span>
                                        <a href="{{ route('sermons.show', 'marcher-victoire') }}"
                                            class="w-10 h-10 bg-primary-700 text-white rounded-full flex items-center justify-center hover:bg-primary-800 transition-colors">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Sermon Item 2 -->
                    <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="flex flex-col md:flex-row">
                            <div class="w-full md:w-48 h-32 md:h-auto bg-gradient-to-br from-gold-500 to-gold-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-12 h-12 text-white/50" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                            <div class="flex-1 p-6">
                                <div class="flex flex-col md:flex-row md:items-center gap-4">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-primary-800 mb-1">L'Amour Inconditionnel</h3>
                                        <p class="text-sm text-gray-500">Pasteur Jean-Paul Mukendi • 12 Janvier 2026</p>
                                        <p class="text-gray-600 mt-2 text-sm">
                                            Decouvrez la profondeur de l'amour de Dieu et comment le partager avec les autres.
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-400">52 min</span>
                                        <a href="{{ route('sermons.show', 'amour-inconditionnel') }}"
                                            class="w-10 h-10 bg-primary-700 text-white rounded-full flex items-center justify-center hover:bg-primary-800 transition-colors">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Sermon Item 3 -->
                    <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="flex flex-col md:flex-row">
                            <div class="w-full md:w-48 h-32 md:h-auto bg-gradient-to-br from-purple-600 to-purple-800 flex items-center justify-center flex-shrink-0">
                                <svg class="w-12 h-12 text-white/50" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                            <div class="flex-1 p-6">
                                <div class="flex flex-col md:flex-row md:items-center gap-4">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-primary-800 mb-1">La Famille selon Dieu</h3>
                                        <p class="text-sm text-gray-500">Pasteur Jean-Paul Mukendi • 05 Janvier 2026</p>
                                        <p class="text-gray-600 mt-2 text-sm">
                                            Les principes bibliques pour batir une famille solide et epanouie.
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-400">48 min</span>
                                        <a href="{{ route('sermons.show', 'famille-selon-dieu') }}"
                                            class="w-10 h-10 bg-primary-700 text-white rounded-full flex items-center justify-center hover:bg-primary-800 transition-colors">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Sermon Item 4 -->
                    <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="flex flex-col md:flex-row">
                            <div class="w-full md:w-48 h-32 md:h-auto bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center flex-shrink-0">
                                <svg class="w-12 h-12 text-white/50" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                            <div class="flex-1 p-6">
                                <div class="flex flex-col md:flex-row md:items-center gap-4">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-primary-800 mb-1">Nouvelle Annee, Nouvelle Vision</h3>
                                        <p class="text-sm text-gray-500">Pasteur Jean-Paul Mukendi • 01 Janvier 2026</p>
                                        <p class="text-gray-600 mt-2 text-sm">
                                            Message special du nouvel an pour une annee benie et victorieuse.
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm text-gray-400">55 min</span>
                                        <a href="{{ route('sermons.show', 'nouvelle-annee-vision') }}"
                                            class="w-10 h-10 bg-primary-700 text-white rounded-full flex items-center justify-center hover:bg-primary-800 transition-colors">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    <nav class="flex items-center gap-2">
                        <button class="w-10 h-10 border border-gray-300 rounded-lg flex items-center justify-center text-gray-500 hover:bg-gray-50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <button class="w-10 h-10 bg-primary-700 text-white rounded-lg font-medium">1</button>
                        <button class="w-10 h-10 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 font-medium">2</button>
                        <button class="w-10 h-10 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 font-medium">3</button>
                        <button class="w-10 h-10 border border-gray-300 rounded-lg flex items-center justify-center text-gray-500 hover:bg-gray-50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
