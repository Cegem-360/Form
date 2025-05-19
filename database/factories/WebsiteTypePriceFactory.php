<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\WebsiteTypePrice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WebsiteTypePrice>
 */
final class WebsiteTypePriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'website_engine' => $this->faker->randomElement(['wordpress', 'shopify', 'laravel']),
            'size' => $this->faker->randomElement(['small', 'medium', 'large']),
            'price' => $this->faker->numberBetween(20000, 100000),
        ];
    }
}
