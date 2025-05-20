<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

// Teszt hibakódos oldalak
Route::get('/error/401', function () {
    abort(401);
});
Route::get('/error/402', function () {
    abort(402);
});
Route::get('/error/403', function () {
    abort(403);
});
Route::get('/error/404', function () {
    abort(404);
});
Route::get('/error/419', function () {
    abort(419);
});
Route::get('/error/429', function () {
    abort(429);
});
Route::get('/error/500', function () {
    abort(500);
});
Route::get('/error/503', function () {
    abort(503);
});
