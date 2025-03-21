<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Enums\OpenAIRole;
use App\Models\Domain;
use App\Models\FormQuestion;
use App\Models\SystemChatParameter;
use Http;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateAllWebsiteDataByDomain implements ShouldQueue
{
    use Queueable;

    private Domain $domain;

    private FormQuestion $form;

    /**
     * Create a new job instance.
     */
    public function __construct($id)
    {
        $this->domain = Domain::find($id);
        $this->form = FormQuestion::whereDomainId($id)->first();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Update website data by domain at the wordpress site like https://
        // for test purposes, we will use the Http facade to send a POST request to the domain's URL (test domain "http://end-website.cegem360.hu/wp-json/wp/v2/posts")
        foreach (SystemChatParameter::all() as $systemChatPrameter) {

            $content = $this->sendRequestToOpenAI($systemChatPrameter->form_field_name);

            Http::withBasicAuth('tothtamas', 'Ttoth2020!')->post($this->domain->url . 'wp-json/wp/v2/us-blocks', [
                'id' => $systemChatPrameter->form_field_id, // not null
                'title' => $systemChatPrameter->form_field_name, // not null
                'content' => $content, // not null
            ]);
        }

    }

    public function sendRequestToOpenAI(string $formFieldName): string
    {
        $content = '';

        $content = match ($formFieldName) {
            '01-fooldal-01-hero-cimsor' => 'Cimsor ' . $this->form->company_name,
            'Weboldal' => $this->form->website,
            'E-mail' => $this->form->email,
            'Telefon' => $this->form->phone,
            default => $content,
        };

        $system = SystemChatParameter::whereFormFieldName($formFieldName)->whereRole(OpenAIRole::SYSTEM)->first();

        // Send request to OpenAI API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openai.key'),
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o',
            'messages' => [
                [
                    'role' => OpenAIRole::SYSTEM->value,
                    'content' => $system?->content,
                ],
                [
                    'role' => OpenAIRole::USER->value,
                    'content' => $content,

                ],
            ],
            'max_tokens' => 4000,
            'temperature' => 1.0,
        ]);

        return $response->json()['choices'][0]['message']['content'];
    }
}
