<x-public-layout>
    <x-slot name="title">Ministere de Louange - Poimen Church</x-slot>
    <x-slot name="metaDescription">Decouvrez le ministere de louange de Poimen Church. Rejoignez notre equipe pour adorer Dieu.</x-slot>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-800 to-primary-900 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                    </svg>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Ministere de Louange</h1>
                <p class="text-xl text-primary-100">Adorer Dieu en esprit et en verite</p>
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
                <span class="text-primary-700 font-medium">Louange</span>
            </nav>
        </div>
    </div>

    <!-- About Section -->
    <section class="py-16 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-primary-800 mb-6">Notre Passion : L'Adoration</h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Le ministere de louange de Poimen Church est dedie a creer une atmosphere
                            ou chaque croyant peut rencontrer Dieu dans l'adoration. Nous croyons que
                            la louange est bien plus que de la musique - c'est un style de vie.
                        </p>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Notre equipe est composee de musiciens, chanteurs et techniciens passionnes
                            qui utilisent leurs dons pour glorifier Dieu et edifier l'Eglise.
                        </p>
                        <div class="bg-white rounded-xl p-6 border-l-4 border-gold-500">
                            <p class="text-gray-700 italic">
                                "Louez l'Eternel, car il est bon, car sa misericorde dure a toujours!"
                            </p>
                            <span class="text-sm text-gray-500 mt-2 block">- Psaume 136:1</span>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl p-8 text-white">
                        <h3 class="text-2xl font-bold mb-6">Ce que nous faisons</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Direction de la louange lors des cultes dominicaux</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Organisation de soirees d'adoration</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Formation de nouveaux musiciens et chanteurs</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Production de chants originaux</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Teams Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-primary-800 mb-4">Nos Equipes</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Plusieurs equipes travaillent ensemble pour offrir une experience d'adoration excellente.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                <div class="bg-background rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-primary-800 mb-2">Musiciens</h3>
                    <p class="text-sm text-gray-600">Guitares, piano, batterie, basse et autres instruments.</p>
                </div>

                <div class="bg-background rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-primary-800 mb-2">Chanteurs</h3>
                    <p class="text-sm text-gray-600">Chorale et lead vocalists pour diriger l'adoration.</p>
                </div>

                <div class="bg-background rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-primary-800 mb-2">Technique</h3>
                    <p class="text-sm text-gray-600">Son, lumieres et projection multimedia.</p>
                </div>

                <div class="bg-background rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-primary-800 mb-2">Media</h3>
                    <p class="text-sm text-gray-600">Enregistrement video et diffusion en direct.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Join CTA -->
    <section class="py-16 bg-gradient-to-r from-primary-700 to-primary-800 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Rejoignez notre equipe</h2>
            <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
                Vous avez un don musical ou technique? Nous serions ravis de vous accueillir dans notre equipe de louange.
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
