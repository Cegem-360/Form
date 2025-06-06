<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\WebsiteLanguage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WebsiteLanguage>
 */
final class WebsiteLanguageFactory extends Factory
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
            'code' => $this->faker->unique()->word(),
        ];
    }
}
