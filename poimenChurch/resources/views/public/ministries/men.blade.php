<x-public-layout>
    <x-slot name="title">Ministere des Hommes - Poimen Church</x-slot>
    <x-slot name="metaDescription">Le ministere des hommes de Poimen Church. Former des hommes selon le coeur de Dieu.</x-slot>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-800 to-primary-900 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Ministere des Hommes</h1>
                <p class="text-xl text-primary-100">Des hommes selon le coeur de Dieu</p>
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
                <span class="text-primary-700 font-medium">Hommes</span>
            </nav>
        </div>
    </div>

    <!-- About Section -->
    <section class="py-16 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="order-2 lg:order-1 bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl p-8 text-white">
                        <h3 class="text-2xl font-bold mb-6">Nos piliers</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Vie spirituelle et priere</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Leadership familial</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Integrite et responsabilite</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Service et engagement communautaire</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-6 h-6 text-gold-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span>Fraternite et soutien mutuel</span>
                            </li>
                        </ul>
                    </div>
                    <div class="order-1 lg:order-2">
                        <h2 class="text-3xl font-bold text-primary-800 mb-6">Former des hommes d'influence</h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Le ministere des hommes de Poimen Church a pour mission de former des hommes
                            qui marchent avec integrite, menent leurs familles avec sagesse et impactent
                            positivement leur communaute.
                        </p>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Nous croyons que Dieu appelle chaque homme a etre un leader serviteur,
                            refletant le caractere de Christ dans tous les aspects de sa vie.
                        </p>
                        <div class="bg-white rounded-xl p-6 border-l-4 border-gold-500">
                            <p class="text-gray-700 italic">
                                "Fortifiez-vous dans le Seigneur, et par sa force toute-puissante."
                            </p>
                            <span class="text-sm text-gray-500 mt-2 block">- Ephesiens 6:10</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Activities Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-primary-800 mb-4">Nos Activites</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Des moments de fellowship, de formation et de service pour grandir ensemble.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <div class="bg-background rounded-2xl p-8 hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-3">Etude Biblique</h3>
                    <p class="text-gray-600 mb-4">
                        Etude approfondie de la Parole pour devenir des hommes ancres dans la verite biblique.
                    </p>
                    <p class="text-sm text-gold-600 font-medium">Samedi 06h00</p>
                </div>

                <div class="bg-background rounded-2xl p-8 hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-3">Groupes de Responsabilite</h3>
                    <p class="text-gray-600 mb-4">
                        Petits groupes ou les hommes se tiennent mutuellement responsables dans leur marche chretienne.
                    </p>
                    <p class="text-sm text-gold-600 font-medium">Hebdomadaire</p>
                </div>

                <div class="bg-background rounded-2xl p-8 hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-3">Peres en Action</h3>
                    <p class="text-gray-600 mb-4">
                        Formation sur la paternite biblique et le role du pere dans la famille.
                    </p>
                    <p class="text-sm text-gold-600 font-medium">Mensuel</p>
                </div>

                <div class="bg-background rounded-2xl p-8 hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-3">Leadership au Travail</h3>
                    <p class="text-gray-600 mb-4">
                        Comment vivre sa foi et etre un temoin efficace dans son milieu professionnel.
                    </p>
                    <p class="text-sm text-gold-600 font-medium">Trimestriel</p>
                </div>

                <div class="bg-background rounded-2xl p-8 hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-3">Mentorat</h3>
                    <p class="text-gray-600 mb-4">
                        Programme de mentorat ou des hommes matures accompagnent les plus jeunes dans leur croissance.
                    </p>
                    <p class="text-sm text-gold-600 font-medium">Sur inscription</p>
                </div>

                <div class="bg-background rounded-2xl p-8 hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-800 mb-3">Retraite Annuelle</h3>
                    <p class="text-gray-600 mb-4">
                        Un week-end de ressourcement, de fraternite et de renouvellement spirituel.
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
                Venez faire partie d'une communaute d'hommes determines a vivre selon les principes de Dieu.
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
