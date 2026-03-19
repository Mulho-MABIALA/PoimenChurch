<x-public-layout>
    <x-slot name="title">Vision & Mission - Poimen Church</x-slot>
    <x-slot name="metaDescription">Decouvrez la vision et la mission de Poimen Church. Notre appel a servir Dieu et notre communaute.</x-slot>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-800 to-primary-900 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Vision & Mission</h1>
                <p class="text-xl text-primary-100">Notre appel et notre engagement envers Dieu et l'humanite</p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-4 py-4">
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary-700">Accueil</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-primary-700 font-medium">Vision & Mission</span>
            </nav>
        </div>
    </div>

    <!-- Vision Section -->
    <section class="py-16 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-gold-100 text-gold-700 px-4 py-2 rounded-full text-sm font-semibold mb-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Notre Vision
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold text-primary-800 mb-6">
                            Une eglise qui transforme des vies
                        </h2>
                        <p class="text-lg text-gray-600 leading-relaxed mb-6">
                            Etre une communaute vibrante de croyants qui impactent positivement leur environnement
                            par la puissance de l'Evangile, formant des disciples de Jesus-Christ qui transforment
                            leur famille, leur lieu de travail et leur communaute.
                        </p>
                        <div class="bg-white rounded-xl p-6 border-l-4 border-gold-500">
                            <p class="text-gray-700 italic">
                                "Allez, faites de toutes les nations des disciples, les baptisant au nom du Pere,
                                du Fils et du Saint-Esprit."
                            </p>
                            <span class="text-sm text-gray-500 mt-2 block">- Matthieu 28:19</span>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl p-8 text-white">
                            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-center mb-4">Notre Appel</h3>
                            <ul class="space-y-3">
                                <li class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-gold-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Atteindre les perdus</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-gold-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Former des disciples</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-gold-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Equiper les leaders</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-gold-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Servir la communaute</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center gap-2 bg-primary-100 text-primary-700 px-4 py-2 rounded-full text-sm font-semibold mb-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Notre Mission
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold text-primary-800 mb-6">
                        Comment nous accomplissons notre vision
                    </h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Notre mission se decline en quatre piliers fondamentaux qui guident toutes nos actions
                        et nos programmes.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Pillar 1 -->
                    <div class="bg-gradient-to-br from-background to-white rounded-2xl p-8 shadow-lg">
                        <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6">
                            <span class="text-2xl font-bold text-primary-700">1</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary-800 mb-3">Adoration</h3>
                        <p class="text-gray-600">
                            Creer des espaces de louange authentique ou chaque croyant peut rencontrer Dieu
                            et vivre une transformation personnelle a travers l'adoration.
                        </p>
                    </div>

                    <!-- Pillar 2 -->
                    <div class="bg-gradient-to-br from-background to-white rounded-2xl p-8 shadow-lg">
                        <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6">
                            <span class="text-2xl font-bold text-primary-700">2</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary-800 mb-3">Communion</h3>
                        <p class="text-gray-600">
                            Batir des relations authentiques au sein de notre communaute a travers les groupes
                            de maison, les cellules et les ministeres.
                        </p>
                    </div>

                    <!-- Pillar 3 -->
                    <div class="bg-gradient-to-br from-background to-white rounded-2xl p-8 shadow-lg">
                        <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6">
                            <span class="text-2xl font-bold text-primary-700">3</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary-800 mb-3">Formation</h3>
                        <p class="text-gray-600">
                            Equiper chaque membre avec une solide connaissance biblique et des competences
                            pratiques pour vivre et partager leur foi.
                        </p>
                    </div>

                    <!-- Pillar 4 -->
                    <div class="bg-gradient-to-br from-background to-white rounded-2xl p-8 shadow-lg">
                        <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-6">
                            <span class="text-2xl font-bold text-primary-700">4</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary-800 mb-3">Service</h3>
                        <p class="text-gray-600">
                            Encourager et mobiliser chaque croyant a utiliser ses dons pour servir dans l'eglise
                            et dans la communaute environnante.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="py-16 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-primary-800 mb-4">Nos Valeurs</h2>
                    <p class="text-gray-600">Les principes qui guident notre vie communautaire.</p>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white rounded-xl p-6 text-center shadow-md hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-primary-800 mb-2">Integrite</h3>
                        <p class="text-sm text-gray-600">Vivre selon la verite de la Parole de Dieu.</p>
                    </div>

                    <div class="bg-white rounded-xl p-6 text-center shadow-md hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-primary-800 mb-2">Amour</h3>
                        <p class="text-sm text-gray-600">Aimer Dieu et aimer son prochain.</p>
                    </div>

                    <div class="bg-white rounded-xl p-6 text-center shadow-md hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-primary-800 mb-2">Excellence</h3>
                        <p class="text-sm text-gray-600">Donner le meilleur pour la gloire de Dieu.</p>
                    </div>

                    <div class="bg-white rounded-xl p-6 text-center shadow-md hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                            </svg>
                        </div>
                        <h3 class="font-bold text-primary-800 mb-2">Mission</h3>
                        <p class="text-sm text-gray-600">Aller dans le monde entier.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
