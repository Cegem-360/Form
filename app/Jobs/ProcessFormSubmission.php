<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\FormQuestion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProcessFormSubmission implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    protected FormQuestion $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = FormQuestion::find($data);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            dump('Job processing... Form ID:' . $this->data->id);
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.openai.key'),
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Te egy WordPress weboldal tartalomszerkesztő AI vagy.
                                     A feladatod, hogy egy adott cég számára rövid bemutató szöveget írj a megadott adatok alapján.
                                     A bemutató legyen tömör, figyelemfelkeltő és a cég profiljához illő.',
                    ],
                    [
                        'role' => 'user',
                        'content' => "A weboldal fő oldalának bemutatkozó részéhez készíts tartalmat a következő adatok alapján:\n" .
                                     'Cégnév: ' . $this->data->company_name . "\n" .
                                     'Weboldal: ' . $this->data->website . "\n" .
                                     'E-mail: ' . $this->data->email . "\n" .
                                     'Telefon: ' . $this->data->phone,
                    ],
                ],
                'max_tokens' => 4000,
                'temperature' => 1.0,
            ]);

            dump($response->json());

            $wordpress_response = Http::withBasicAuth('tothtamas', 'Ttoth2020!')
                ->post('https://end-website.cegem360.hu/wp-json/wp/v2/pages/2', [
                    'title' => 'Home page test',
                    'content' => $response->json()['choices'][0]['message']['content'],
                    'status' => 'publish',
                ]);

            dump($wordpress_response->getBody()->getContents());
        } catch (\Exception $exception) {
            Log::error('Error processing form submission: ' . $exception->getMessage());
            dump('Error: ' . $exception->getMessage());
        }
    }
}
