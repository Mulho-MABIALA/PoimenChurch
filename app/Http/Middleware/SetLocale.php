<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $this->getLocale($request);

        if (in_array($locale, config('app.available_locales', ['fr', 'en']))) {
            App::setLocale($locale);
        }

        return $next($request);
    }

    protected function getLocale(Request $request): string
    {
        // 1. Check URL parameter
        if ($request->has('lang')) {
            $locale = $request->get('lang');
            session(['locale' => $locale]);
            return $locale;
        }

        // 2. Check session
        if (session()->has('locale')) {
            return session('locale');
        }

        // 3. Check authenticated user preference
        if (Auth::check() && Auth::user()->locale) {
            return Auth::user()->locale;
        }

        // 4. Check browser preference
        $browserLocale = substr($request->server('HTTP_ACCEPT_LANGUAGE', 'fr'), 0, 2);
        if (in_array($browserLocale, config('app.available_locales', ['fr', 'en']))) {
            return $browserLocale;
        }

        // 5. Default to app locale
        return config('app.locale', 'fr');
    }
}
