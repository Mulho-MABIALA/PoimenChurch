<x-public-layout>
    <x-slot name="title">Ministere des Enfants - Poimen Church</x-slot>
    <x-slot name="metaDescription">Le ministere des enfants de Poimen Church. Un environnement sur et amusant pour grandir dans la foi.</x-slot>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-800 to-primary-900 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Ministere des Enfants</h1>
                <p class="text-xl text-primary-100">Poimen Kids - Grandir dans la foi en s'amusant</p>
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
                <span class="text-primary-700 font-medium">Enfants</span>
            </nav>
        </div>
    </div>

    <!-- About Section -->
    <section class="py-16 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-primary-800 mb-6">Un lieu special pour vos enfants</h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Poimen Kids offre un environnement sur, amusant et adapte a l'age de chaque enfant
                            pour decouvrir l'amour de Jesus. Pendant que les parents participent au culte,
                            les enfants vivent leur propre experience d'adoration.
                        </p>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Notre equipe de moniteurs devoues utilise des methodes creatives comme les histoires,
                            les jeux, les chants et les activites manuelles pour enseigner les verites bibliques
                            de maniere memorable.
                        </p>
                        <div class="bg-white rounded-xl p-6 border-l-4 border-gold-500">
                            <p class="text-gray-700 italic">
                                "Laissez les petits enfants, et ne les empechez pas de venir a moi; car le royaume
                                des cieux est pour ceux qui leur ressemblent."
                            </p>
                            <span class="text-sm text-gray-500 mt-2 block">- Matthieu 19:14</span>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl p-8 text-white">
                        <h3 class="text-2xl font-bold mb-6">Notre engagement</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Securite et bien-etre des enfants</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Enseignement biblique adapte</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Moniteurs formes et passionnes</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Activites ludiques et educatives</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Age Groups Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-primary-800 mb-4">Nos Groupes d'Age</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Chaque groupe beneficie d'un programme adapte a son niveau de developpement.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="bg-background rounded-2xl p-8 text-center hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold">0-3</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-3">Petits Agneaux</h3>
                    <p class="text-gray-600 mb-4">
                        Nurserie securisee pour les bebes et tout-petits avec des monitrices
                        attentionnees et un environnement adapte.
                    </p>
                    <p class="text-sm text-primary-600 font-medium">Pendant tous les cultes</p>
                </div>

                <div class="bg-background rounded-2xl p-8 text-center hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold">4-6</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-3">Petits Explorateurs</h3>
                    <p class="text-gray-600 mb-4">
                        Histoires bibliques, chants, jeux et activites manuelles pour decouvrir
                        Dieu de maniere amusante.
                    </p>
                    <p class="text-sm text-primary-600 font-medium">Dimanche 09h00</p>
                </div>

                <div class="bg-background rounded-2xl p-8 text-center hover:shadow-lg transition-shadow">
                    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold">7-12</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-3">Champions de la Foi</h3>
                    <p class="text-gray-600 mb-4">
                        Etude biblique interactive, memorisation de versets, projets creatifs
                        et developpement du caractere.
                    </p>
                    <p class="text-sm text-primary-600 font-medium">Dimanche 09h00</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Safety Section -->
    <section class="py-16 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 bg-primary-100 rounded-full flex items-center justify-center">
                            <svg class="w-7 h-7 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-primary-800">Securite des enfants</h2>
                    </div>
                    <p class="text-gray-600 mb-6">
                        La securite de vos enfants est notre priorite absolue. Nous avons mis en place des mesures
                        rigoureuses pour garantir un environnement sur.
                    </p>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Verification des antecedents des moniteurs</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Systeme d'enregistrement securise</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Badges d'identification parent-enfant</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">Salles securisees et surveillees</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Join CTA -->
    <section class="py-16 bg-gradient-to-r from-primary-700 to-primary-800 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Inscrivez vos enfants</h2>
            <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
                Offrez a vos enfants une experience enrichissante chaque dimanche. L'inscription est simple et gratuite.
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
