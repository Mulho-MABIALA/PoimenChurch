<x-guest-layout>
    <x-slot name="title">{{ __('app.auth.forgot_password') }} - {{ config('app.name') }}</x-slot>

    <div class="card">
        <h2 class="text-2xl font-bold text-center text-primary-700 mb-6">{{ __('app.auth.reset_password') }}</h2>

        <p class="text-sm text-gray-600 mb-6 text-center">
            Entrez votre adresse email et nous vous enverrons un lien pour reinitialiser votre mot de passe.
        </p>

        @if(session('status'))
            <div class="alert-success mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <div class="form-group">
                <label for="email" class="label">{{ __('app.auth.email') }}</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    class="input @error('email') input-error @enderror">
                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-primary w-full">
                {{ __('app.auth.send_reset_link') }}
            </button>

            <p class="text-center">
                <a href="{{ route('login') }}" class="text-sm text-primary-600 hover:text-primary-700">
                    &larr; {{ __('app.auth.login') }}
                </a>
            </p>
        </form>
    </div>
</x-guest-layout>
