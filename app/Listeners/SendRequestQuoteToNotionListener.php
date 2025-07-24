<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\RequestQuoteCreated;
use App\Jobs\SendRequestQuoteToNotion;
use App\Services\NotionService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

final class SendRequestQuoteToNotionListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct(
        private NotionService $notionService
    ) {}

    /**
     * Handle the event.
     */
    public function handle(RequestQuoteCreated $event): void
    {
        // Háttérben küldi el (aszinkron)
        SendRequestQuoteToNotion::dispatch($event->requestQuote);

        // VAGY szinkron küldés:
        // $this->sendToNotionSync($event->requestQuote);
    }

    /**
     * Szinkron küldés
     */
    private function sendToNotionSync($requestQuote): void
    {
        try {
            $requestQuote->load('websiteType', 'requestQuoteFunctionalities');

            $result = $this->notionService->saveFormQuoteToNotion($requestQuote);

            if ($result['success']) {
                Log::info('RequestQuote sikeresen elküldve Notion-ba (event)', [
                    'request_quote_id' => $requestQuote->id,
                    'notion_page_id' => $result['page_id'],
                ]);
            } else {
                Log::error('RequestQuote küldése sikertelen Notion-ba (event)', [
                    'request_quote_id' => $requestQuote->id,
                    'error' => $result['error'],
                ]);
            }
        } catch (Exception $e) {
            Log::error('Hiba a RequestQuote Notion küldésekor (event)', [
                'request_quote_id' => $requestQuote->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
