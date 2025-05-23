<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\RequestQuote;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

final class EnsureHasRequestQuote
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->session()->has('requestQuote')) {
            abort(403, 'Session dont have requestQuote.');
        }

        $requestQuote = RequestQuote::where('id', $request->session()->get('requestQuote'))->firstOr(callback: function (): void {
            abort(403, 'RequestQuote not found.');
        });
        /* if (Auth::user()->id !== $requestQuote->user_id) {
            abort(403, 'Unauthorized action. No match with user.');
        } */

        return $next($request);
    }
}
