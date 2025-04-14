<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\RequestQuote;
use App\Models\WebsiteType;
use Illuminate\Database\Seeder;

class RequestQuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $websiteTypes = WebsiteType::all();
        RequestQuote::factory()->count(100)->create([
            'user_id' => null,
            'website_type_id' => $websiteTypes->random()->id,
        ]);
    }
}
