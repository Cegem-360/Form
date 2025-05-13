<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\WebsiteLanguage;
use Illuminate\Database\Seeder;

final class WebsiteLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebsiteLanguage::factory()->create([
            'name' => 'Magyar',
            'code' => 'hu',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'Angol',
            'code' => 'en',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'Német',
            'code' => 'de',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'Francia',
            'code' => 'fr',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'Spanyol',
            'code' => 'es',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'Olasz',
            'code' => 'it',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'Holland',
            'code' => 'nl',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'Lengyel',
            'code' => 'pl',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'Cseh',
            'code' => 'cs',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'Szlovák',
            'code' => 'sk',
        ]);
        WebsiteLanguage::factory()->create([
            'name' => 'Román',
            'code' => 'ro',
        ]);
    }
}
