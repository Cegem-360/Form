<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\WebsiteType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RequestQuoteFunctionality>
 */
class RequestQuoteFunctionalityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'price' => $this->faker->numberBetween(100, 1000),
            'website_type_id' => WebsiteType::factory(),
        ];
    }
}
