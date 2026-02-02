<x-public-layout>
    <x-slot name="title">Leadership - Poimen Church</x-slot>
    <x-slot name="metaDescription">Rencontrez l'equipe de leadership de Poimen Church. Des serviteurs devoues au service de Dieu et de la communaute.</x-slot>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-800 to-primary-900 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Notre Leadership</h1>
                <p class="text-xl text-primary-100">Des serviteurs devoues au service de Dieu et de la communaute</p>
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
                <span class="text-primary-700 font-medium">Leadership</span>
            </nav>
        </div>
    </div>

    <!-- Senior Pastor Section -->
    <section class="py-16 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="grid lg:grid-cols-2">
                        <div class="bg-gradient-to-br from-primary-700 to-primary-900 p-8 lg:p-12 flex items-center justify-center">
                            <div class="w-64 h-64 bg-white/10 rounded-full flex items-center justify-center">
                                <svg class="w-32 h-32 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="p-8 lg:p-12">
                            <span class="inline-block bg-gold-100 text-gold-700 px-4 py-1 rounded-full text-sm font-semibold mb-4">Pasteur Principal</span>
                            <h2 class="text-3xl font-bold text-primary-800 mb-2">Pasteur Jean-Paul Mukendi</h2>
                            <p class="text-gray-500 mb-6">Fondateur & Pasteur Principal</p>
                            <p class="text-gray-600 leading-relaxed mb-6">
                                Le Pasteur Jean-Paul Mukendi a fonde Poimen Church en 2005 avec une vision claire :
                                creer une communaute de foi ou chaque personne peut decouvrir l'amour de Dieu et
                                atteindre son plein potentiel en Christ.
                            </p>
                            <p class="text-gray-600 leading-relaxed mb-6">
                                Diplome en theologie et en leadership pastoral, il a consacre sa vie au ministere
                                et a la formation de leaders. Sous sa direction, l'eglise a connu une croissance
                                remarquable et touche aujourd'hui des milliers de vies.
                            </p>
                            <div class="flex gap-4">
                                <a href="#" class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-700 hover:bg-primary-200 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                    </svg>
                                </a>
                                <a href="#" class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-700 hover:bg-primary-200 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Leadership Team Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-primary-800 mb-4">Equipe Pastorale</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Des hommes et femmes de foi devoues au service de la communaute.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Pastor Card 1 -->
                <div class="bg-background rounded-2xl p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="w-32 h-32 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-16 h-16 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-1">Pasteur David Kabongo</h3>
                    <p class="text-gold-600 font-medium mb-3">Pasteur Associe</p>
                    <p class="text-gray-600 text-sm">
                        En charge de la formation des disciples et de l'enseignement biblique.
                    </p>
                </div>

                <!-- Pastor Card 2 -->
                <div class="bg-background rounded-2xl p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="w-32 h-32 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-16 h-16 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-1">Pasteur Samuel Lumumba</h3>
                    <p class="text-gold-600 font-medium mb-3">Pasteur de la Jeunesse</p>
                    <p class="text-gray-600 text-sm">
                        Responsable du ministere des jeunes et des jeunes adultes.
                    </p>
                </div>

                <!-- Pastor Card 3 -->
                <div class="bg-background rounded-2xl p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="w-32 h-32 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-16 h-16 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-1">Pasteur Emmanuel Tshisekedi</h3>
                    <p class="text-gold-600 font-medium mb-3">Pasteur des Cellules</p>
                    <p class="text-gray-600 text-sm">
                        Coordination des groupes de maison et des bacentas.
                    </p>
                </div>

                <!-- Pastor Card 4 -->
                <div class="bg-background rounded-2xl p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="w-32 h-32 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-16 h-16 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-1">Maman Marie Mukendi</h3>
                    <p class="text-gold-600 font-medium mb-3">Directrice du Ministere des Femmes</p>
                    <p class="text-gray-600 text-sm">
                        Encadrement spirituel et social des femmes de l'eglise.
                    </p>
                </div>

                <!-- Pastor Card 5 -->
                <div class="bg-background rounded-2xl p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="w-32 h-32 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-16 h-16 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-1">Frere Jean-Pierre Kasongo</h3>
                    <p class="text-gold-600 font-medium mb-3">Directeur de la Louange</p>
                    <p class="text-gray-600 text-sm">
                        Direction musicale et coordination de l'equipe de louange.
                    </p>
                </div>

                <!-- Pastor Card 6 -->
                <div class="bg-background rounded-2xl p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="w-32 h-32 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-16 h-16 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-1">Soeur Grace Ilunga</h3>
                    <p class="text-gold-600 font-medium mb-3">Directrice du Ministere des Enfants</p>
                    <p class="text-gray-600 text-sm">
                        Education spirituelle et activites pour les enfants.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-primary-700 to-primary-800 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Vous avez des questions?</h2>
            <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
                N'hesitez pas a contacter notre equipe pastorale. Nous sommes la pour vous accompagner.
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
