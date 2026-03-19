<x-public-layout>
    <x-slot name="title">Predication - Poimen Church</x-slot>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-800 to-primary-900 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Breadcrumb -->
                <nav class="flex items-center gap-2 text-sm mb-8">
                    <a href="{{ route('home') }}" class="text-primary-200 hover:text-white">Accueil</a>
                    <svg class="w-4 h-4 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <a href="{{ route('sermons') }}" class="text-primary-200 hover:text-white">Predications</a>
                    <svg class="w-4 h-4 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-white">La Foi qui Deplace les Montagnes</span>
                </nav>

                <h1 class="text-3xl md:text-4xl font-bold mb-4">La Foi qui Deplace les Montagnes</h1>
                <div class="flex flex-wrap items-center gap-4 text-primary-100">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <span>Pasteur Jean-Paul Mukendi</span>
                    </div>
                    <span class="text-primary-300">•</span>
                    <span>26 Janvier 2026</span>
                    <span class="text-primary-300">•</span>
                    <span>52 minutes</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Audio Player -->
    <section class="py-8 bg-white border-b">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="bg-background rounded-2xl p-6">
                    <div class="flex items-center gap-6">
                        <!-- Play Button -->
                        <button class="w-16 h-16 bg-primary-700 text-white rounded-full flex items-center justify-center hover:bg-primary-800 transition-colors flex-shrink-0">
                            <svg class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </button>

                        <!-- Progress Bar -->
                        <div class="flex-1">
                            <div class="h-2 bg-gray-200 rounded-full mb-2">
                                <div class="h-2 bg-primary-700 rounded-full" style="width: 0%"></div>
                            </div>
                            <div class="flex justify-between text-sm text-gray-500">
                                <span>0:00</span>
                                <span>52:34</span>
                            </div>
                        </div>

                        <!-- Volume & Download -->
                        <div class="flex items-center gap-4">
                            <button class="text-gray-500 hover:text-primary-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/>
                                </svg>
                            </button>
                            <button class="text-gray-500 hover:text-primary-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sermon Content -->
    <section class="py-12 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="grid lg:grid-cols-3 gap-12">
                    <!-- Main Content -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-lg p-8">
                            <h2 class="text-2xl font-bold text-primary-800 mb-6">Resume</h2>

                            <div class="prose prose-lg max-w-none text-gray-600">
                                <p>
                                    Dans ce message puissant, le Pasteur Jean-Paul Mukendi nous enseigne sur
                                    la foi qui deplace les montagnes. A travers les Ecritures, nous decouvrons
                                    comment developper une foi inebranlabre qui surmonte tous les obstacles.
                                </p>

                                <h3 class="text-xl font-bold text-primary-800 mt-8 mb-4">Points cles</h3>

                                <ul class="space-y-2">
                                    <li>La foi commence par une parole de Dieu</li>
                                    <li>La foi se developpe par l'ecoute et la meditation de la Parole</li>
                                    <li>La foi se manifeste par les actions et les confessions</li>
                                    <li>La foi persevere malgre les apparences contraires</li>
                                </ul>

                                <h3 class="text-xl font-bold text-primary-800 mt-8 mb-4">Versets de reference</h3>

                                <div class="bg-background rounded-xl p-6 not-prose">
                                    <p class="text-gray-700 italic mb-2">
                                        "Or la foi est une ferme assurance des choses qu'on espere, une
                                        demonstration de celles qu'on ne voit pas."
                                    </p>
                                    <span class="text-sm text-gray-500">- Hebreux 11:1</span>
                                </div>

                                <div class="bg-background rounded-xl p-6 not-prose mt-4">
                                    <p class="text-gray-700 italic mb-2">
                                        "Je vous le dis en verite, si vous aviez de la foi comme un grain
                                        de moutarde, vous diriez a cette montagne: Transporte-toi d'ici la,
                                        et elle se transporterait."
                                    </p>
                                    <span class="text-sm text-gray-500">- Matthieu 17:20</span>
                                </div>
                            </div>

                            <!-- Share -->
                            <div class="mt-8 pt-8 border-t border-gray-100">
                                <h3 class="font-semibold text-gray-900 mb-4">Partager cette predication</h3>
                                <div class="flex gap-3">
                                    <button class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/>
                                        </svg>
                                    </button>
                                    <button class="w-10 h-10 bg-sky-500 text-white rounded-full flex items-center justify-center hover:bg-sky-600">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                        </svg>
                                    </button>
                                    <button class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                        </svg>
                                    </button>
                                    <button class="w-10 h-10 bg-gray-200 text-gray-600 rounded-full flex items-center justify-center hover:bg-gray-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-32">
                            <h3 class="font-bold text-primary-800 mb-4">Autres predications</h3>

                            <div class="space-y-4">
                                <a href="#" class="block p-3 rounded-xl hover:bg-background transition-colors">
                                    <h4 class="font-semibold text-gray-900 text-sm mb-1">Marcher dans la Victoire</h4>
                                    <p class="text-xs text-gray-500">Pasteur David Kabongo • 45 min</p>
                                </a>

                                <a href="#" class="block p-3 rounded-xl hover:bg-background transition-colors">
                                    <h4 class="font-semibold text-gray-900 text-sm mb-1">L'Amour Inconditionnel</h4>
                                    <p class="text-xs text-gray-500">Pasteur Jean-Paul Mukendi • 52 min</p>
                                </a>

                                <a href="#" class="block p-3 rounded-xl hover:bg-background transition-colors">
                                    <h4 class="font-semibold text-gray-900 text-sm mb-1">La Famille selon Dieu</h4>
                                    <p class="text-xs text-gray-500">Pasteur Jean-Paul Mukendi • 48 min</p>
                                </a>
                            </div>

                            <a href="{{ route('sermons') }}"
                                class="mt-6 w-full inline-flex items-center justify-center gap-2 text-primary-700 font-medium hover:text-primary-800">
                                Voir toutes les predications
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
