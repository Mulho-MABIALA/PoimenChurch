<x-public-layout>
    <x-slot name="title">Ministere de la Jeunesse - Poimen Church</x-slot>
    <x-slot name="metaDescription">Le ministere de la jeunesse de Poimen Church. Un espace pour les jeunes de grandir dans la foi.</x-slot>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-800 to-primary-900 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Ministere de la Jeunesse</h1>
                <p class="text-xl text-primary-100">Former la prochaine generation de leaders</p>
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
                <span class="text-primary-700 font-medium">Jeunesse</span>
            </nav>
        </div>
    </div>

    <!-- About Section -->
    <section class="py-16 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="order-2 lg:order-1 bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl p-8 text-white">
                        <h3 class="text-2xl font-bold mb-6">Nos Activites</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Reunions hebdomadaires chaque samedi</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Etudes bibliques adaptees aux jeunes</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Camps et retraites spirituelles</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Activites sportives et recreatives</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Formation au leadership</span>
                            </li>
                        </ul>
                    </div>
                    <div class="order-1 lg:order-2">
                        <h2 class="text-3xl font-bold text-primary-800 mb-6">Un espace pour grandir</h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Le ministere de la jeunesse de Poimen Church est un lieu ou les jeunes de 13 a 25 ans
                            peuvent decouvrir leur identite en Christ, developper leurs dons et batir des amities
                            solides basees sur la foi.
                        </p>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Nous croyons que les jeunes ne sont pas seulement l'avenir de l'Eglise, mais aussi
                            le present. C'est pourquoi nous les equipons pour etre des temoins actifs dans leurs
                            ecoles, universites et communautes.
                        </p>
                        <div class="bg-white rounded-xl p-6 border-l-4 border-gold-500">
                            <p class="text-gray-700 italic">
                                "Que personne ne meprise ta jeunesse; mais sois un modele pour les fideles."
                            </p>
                            <span class="text-sm text-gray-500 mt-2 block">- 1 Timothee 4:12</span>
                        </div>
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
                    Des programmes adaptes a chaque tranche d'age pour un accompagnement personnalise.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="bg-background rounded-2xl p-8 text-center hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-primary-700 text-white rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold">13-17</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-3">Adolescents</h3>
                    <p class="text-gray-600 mb-4">
                        Un programme dynamique pour les adolescents, avec des discussions sur les defis
                        de leur age et une base solide dans la foi.
                    </p>
                    <p class="text-sm text-gold-600 font-medium">Samedi 14h00 - 16h00</p>
                </div>

                <div class="bg-background rounded-2xl p-8 text-center hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-primary-700 text-white rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold">18-25</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-3">Jeunes Adultes</h3>
                    <p class="text-gray-600 mb-4">
                        Accompagnement pour les jeunes adultes dans leurs etudes, carrieres et relations,
                        avec une perspective biblique.
                    </p>
                    <p class="text-sm text-gold-600 font-medium">Samedi 16h30 - 18h30</p>
                </div>

                <div class="bg-background rounded-2xl p-8 text-center hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-gold-500 text-white rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-3">Leaders en Formation</h3>
                    <p class="text-gray-600 mb-4">
                        Programme de mentorat pour les jeunes qui desirent developper leur potentiel
                        de leadership dans l'Eglise.
                    </p>
                    <p class="text-sm text-gold-600 font-medium">Sur inscription</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Join CTA -->
    <section class="py-16 bg-gradient-to-r from-primary-700 to-primary-800 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Rejoins-nous!</h2>
            <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
                Tu as entre 13 et 25 ans? Viens decouvrir une communaute de jeunes passionnes par Jesus.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center justify-center gap-2 bg-gold-500 hover:bg-gold-600 text-primary-900 font-semibold py-4 px-8 rounded-full transition-colors duration-200">
                    Nous Contacter
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="{{ route('events') }}"
                    class="inline-flex items-center justify-center gap-2 bg-white/10 hover:bg-white/20 text-white font-semibold py-4 px-8 rounded-full transition-colors duration-200 border border-white/30">
                    Voir nos evenements
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
