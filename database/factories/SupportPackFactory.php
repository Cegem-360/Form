<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SupportPack;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SupportPack>
 */
final class SupportPackFactory extends Factory
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
            'description' => $this->faker->sentence(),
            'price' => $this->faker->numberBetween(5000, 10000),
        ];
    }
}
