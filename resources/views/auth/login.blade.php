<x-guest-layout>
    <x-slot name="title">{{ __('app.auth.login') }} - {{ config('app.name') }}</x-slot>

    <div class="card">
        <h2 class="text-2xl font-bold text-center text-primary-700 mb-6">{{ __('app.auth.login') }}</h2>

        @if(session('status'))
            <div class="alert-success mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div class="form-group">
                <label for="email" class="label">{{ __('app.auth.email') }}</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    class="input @error('email') input-error @enderror">
                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="label">{{ __('app.auth.password') }}</label>
                <input type="password" id="password" name="password" required
                    class="input @error('password') input-error @enderror">
                @error('password')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                    <span class="ml-2 text-sm text-gray-600">{{ __('app.auth.remember_me') }}</span>
                </label>

                <a href="{{ route('password.request') }}" class="text-sm text-primary-600 hover:text-primary-700">
                    {{ __('app.auth.forgot_password') }}
                </a>
            </div>

            <button type="submit" class="btn-primary w-full">
                {{ __('app.auth.login') }}
            </button>
        </form>
    </div>
</x-guest-layout>
