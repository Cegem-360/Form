<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\RequestQuote;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class RequestQuoteCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public RequestQuote $requestQuote
    ) {}
}
