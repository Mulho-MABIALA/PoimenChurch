<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Poimen Church') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-background">
    <div class="min-h-screen flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8">
        <!-- Logo -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-primary-700">Poimen Church</h1>
            <p class="mt-2 text-text-secondary">Systeme de Gestion Ecclesiastique</p>
        </div>

        <!-- Content -->
        <div class="w-full max-w-md">
            {{ $slot }}
        </div>

        <!-- Language Switcher -->
        <div class="mt-8 flex items-center space-x-4 text-sm">
            <a href="{{ route('lang.switch', 'fr') }}" class="{{ app()->getLocale() === 'fr' ? 'text-primary-700 font-medium' : 'text-gray-500 hover:text-gray-700' }}">
                Francais
            </a>
            <span class="text-gray-300">|</span>
            <a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() === 'en' ? 'text-primary-700 font-medium' : 'text-gray-500 hover:text-gray-700' }}">
                English
            </a>
        </div>
    </div>
</body>
</html>
