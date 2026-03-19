<x-guest-layout>
    <x-slot name="title">{{ __('app.auth.reset_password') }} - {{ config('app.name') }}</x-slot>

    <div class="card">
        <h2 class="text-2xl font-bold text-center text-primary-700 mb-6">{{ __('app.auth.reset_password') }}</h2>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email" class="label">{{ __('app.auth.email') }}</label>
                <input type="email" id="email" name="email" value="{{ old('email', $email) }}" required autofocus
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

            <div class="form-group">
                <label for="password_confirmation" class="label">{{ __('app.auth.confirm_password') }}</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required class="input">
            </div>

            <button type="submit" class="btn-primary w-full">
                {{ __('app.auth.reset_password') }}
            </button>
        </form>
    </div>
</x-guest-layout>
