<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\OpenAIRole;
use App\Models\Domain;
use App\Models\Form;
use App\Models\SystemChatParameter;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Artisan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        // Form::factory(20)->create();
        Domain::factory()->create([
            'name' => 'end-website',
            'url' => 'https://end-website.cegem360.hu/',
        ]);
        Domain::factory(10)->create();

        $uxBlocks = Http::withBasicAuth('tothtamas', 'Ttoth2020!')->get('https://end-website.cegem360.hu/wp-json/wp/v2/ux-blocks?per_page=50');

        foreach ($uxBlocks->json() as $uxBlock) {

            SystemChatParameter::factory()->create([
                'form_field_name' => $uxBlock['title']['rendered'],
                'form_field_id' => $uxBlock['id'],
                'role' => OpenAIRole::SYSTEM,
                'content' => 'Egy WordPress oldalt szerkesztő asszisztens vagy. Egy megadott szöveg alapján egy weboldal új oldalához tartozó tartalmat kell elkészítened.',
            ]);
        }

        Artisan::call('permissions:sync');

    }
}
