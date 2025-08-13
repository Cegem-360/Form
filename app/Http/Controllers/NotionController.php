<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\RequestQuote;
use App\Services\NotionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class NotionController extends Controller
{
    public function __construct(
        private NotionService $notionService
    ) {}

    /**
     * Egyszerű teszt adat feltöltése
     */
    public function uploadTestData(): JsonResponse
    {
        $testData = [
            'Név' => 'Teszt Ügyfél',
            'Email' => 'test@example.com',
            'Telefonszám' => '+36 30 123 4567',
            'Weboldal típus' => 'Webshop',
            'Teljes ár' => 150000,
            'Státusz' => 'Új ajánlatkérés',
        ];

        // Most nem kell database ID-t megadni, ha van alapértelmezett
        $result = $this->notionService->createSimpleEntry($testData);

        return response()->json($result);
    }

    /**
     * RequestQuote adatok mentése Notion-ba
     */
    public function saveRequestQuote(int $requestQuoteId): JsonResponse
    {
        $requestQuote = RequestQuote::with('websiteType')->findOrFail($requestQuoteId);

        // Most nem kell database ID-t megadni, ha van alapértelmezett
        $result = $this->notionService->saveFormQuoteToNotion($requestQuote);

        return response()->json($result);
    }

    /**
     * Notion adatbázis lekérdezése
     */
    public function queryDatabase(): JsonResponse
    {
        $databaseId = 'YOUR_DATABASE_ID_HERE';

        $result = $this->notionService->queryDatabase($databaseId);

        return response()->json($result);
    }

    /**
     * Egyedi Notion oldal létrehozása
     */
    public function createCustomPage(Request $request): JsonResponse
    {
        $data = $request->validate([
            'név' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email'],
            'telefon' => ['nullable', 'string'],
            'ár' => ['nullable', 'numeric'],
            'megjegyzés' => ['nullable', 'string'],
        ]);

        $result = $this->notionService->createSimpleEntry($data);

        return response()->json($result);
    }

    /**
     * Notion oldal lekérése ID alapján
     */
    public function getPage(string $pageId): JsonResponse
    {
        $result = $this->notionService->getPage($pageId);

        return response()->json($result);
    }
}
