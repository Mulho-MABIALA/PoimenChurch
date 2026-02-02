<x-public-layout>
    <x-slot name="title">Ministere des Femmes - Poimen Church</x-slot>
    <x-slot name="metaDescription">Le ministere des femmes de Poimen Church. Un espace d'epanouissement et de soutien pour les femmes.</x-slot>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-800 to-primary-900 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Ministere des Femmes</h1>
                <p class="text-xl text-primary-100">Femmes de valeur, femmes de foi</p>
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
                <span class="text-gray-500">Ministeres</span>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-primary-700 font-medium">Femmes</span>
            </nav>
        </div>
    </div>

    <!-- About Section -->
    <section class="py-16 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-primary-800 mb-6">Ensemble, plus fortes</h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Le ministere des femmes de Poimen Church est un lieu d'accueil, de soutien et
                            de croissance pour toutes les femmes. Que vous soyez jeune femme, epouse, mere
                            ou grand-mere, vous trouverez ici une communaute aimante.
                        </p>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Nous croyons que chaque femme a une valeur inestimable aux yeux de Dieu et
                            un role unique a jouer dans Son plan. Notre mission est d'accompagner chaque
                            femme dans sa marche avec Christ.
                        </p>
                        <div class="bg-white rounded-xl p-6 border-l-4 border-gold-500">
                            <p class="text-gray-700 italic">
                                "Elle est revetue de force et de gloire, et elle se rit de l'avenir."
                            </p>
                            <span class="text-sm text-gray-500 mt-2 block">- Proverbes 31:25</span>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl p-8 text-white">
                        <h3 class="text-2xl font-bold mb-6">Nos activites</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Reunions de priere et louange</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Etudes bibliques thematiques</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Conferences et retraites annuelles</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Programmes de mentorat</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Actions sociales et caritatives</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-primary-800 mb-4">Nos Programmes</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Des programmes concus pour repondre aux besoins specifiques de chaque femme.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <div class="bg-background rounded-2xl p-8 hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-pink-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-3">Etude Biblique</h3>
                    <p class="text-gray-600 mb-4">
                        Chaque semaine, nous nous reunissons pour etudier la Parole de Dieu et
                        grandir ensemble dans la foi.
                    </p>
                    <p class="text-sm text-gold-600 font-medium">Mercredi 10h00</p>
                </div>

                <div class="bg-background rounded-2xl p-8 hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-3">Cercle de Soutien</h3>
                    <p class="text-gray-600 mb-4">
                        Un espace confidentiel pour partager, prier et s'encourager mutuellement
                        dans les defis de la vie.
                    </p>
                    <p class="text-sm text-gold-600 font-medium">1er samedi du mois</p>
                </div>

                <div class="bg-background rounded-2xl p-8 hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-3">Femmes & Carrieres</h3>
                    <p class="text-gray-600 mb-4">
                        Accompagnement pour les femmes professionnelles, entreprenariat et
                        equilibre vie personnelle/professionnelle.
                    </p>
                    <p class="text-sm text-gold-600 font-medium">Trimestriel</p>
                </div>

                <div class="bg-background rounded-2xl p-8 hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-3">Preparation au Mariage</h3>
                    <p class="text-gray-600 mb-4">
                        Sessions de preparation pour les futures epouses, abordant les aspects
                        spirituels et pratiques du mariage.
                    </p>
                    <p class="text-sm text-gold-600 font-medium">Sur inscription</p>
                </div>

                <div class="bg-background rounded-2xl p-8 hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-3">Mamans en Action</h3>
                    <p class="text-gray-600 mb-4">
                        Soutien et ressources pour les meres, partage d'experiences et conseils
                        pratiques pour l'education des enfants.
                    </p>
                    <p class="text-sm text-gold-600 font-medium">2eme samedi du mois</p>
                </div>

                <div class="bg-background rounded-2xl p-8 hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-yellow-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-3">Retraite Annuelle</h3>
                    <p class="text-gray-600 mb-4">
                        Un temps fort de ressourcement spirituel, loin des soucis quotidiens,
                        pour se rapprocher de Dieu.
                    </p>
                    <p class="text-sm text-gold-600 font-medium">Annuel</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Join CTA -->
    <section class="py-16 bg-gradient-to-r from-primary-700 to-primary-800 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Rejoignez-nous</h2>
            <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
                Vous etes la bienvenue parmi nous. Venez decouvrir une communaute de femmes qui s'encouragent et grandissent ensemble.
            </p>
            <a href="{{ route('contact') }}"
                class="inline-flex items-center gap-2 bg-gold-500 hover:bg-gold-600 text-primary-900 font-semibold py-4 px-8 rounded-full transition-colors duration-200">
                Nous Contacter
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </section>
</x-public-layout>
