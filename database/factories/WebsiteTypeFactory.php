<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\WebsiteType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WebsiteType>
 */
final class WebsiteTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['weboldal', 'webshop', 'landing page']),
        ];
    }
}
