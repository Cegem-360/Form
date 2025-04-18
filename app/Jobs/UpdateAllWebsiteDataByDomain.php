<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Enums\OpenAIRole;
use App\Models\Domain;
use App\Models\FormQuestion;
use App\Models\SystemChatParameter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class UpdateAllWebsiteDataByDomain implements ShouldQueue
{
    use Queueable;

    private Domain $domain;

    private FormQuestion $form;

    private ?array $fieldIds;

    /**
     * Create a new job instance.
     */
    public function __construct($id, $fieldIds = null)
    {
        $this->fieldIds = $fieldIds;
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

        $systemChatParameters = SystemChatParameter::when($this->fieldIds, function ($query) {
            return $query->whereIn('form_field_id', $this->fieldIds);
        })->get();

        foreach ($systemChatParameters as $systemChatPrameter) {

            $content = $this->sendRequestToOpenAI($systemChatPrameter->form_field_name);
            dump('Form field name: ' . $systemChatPrameter->form_field_name);
            dump('Http request: ' . $this->domain->url . 'wp-json/wp/v2/ux-blocks/' . $systemChatPrameter->form_field_id);
            Http::withBasicAuth('tothtamas', 'Ttoth2020!')->post($this->domain->url . 'wp-json/wp/v2/ux-blocks/' . $systemChatPrameter->form_field_name, [
                // 'id' => $systemChatPrameter->form_field_id, // not null
                // 'title' => $systemChatPrameter->form_field_name, // not null
                'content' => $content, // not null
            ]);
        }

    }

    public function sendRequestToOpenAI(string $formFieldName): string
    {
        $content = '';

        $content = match ($formFieldName) {
            '01-fooldal-01-hero-cimsor' => $this->handleHeroBannerTitle(),
            '01-fooldal-01-hero-leiras' => $this->handleHeroBannerText(),
            '01-fooldal-03-rolunk-szoveg' => $this->handleAboutUsText(),
            '01-fooldal-04-kiemelt-szolgaltatasaink-szoveg' => $this->handleHighlightedServicesText(),
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

    public function handleHeroBannerTitle(): string
    {
        $activities = '';
        $about = '';
        $context = '';
        foreach ($this->form->main_pages as $value) {
            if ($value['name'] == 'Szolgáltatásaink') {
                foreach ($this->form->activities as $activity) {
                    $activities .= $activity['name'] . ', ';
                }
            }
            if ($value['name'] == 'Rólunk') {
                $about = $value['description'];
            }

        }
        $context .= 'A következő szövegekből írj egy ütős címet. A cég szolgáltatásai: ' . $activities . ' A cég bemutatkozása: ' . $about;
        $context .= ' A cím legyen figyelemfelkeltő és inspiráló, hogy a látogatók érdeklődését felkeltse.';

        return $context;
    }

    public function handleHeroBannerText(): string
    {
        $activities = '';
        $about = '';
        $context = '';
        foreach ($this->form->main_pages as $value) {
            if ($value['name'] == 'Szolgáltatásaink') {
                foreach ($this->form->activities as $activity) {
                    $activities .= $activity['name'] . ', ';
                }
            }
            if ($value['name'] == 'Rólunk') {
                $about = $value['description'];
            }

        }

        $context .= 'A következő szövegekből írj egy rövid 2 mondatból álló szöveget, ami a inspiráló értékesítési szöveg legyen. A cég szolgáltatásai: ' . $activities . ' A cég bemutatkozása: ' . $about;
        $context .= ' A szöveg legyen figyelemfelkeltő és inspiráló, hogy a látogatók érdeklődését felkeltse.';

        return $context;
    }

    public function handleAboutUsText(): string
    {
        $activities = '';
        $about = '';
        $context = '';
        foreach ($this->form->main_pages as $value) {
            if ($value['name'] == 'Szolgáltatásaink') {
                foreach ($this->form->activities as $activity) {
                    $activities .= $activity['name'] . ', ';
                }
            }
            if ($value['name'] == 'Rólunk') {
                $about = $value['description'];
            }

        }

        $context .= 'A következő szövegekből írj egy 3 szakaszból álló maximum 10-15 mondatos szöveget, ami a céget bemutatja "Rólunk". A cég szolgáltatásai: ' . $activities . ' A cég bemutatkozása: ' . $about;
        $context .= ' A szöveg legyen határozott. ';

        return $context;
    }

    public function handleHighlightedServicesText(): string
    {
        $activities = '';
        $about = '';
        $context = '';
        foreach ($this->form->main_pages as $value) {
            if ($value['name'] == 'Szolgáltatásaink') {
                foreach ($this->form->activities as $activity) {
                    $activities .= $activity['name'] . ', ';
                }
            }
        }

        $context .= 'A következő szövegekből írj egy 2 szakaszból álló maximum 10-15 mondatos szöveget, ami a céget bemutatja "Szolgáltatásaink". A cég szolgáltatásai: ' . $activities . ' A cég bemutatkozása: ' . $about;
        $context .= ' A szöveg legyen határozott. ';

        return $context;
    }
}
