<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\RequestQuoteCreated;
use App\Jobs\SendRequestQuoteToNotion;
use App\Services\NotionService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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

    }
}
