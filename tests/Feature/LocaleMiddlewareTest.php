<?php

declare(strict_types=1);

use App\Http\Middleware\SetLocale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

it('sets locale to english when /en prefix is used', function () {
    // The middleware runs even if the route doesn't exist
    $response = $this->get('/en');

    // Middleware should set locale to 'en' based on the URL segment
    expect(App::getLocale())->toBe('en');
});

it('sets default locale to hungarian when no prefix is used', function () {
    $response = $this->get('/form/expired');

    $response->assertSuccessful();
    expect(App::getLocale())->toBe('hu');
});

it('sets default locale to hungarian for root path without prefix', function () {
    // Create a test user for authenticated route
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/');

    $response->assertRedirect();
    expect(App::getLocale())->toBe('hu');
});

it('middleware processes request and sets locale', function () {
    // Test the middleware directly with a mock request
    $middleware = new SetLocale();

    // Test with English locale
    $request = Request::create('/en/test');
    $next = function ($request) {
        return new Response('OK');
    };

    $response = $middleware->handle($request, $next);
    expect(App::getLocale())->toBe('en');

    // Test with German locale
    $request = Request::create('/de/test');
    $response = $middleware->handle($request, $next);
    expect(App::getLocale())->toBe('de');

    // Test with Hungarian locale
    $request = Request::create('/hu/test');
    $response = $middleware->handle($request, $next);
    expect(App::getLocale())->toBe('hu');

    // Test with no locale prefix
    $request = Request::create('/test');
    $response = $middleware->handle($request, $next);
    expect(App::getLocale())->toBe('hu');

    // Test with invalid locale
    $request = Request::create('/fr/test');
    $response = $middleware->handle($request, $next);
    expect(App::getLocale())->toBe('hu');
});

dataset('locales', [
    ['en', 'en'],
    ['de', 'de'],
    ['hu', 'hu'],
    ['fr', 'hu'], // invalid locale should default to 'hu'
    ['', 'hu'], // no prefix should default to 'hu'
]);

it('sets correct locale based on URL segment', function (string $prefix, string $expectedLocale) {
    $middleware = new SetLocale();

    $path = $prefix ? "/$prefix/test" : '/test';
    $request = Request::create($path);

    $next = function ($request) {
        return new Response('OK');
    };

    $middleware->handle($request, $next);
    expect(App::getLocale())->toBe($expectedLocale);
})->with('locales');

it('works correctly with actual routes', function () {
    // Test with a route that actually exists
    $response = $this->get('/form/expired');

    $response->assertSuccessful();
    expect(App::getLocale())->toBe('hu');
});

it('maintains locale for nested paths', function () {
    $middleware = new SetLocale();

    // Test nested path with German locale
    $request = Request::create('/de/some/nested/path');
    $next = function ($request) {
        return new Response('OK');
    };

    $middleware->handle($request, $next);
    expect(App::getLocale())->toBe('de');
});

it('handles empty path correctly', function () {
    $middleware = new SetLocale();

    $request = Request::create('/');
    $next = function ($request) {
        return new Response('OK');
    };

    $middleware->handle($request, $next);
    expect(App::getLocale())->toBe('hu');
});
