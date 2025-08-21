<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\RequestQuote;
use App\Services\NotionService;
use Exception;
use Illuminate\Support\Facades\Auth;
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
        $websites = $requestQuote->websites;
        if (! is_null($websites)) {
            $remove_keys = [];
            foreach ($websites as $key => $website) {
                if (isset($website['required']) && $website['required'] === false) {
                    $remove_keys[] = $key;
                }
            }

            foreach ($remove_keys as $key) {
                unset($websites[$key]);
            }
        }

        $updateData = ['websites' => $websites];

        if (Auth::check()) {
            $user = Auth::user();
            $updateData = array_merge($updateData, [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'client_type' => $user->client_type ?? null,
                'company_name' => $user->company_name ?? null,
                'company_address' => $user->company_address ?? null,
                'website_type_id' => $user->website_type_id ?? null,
            ]);
        }

        $requestQuote->update($updateData);

        $this->sendToNotionSync($requestQuote);

    }

    /**
     * Handle the RequestQuote "updated" event.
     */
    public function updated(RequestQuote $requestQuote): void
    {

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
    public function forceDeleted(): void
    {
        //
    }

    /**
     * Szinkron küldés Notion-ba
     */
    private function sendToNotionSync(RequestQuote $requestQuote): void
    {
        try {

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
        } catch (Exception $exception) {
            Log::error('Hiba a RequestQuote Notion küldésekor', [
                'request_quote_id' => $requestQuote->id,
                'error' => $exception->getMessage(),
            ]);
        }
    }
}
