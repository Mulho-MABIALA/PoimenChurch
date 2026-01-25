<x-app-layout>
    <x-slot name="title">{{ __('app.profile.change_password') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.profile.change_password'))

    <style>
        .form-input {
            transition: all 0.2s ease;
        }
        .form-input:focus {
            border-color: var(--color-primary-500);
            box-shadow: 0 0 0 3px rgba(79, 111, 58, 0.1);
        }
        .form-input-error {
            border-color: #ef4444;
        }
        .form-input-error:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }
        .password-strength {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
    </style>

    <div class="max-w-md mx-auto">
        <!-- Header -->
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('profile.show') }}"
               class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl transition-colors"
               title="Retour au profil">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900">{{ __('app.profile.change_password') }}</h2>
                <p class="text-gray-500 text-sm mt-0.5">Sécurisez votre compte</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <!-- Security Notice -->
            <div class="p-4 bg-amber-50 border-b border-amber-100">
                <div class="flex gap-3">
                    <div class="shrink-0">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-amber-800">Conseil de sécurité</p>
                        <p class="text-sm text-amber-700 mt-0.5">Utilisez un mot de passe unique d'au moins 8 caractères avec des lettres, chiffres et symboles.</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.password.update') }}" class="p-6">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1.5">
                            {{ __('app.profile.current_password') }} <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input type="password" id="current_password" name="current_password" required
                                   placeholder="Votre mot de passe actuel"
                                   class="form-input w-full pl-12 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none @error('current_password') form-input-error @enderror">
                        </div>
                        @error('current_password')
                            <p class="text-red-500 text-sm mt-1.5 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">
                            {{ __('app.profile.new_password') }} <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                </svg>
                            </div>
                            <input type="password" id="password" name="password" required
                                   placeholder="Nouveau mot de passe"
                                   class="form-input w-full pl-12 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none @error('password') form-input-error @enderror">
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1.5 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">
                            {{ __('app.profile.confirm_password') }} <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                   placeholder="Confirmez le nouveau mot de passe"
                                   class="form-input w-full pl-12 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none @error('password_confirmation') form-input-error @enderror">
                        </div>
                        @error('password_confirmation')
                            <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3 mt-6 pt-6 border-t border-gray-100">
                    <a href="{{ route('profile.show') }}"
                       class="px-5 py-2.5 text-gray-700 font-medium rounded-xl border border-gray-200 hover:bg-gray-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-gray-500 focus-visible:ring-offset-2 transition-colors text-center">
                        {{ __('app.cancel') }}
                    </a>
                    <button type="submit"
                            class="px-5 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 transition-colors shadow-sm inline-flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                        {{ __('app.update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
