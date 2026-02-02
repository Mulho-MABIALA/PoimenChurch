<x-public-layout>
    <x-slot name="title">Notre Histoire - Poimen Church</x-slot>
    <x-slot name="metaDescription">Decouvrez l'histoire de Poimen Church, notre parcours de foi depuis nos debuts.</x-slot>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-800 to-primary-900 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Notre Histoire</h1>
                <p class="text-xl text-primary-100">Un parcours de foi, d'amour et de devotion</p>
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
                <span class="text-primary-700 font-medium">Notre Histoire</span>
            </nav>
        </div>
    </div>

    <!-- Timeline Section -->
    <section class="py-16 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Introduction -->
                <div class="text-center mb-16">
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Poimen Church est nee d'une vision profonde : creer une communaute ou chaque personne peut rencontrer Dieu,
                        grandir dans la foi et servir les autres avec amour. Notre parcours temoigne de la fidelite de Dieu
                        a travers les annees.
                    </p>
                </div>

                <!-- Timeline -->
                <div class="relative">
                    <!-- Timeline line -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-primary-200 hidden md:block"></div>

                    <!-- Timeline items -->
                    <div class="space-y-12">
                        <!-- 2005 -->
                        <div class="relative flex flex-col md:flex-row items-center">
                            <div class="md:w-1/2 md:pr-12 md:text-right mb-4 md:mb-0">
                                <div class="bg-white rounded-2xl shadow-lg p-6">
                                    <span class="inline-block bg-gold-500 text-white px-4 py-1 rounded-full text-sm font-semibold mb-3">2005</span>
                                    <h3 class="text-xl font-bold text-primary-800 mb-2">Les Debuts</h3>
                                    <p class="text-gray-600">
                                        Un petit groupe de croyants se reunit dans un salon pour prier et etudier la Bible.
                                        C'est le debut d'une grande aventure de foi.
                                    </p>
                                </div>
                            </div>
                            <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-primary-700 rounded-full border-4 border-white shadow hidden md:block"></div>
                            <div class="md:w-1/2 md:pl-12"></div>
                        </div>

                        <!-- 2008 -->
                        <div class="relative flex flex-col md:flex-row items-center">
                            <div class="md:w-1/2 md:pr-12"></div>
                            <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-primary-700 rounded-full border-4 border-white shadow hidden md:block"></div>
                            <div class="md:w-1/2 md:pl-12 mb-4 md:mb-0">
                                <div class="bg-white rounded-2xl shadow-lg p-6">
                                    <span class="inline-block bg-gold-500 text-white px-4 py-1 rounded-full text-sm font-semibold mb-3">2008</span>
                                    <h3 class="text-xl font-bold text-primary-800 mb-2">Premier Local</h3>
                                    <p class="text-gray-600">
                                        L'eglise acquiert son premier local de culte, permettant d'accueillir
                                        une communaute grandissante de fideles.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- 2012 -->
                        <div class="relative flex flex-col md:flex-row items-center">
                            <div class="md:w-1/2 md:pr-12 md:text-right mb-4 md:mb-0">
                                <div class="bg-white rounded-2xl shadow-lg p-6">
                                    <span class="inline-block bg-gold-500 text-white px-4 py-1 rounded-full text-sm font-semibold mb-3">2012</span>
                                    <h3 class="text-xl font-bold text-primary-800 mb-2">Expansion des Ministeres</h3>
                                    <p class="text-gray-600">
                                        Lancement des ministeres de jeunesse, d'enfants et de femmes pour mieux
                                        repondre aux besoins de chaque membre.
                                    </p>
                                </div>
                            </div>
                            <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-primary-700 rounded-full border-4 border-white shadow hidden md:block"></div>
                            <div class="md:w-1/2 md:pl-12"></div>
                        </div>

                        <!-- 2018 -->
                        <div class="relative flex flex-col md:flex-row items-center">
                            <div class="md:w-1/2 md:pr-12"></div>
                            <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-primary-700 rounded-full border-4 border-white shadow hidden md:block"></div>
                            <div class="md:w-1/2 md:pl-12 mb-4 md:mb-0">
                                <div class="bg-white rounded-2xl shadow-lg p-6">
                                    <span class="inline-block bg-gold-500 text-white px-4 py-1 rounded-full text-sm font-semibold mb-3">2018</span>
                                    <h3 class="text-xl font-bold text-primary-800 mb-2">Nouveau Sanctuaire</h3>
                                    <p class="text-gray-600">
                                        Inauguration de notre nouveau sanctuaire, un espace moderne et accueillant
                                        pour la louange et l'adoration.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Present -->
                        <div class="relative flex flex-col md:flex-row items-center">
                            <div class="md:w-1/2 md:pr-12 md:text-right mb-4 md:mb-0">
                                <div class="bg-white rounded-2xl shadow-lg p-6">
                                    <span class="inline-block bg-gold-500 text-white px-4 py-1 rounded-full text-sm font-semibold mb-3">Aujourd'hui</span>
                                    <h3 class="text-xl font-bold text-primary-800 mb-2">Une Communaute Vibrante</h3>
                                    <p class="text-gray-600">
                                        Poimen Church continue de croitre, touchant des vies et repandant l'amour
                                        de Christ dans notre ville et au-dela.
                                    </p>
                                </div>
                            </div>
                            <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-gold-500 rounded-full border-4 border-white shadow hidden md:block"></div>
                            <div class="md:w-1/2 md:pl-12"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-primary-800 mb-4">Nos Valeurs Fondamentales</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Les principes qui guident notre communaute depuis le debut.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-2">Fidelite a la Parole</h3>
                    <p class="text-gray-600">La Bible est notre fondement et notre guide dans toutes nos decisions.</p>
                </div>

                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-2">Amour Inconditionnel</h3>
                    <p class="text-gray-600">Nous accueillons chaque personne avec l'amour de Christ, sans jugement.</p>
                </div>

                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-2">Service Communautaire</h3>
                    <p class="text-gray-600">Nous sommes appeles a servir notre communaute avec generosite et joie.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-primary-700 to-primary-800 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Ecrivez l'histoire avec nous</h2>
            <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
                Rejoignez notre famille et faites partie de cette belle aventure de foi.
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
