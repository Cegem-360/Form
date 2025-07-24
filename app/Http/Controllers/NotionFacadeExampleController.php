<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Facades\NotionFacade;
use App\Models\RequestQuote;
use Illuminate\Http\JsonResponse;

final class NotionFacadeExampleController extends Controller
{
    /**
     * Példa a Notion facade használatára
     */
    public function exampleWithFacade(): JsonResponse
    {
        // Facade használata - nagyon egyszerű
        $data = [
            'Név' => 'Facade teszt',
            'Email' => 'facade@test.com',
            'Ár' => 250000,
        ];

        $result = NotionFacade::createSimpleEntry($data);

        return response()->json($result);
    }

    /**
     * RequestQuote mentése facade-dal
     */
    public function saveQuoteWithFacade(int $requestQuoteId): JsonResponse
    {
        $requestQuote = RequestQuote::with('websiteType')->findOrFail($requestQuoteId);

        $result = NotionFacade::saveFormQuoteToNotion($requestQuote);

        return response()->json($result);
    }
}
