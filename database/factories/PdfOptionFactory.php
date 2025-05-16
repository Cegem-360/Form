<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\RequestQuoteFunctionality;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\PdfOptions>
 */
final class PdfOptionFactory extends Factory
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
            'frontend_description' => $this->faker->randomHtml(),
            'backend_description' => $this->faker->randomHtml(),
            'default_functions' => [
                'function1' => RequestQuoteFunctionality::all()->random()->boolean(),
                'function2' => RequestQuoteFunctionality::all()->random()->boolean(),
                'function3' => RequestQuoteFunctionality::all()->random()->boolean(),
            ],
        ];
    }
}
