<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\RequestQuote;
use App\Services\NotionService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

final class SendRequestQuoteToNotion implements ShouldQueue
{
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * The number of times the job may be attempted.
     */
    public int $tries = 3;

    /**
     * The maximum number of seconds the job can run.
     */
    public int $timeout = 60;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public RequestQuote $requestQuote
    ) {}

    /**
     * Execute the job.
     */
    public function handle(NotionService $notionService): void
    {
        try {

            $result = $notionService->saveFormQuoteToNotion($this->requestQuote);

            if ($result['success']) {
                Log::info('RequestQuote sikeresen elküldve Notion-ba (aszinkron)', [
                    'request_quote_id' => $this->requestQuote->id,
                    'notion_page_id' => $result['page_id'],
                    'job_id' => $this->job->uuid(),
                ]);
            } else {
                Log::error('RequestQuote küldése sikertelen Notion-ba (aszinkron)', [
                    'request_quote_id' => $this->requestQuote->id,
                    'error' => $result['error'],
                    'job_id' => $this->job->uuid(),
                ]);

                // Újrapróbálkozás
                $this->fail($result['error']);
            }
        } catch (Exception $exception) {
            Log::error('Hiba a RequestQuote Notion küldésekor (aszinkron)', [
                'request_quote_id' => $this->requestQuote->id,
                'error' => $exception->getMessage(),
                'job_id' => $this->job->uuid(),
            ]);

            // Újrapróbálkozás
            $this->fail($exception);
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(Throwable $exception): void
    {
        Log::error('SendRequestQuoteToNotion job véglegesen sikertelen', [
            'request_quote_id' => $this->requestQuote->id,
            'error' => $exception->getMessage(),
            'attempts' => $this->attempts(),
        ]);
    }
}
