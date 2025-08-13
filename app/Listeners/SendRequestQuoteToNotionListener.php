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
}
