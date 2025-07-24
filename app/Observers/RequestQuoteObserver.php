<?php

declare(strict_types=1);

namespace App\Observers;

use App\Jobs\SendRequestQuoteToNotion;
use App\Models\RequestQuote;
use App\Services\NotionService;
use Exception;
use Illuminate\Support\Facades\Log;

final class RequestQuoteObserver
{
    public function __construct(
        private NotionService $notionService
    ) {}

    /**
     * Handle the RequestQuote "created" event.
     */
    public function created(RequestQuote $requestQuote): void
    {
        // Azonnali küldés (szinkron)
        $this->sendToNotionSync($requestQuote);

        // VAGY háttérben küldés (aszinkron) - kommenteld ki a felső sort és használd ezt:
        // SendRequestQuoteToNotion::dispatch($requestQuote);
    }

    /**
     * Handle the RequestQuote "updated" event.
     */
    public function updated(RequestQuote $requestQuote): void
    {
        // Opcionálisan frissíthetjük a Notion-ban is
        // Ha fontos mezők változtak (pl. státusz, ár, stb.)
        if ($requestQuote->wasChanged(['name', 'email', 'phone', 'payment_method', 'is_payed'])) {
            $this->sendToNotionSync($requestQuote);
        }
    }

    /**
     * Handle the RequestQuote "deleted" event.
     */
    public function deleted(RequestQuote $requestQuote): void
    {
        // Opcionálisan jelölhetjük töröltként a Notion-ban is
        Log::info('RequestQuote törölve', ['id' => $requestQuote->id]);
    }

    /**
     * Handle the RequestQuote "restored" event.
     */
    public function restored(RequestQuote $requestQuote): void
    {
        // Ha visszaállítjuk, küldjük újra Notion-ba
        $this->sendToNotionSync($requestQuote);
    }

    /**
     * Handle the RequestQuote "force deleted" event.
     */
    public function forceDeleted(RequestQuote $requestQuote): void
    {
        //
    }

    /**
     * Szinkron küldés Notion-ba
     */
    private function sendToNotionSync(RequestQuote $requestQuote): void
    {
        try {
            // Betöltjük a kapcsolódó adatokat
            $requestQuote->load('websiteType', 'requestQuoteFunctionalities');

            $result = $this->notionService->saveFormQuoteToNotion($requestQuote);

            if ($result['success']) {
                Log::info('RequestQuote sikeresen elküldve Notion-ba', [
                    'request_quote_id' => $requestQuote->id,
                    'notion_page_id' => $result['page_id'],
                ]);
            } else {
                Log::error('RequestQuote küldése sikertelen Notion-ba', [
                    'request_quote_id' => $requestQuote->id,
                    'error' => $result['error'],
                ]);
            }
        } catch (Exception $e) {
            Log::error('Hiba a RequestQuote Notion küldésekor', [
                'request_quote_id' => $requestQuote->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
