<x-public-layout>
    <x-slot name="title">Nos Croyances - Poimen Church</x-slot>
    <x-slot name="metaDescription">Decouvrez les croyances fondamentales de Poimen Church. Notre foi est ancree dans la Parole de Dieu.</x-slot>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-800 to-primary-900 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Nos Croyances</h1>
                <p class="text-xl text-primary-100">Les fondements de notre foi, ancres dans la Parole de Dieu</p>
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
                <span class="text-primary-700 font-medium">Nos Croyances</span>
            </nav>
        </div>
    </div>

    <!-- Beliefs Section -->
    <section class="py-16 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Nos croyances sont fondees sur la Bible, la Parole infaillible de Dieu.
                        Voici les doctrines essentielles qui guident notre foi et notre pratique.
                    </p>
                </div>

                <div class="space-y-6">
                    <!-- Belief 1 -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-6 md:p-8">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-primary-800 mb-3">La Bible</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Nous croyons que la Bible est la Parole de Dieu, inspiree par le Saint-Esprit,
                                        infaillible et inerrante dans ses manuscrits originaux. Elle est l'autorite
                                        supreme en matiere de foi et de pratique chretienne.
                                    </p>
                                    <p class="text-sm text-gray-500 mt-3 italic">
                                        "Toute Ecriture est inspiree de Dieu, et utile pour enseigner, pour convaincre,
                                        pour corriger, pour instruire dans la justice." - 2 Timothee 3:16
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Belief 2 -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-6 md:p-8">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-primary-800 mb-3">Dieu</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Nous croyons en un seul Dieu, eternellement existant en trois personnes :
                                        le Pere, le Fils et le Saint-Esprit. Ces trois personnes sont co-egales
                                        et co-eternelles, formant la Trinite.
                                    </p>
                                    <p class="text-sm text-gray-500 mt-3 italic">
                                        "Car il y a un seul Dieu, et aussi un seul mediateur entre Dieu et les hommes,
                                        Jesus-Christ homme." - 1 Timothee 2:5
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Belief 3 -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-6 md:p-8">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-primary-800 mb-3">Jesus-Christ</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Nous croyons en Jesus-Christ, vrai Dieu et vrai homme, ne d'une vierge,
                                        qui a vecu une vie sans peche, est mort sur la croix pour nos peches,
                                        est ressuscite le troisieme jour, et reviendra pour juger les vivants et les morts.
                                    </p>
                                    <p class="text-sm text-gray-500 mt-3 italic">
                                        "Je suis le chemin, la verite, et la vie. Nul ne vient au Pere que par moi."
                                        - Jean 14:6
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Belief 4 -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-6 md:p-8">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-primary-800 mb-3">Le Saint-Esprit</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Nous croyons au Saint-Esprit, troisieme personne de la Trinite, qui convainc
                                        le monde de peche, regenere les croyants, et les equipe pour le service
                                        par ses dons spirituels.
                                    </p>
                                    <p class="text-sm text-gray-500 mt-3 italic">
                                        "Mais vous recevrez une puissance, le Saint-Esprit survenant sur vous."
                                        - Actes 1:8
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Belief 5 -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-6 md:p-8">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-primary-800 mb-3">L'Homme et le Peche</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Nous croyons que l'homme a ete cree a l'image de Dieu, mais est tombe
                                        dans le peche par la desobeissance d'Adam. Tous les hommes sont pecheurs
                                        par nature et ont besoin du salut.
                                    </p>
                                    <p class="text-sm text-gray-500 mt-3 italic">
                                        "Car tous ont peche et sont prives de la gloire de Dieu." - Romains 3:23
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Belief 6 -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-6 md:p-8">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-primary-800 mb-3">Le Salut</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Nous croyons que le salut est un don gratuit de Dieu, obtenu par la foi
                                        en Jesus-Christ seul. Il n'est pas le resultat de nos oeuvres, mais de
                                        la grace de Dieu manifestee a la croix.
                                    </p>
                                    <p class="text-sm text-gray-500 mt-3 italic">
                                        "Car c'est par la grace que vous etes sauves, par le moyen de la foi.
                                        Et cela ne vient pas de vous, c'est le don de Dieu." - Ephesiens 2:8
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Belief 7 -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-6 md:p-8">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-primary-800 mb-3">L'Eglise</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Nous croyons que l'Eglise est le corps de Christ, compose de tous les croyants.
                                        Elle est appelee a adorer Dieu, a edifier les saints, et a proclamer l'Evangile
                                        a toutes les nations.
                                    </p>
                                    <p class="text-sm text-gray-500 mt-3 italic">
                                        "Vous etes le corps de Christ, et vous etes ses membres, chacun pour sa part."
                                        - 1 Corinthiens 12:27
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Belief 8 -->
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-6 md:p-8">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-primary-800 mb-3">Le Retour de Christ</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Nous croyons au retour personnel et visible de Jesus-Christ pour etablir
                                        son royaume eternel. Cette esperance benie nous pousse a vivre dans la
                                        saintete et a temoigner avec urgence.
                                    </p>
                                    <p class="text-sm text-gray-500 mt-3 italic">
                                        "Ce Jesus, qui a ete enleve au ciel du milieu de vous, viendra de la meme
                                        maniere que vous l'avez vu allant au ciel." - Actes 1:11
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-primary-700 to-primary-800 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Vous avez des questions?</h2>
            <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
                Nous serions heureux de discuter de notre foi avec vous et de repondre a vos questions.
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
