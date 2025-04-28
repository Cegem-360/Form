<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\RequestQuoteFunctionality;
use App\Models\WebsiteType;
use Illuminate\Database\Seeder;

class RequestQuoteFunctionalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // RequestQuoteFunctionality::factory()->count(10)->create();

        $websiteTypes = WebsiteType::all();
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Contact form',
            'price' => 30000,
            'website_type_id' => $websiteTypes->random()->id,
            'description' => 'A simple contact form that allows users to send messages directly from the website.',

        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Advanced form',
            'price' => 50000,
            'website_type_id' => $websiteTypes->random()->id,
            'description' => 'An advanced form with additional fields and validation options.',
        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Simple apointment form',
            'price' => 60000,
            'website_type_id' => $websiteTypes->random()->id,
            'description' => 'A simple appointment form that allows users to book appointments directly from the website.',
        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Advanced apointment form',
            'price' => 120000,
            'website_type_id' => $websiteTypes->random()->id,
            'description' => 'An advanced appointment form with additional fields and validation options.',
        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Newsletter form',
            'price' => 50000,
            'website_type_id' => $websiteTypes->random()->id,
            'description' => 'A newsletter form that allows users to subscribe to newsletters directly from the website.',
        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Popup',
            'price' => 30000,
            'website_type_id' => $websiteTypes->random()->id,
            'description' => 'A popup that appears on the website to capture user attention.',
        ]);
    }
}
