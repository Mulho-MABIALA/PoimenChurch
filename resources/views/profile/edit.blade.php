<x-app-layout>
    <x-slot name="title">{{ __('app.profile.edit') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.profile.edit'))

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
    </style>

    <div class="max-w-2xl mx-auto">
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
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900">{{ __('app.profile.edit') }}</h2>
                <p class="text-gray-500 text-sm mt-0.5">Modifiez vos informations personnelles</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <!-- Personal Info Section -->
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900">Informations personnelles</h3>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    {{ __('app.members.first_name') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="first_name" name="first_name"
                                       value="{{ old('first_name', auth()->user()->first_name) }}" required
                                       class="form-input w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none @error('first_name') form-input-error @enderror">
                                @error('first_name')
                                    <p class="text-red-500 text-sm mt-1.5 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    {{ __('app.members.last_name') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="last_name" name="last_name"
                                       value="{{ old('last_name', auth()->user()->last_name) }}" required
                                       class="form-input w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none @error('last_name') form-input-error @enderror">
                                @error('last_name')
                                    <p class="text-red-500 text-sm mt-1.5 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    {{ __('app.members.date_of_birth') }}
                                </label>
                                <input type="date" id="date_of_birth" name="date_of_birth"
                                       value="{{ old('date_of_birth', auth()->user()->date_of_birth?->format('Y-m-d')) }}"
                                       class="form-input w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none @error('date_of_birth') form-input-error @enderror">
                                @error('date_of_birth')
                                    <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    {{ __('app.members.gender') }}
                                </label>
                                <select id="gender" name="gender"
                                        class="form-input w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none bg-white @error('gender') form-input-error @enderror">
                                    <option value="">-- {{ __('app.select') }} --</option>
                                    <option value="male" {{ old('gender', auth()->user()->gender) === 'male' ? 'selected' : '' }}>{{ __('app.members.male') }}</option>
                                    <option value="female" {{ old('gender', auth()->user()->gender) === 'female' ? 'selected' : '' }}>{{ __('app.members.female') }}</option>
                                </select>
                                @error('gender')
                                    <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Info Section -->
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900">Coordonnées</h3>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">
                                {{ __('app.members.email') }} <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                </div>
                                <input type="email" id="email" name="email"
                                       value="{{ old('email', auth()->user()->email) }}" required
                                       class="form-input w-full pl-12 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none @error('email') form-input-error @enderror">
                            </div>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1.5">
                                {{ __('app.members.phone') }}
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <input type="tel" id="phone" name="phone"
                                       value="{{ old('phone', auth()->user()->phone) }}"
                                       placeholder="+221 77 123 45 67"
                                       class="form-input w-full pl-12 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none @error('phone') form-input-error @enderror">
                            </div>
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1.5">
                                {{ __('app.members.address') }}
                            </label>
                            <textarea id="address" name="address" rows="2"
                                      placeholder="Votre adresse complète..."
                                      class="form-input w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none resize-none @error('address') form-input-error @enderror">{{ old('address', auth()->user()->address) }}</textarea>
                            @error('address')
                                <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Preferences Section -->
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900">Préférences</h3>
                    </div>

                    <div>
                        <label for="locale" class="block text-sm font-medium text-gray-700 mb-1.5">
                            {{ __('app.profile.language') }}
                        </label>
                        <div class="flex gap-3">
                            <label class="flex-1 relative cursor-pointer">
                                <input type="radio" name="locale" value="fr"
                                       {{ old('locale', auth()->user()->locale) === 'fr' ? 'checked' : '' }}
                                       class="peer sr-only">
                                <div class="p-4 border-2 border-gray-200 rounded-xl transition-all peer-checked:border-primary-500 peer-checked:bg-primary-50 hover:bg-gray-50">
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">🇫🇷</span>
                                        <div>
                                            <p class="font-medium text-gray-900">Français</p>
                                            <p class="text-sm text-gray-500">Interface en français</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            <label class="flex-1 relative cursor-pointer">
                                <input type="radio" name="locale" value="en"
                                       {{ old('locale', auth()->user()->locale) === 'en' ? 'checked' : '' }}
                                       class="peer sr-only">
                                <div class="p-4 border-2 border-gray-200 rounded-xl transition-all peer-checked:border-primary-500 peer-checked:bg-primary-50 hover:bg-gray-50">
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">🇬🇧</span>
                                        <div>
                                            <p class="font-medium text-gray-900">English</p>
                                            <p class="text-sm text-gray-500">English interface</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @error('locale')
                            <p class="text-red-500 text-sm mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="p-6 bg-gray-50/50 flex flex-col-reverse sm:flex-row sm:items-center sm:justify-end gap-3">
                    <a href="{{ route('profile.show') }}"
                       class="px-5 py-2.5 text-gray-700 font-medium rounded-xl border border-gray-200 hover:bg-gray-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-gray-500 focus-visible:ring-offset-2 transition-colors text-center">
                        {{ __('app.cancel') }}
                    </a>
                    <button type="submit"
                            class="px-5 py-2.5 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 transition-colors shadow-sm inline-flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ __('app.update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
