<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\WebsiteType;
use App\Models\WebsiteTypePrice;
use Illuminate\Database\Seeder;

final class WebsiteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Weboldal',
            'Webshop',
            'Landing Page',
        ];
        $engines = [
            'laravel',
        ];
        $sizes = [
            'short',
            'medium',
            'large',
        ];
        $prices = [
            'short' => 20000,
            'medium' => 50000,
            'large' => 80000,
        ];
        foreach ($types as $type) {
            $websiteType = WebsiteType::factory()->create([
                'name' => $type,
            ]);

            foreach ($engines as $engine) {
                foreach ($sizes as $size) {

                    WebsiteTypePrice::factory()->create([
                        'website_type_id' => $websiteType->id,
                        'website_engine' => $engine,
                        'size' => $size,
                        'price' => $prices[$size],
                    ]);

                }
            }
        }

    }
}
