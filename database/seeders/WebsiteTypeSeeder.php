<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\WebsiteType;
use Illuminate\Database\Seeder;

class WebsiteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebsiteType::factory()->create([
            'name' => 'Landing Page',
        ]);
        WebsiteType::factory()->create([
            'name' => 'Webshop',
        ]);
        WebsiteType::factory()->create([
            'name' => 'Weboldal',
        ]);

    }
}
