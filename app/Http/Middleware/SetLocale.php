<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

final class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);
        $supportedLocales = ['en', 'de', 'hu'];
        $defaultLocale = 'hu';

        if (in_array($locale, $supportedLocales)) {
            App::setLocale($locale);
            URL::defaults(['locale' => $locale]);
        } else {
            App::setLocale($defaultLocale);
            URL::defaults(['locale' => $defaultLocale]);
        }

        return $next($request);
    }
}
