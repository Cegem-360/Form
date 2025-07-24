<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Notion API Configuration
    |--------------------------------------------------------------------------
    |
    | Itt állíthatod be a Notion API specifikus beállításokat.
    |
    */

    'api_token' => env('NOTION_API_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | Default Database IDs
    |--------------------------------------------------------------------------
    |
    | Itt adhatod meg az alapértelmezett Notion adatbázis ID-kat.
    |
    */

    'databases' => [
        'quotes' => env('NOTION_QUOTES_DATABASE_ID'),
        'customers' => env('NOTION_CUSTOMERS_DATABASE_ID'),
        'projects' => env('NOTION_PROJECTS_DATABASE_ID'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Page Settings
    |--------------------------------------------------------------------------
    |
    | Alapértelmezett beállítások az új oldalakhoz.
    |
    */

    'defaults' => [
        'status' => 'Új ajánlatkérés',
        'timezone' => 'Europe/Budapest',
    ],

    /*
    |--------------------------------------------------------------------------
    | Error Handling
    |--------------------------------------------------------------------------
    |
    | Hibakezelési beállítások.
    |
    */

    'error_handling' => [
        'log_errors' => env('NOTION_LOG_ERRORS', true),
        'throw_on_error' => env('NOTION_THROW_ON_ERROR', false),
    ],
];
