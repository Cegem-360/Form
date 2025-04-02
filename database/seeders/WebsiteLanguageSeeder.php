<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\WebsiteLanguage;
use Illuminate\Database\Seeder;

class WebsiteLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebsiteLanguage::factory()->create([
            'name' => 'Hungarian',
            'code' => 'hu',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'English',
            'code' => 'en',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'German',
            'code' => 'de',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'French',
            'code' => 'fr',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'Spanish',
            'code' => 'es',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'Italian',
            'code' => 'it',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'Dutch',
            'code' => 'nl',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'Polish',
            'code' => 'pl',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'Czech',
            'code' => 'cs',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'Slovak',
            'code' => 'sk',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'Romanian',
            'code' => 'ro',
        ]);
    }
}
