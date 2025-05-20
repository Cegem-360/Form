<?php

declare(strict_types=1);

describe('Minden hibakódos oldal a megfelelő státuszkódot adja vissza.', function () {
    it('return the correct HTTP status code for each error route', function (int $code) {
        $response = test()->get("/error/{$code}");
        $response->assertStatus($code);
    })->with([
        401,
        402,
        403,
        404,
        419,
        429,
        500,
        503,
    ]);
});
