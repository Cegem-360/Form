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

        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Advanced form',
            'price' => 50000,
            'website_type_id' => $websiteTypes->random()->id,
        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Simple apointment form',
            'price' => 60000,
            'website_type_id' => $websiteTypes->random()->id,
        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Advanced apointment form',
            'price' => 120000,
            'website_type_id' => $websiteTypes->random()->id,
        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Newsletter form',
            'price' => 50000,
            'website_type_id' => $websiteTypes->random()->id,
        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Popup',
            'price' => 30000,
            'website_type_id' => $websiteTypes->random()->id,
        ]);
    }
}
