<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\WebsiteType;
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
        $websiteEngine = $this->faker->randomElement(['laravel']);
        $websiteType = WebsiteType::all()->random();

        return [
            'website_engine' => $websiteEngine,
            'website_type_id' => $websiteType->id,
            'frontend_description' => $this->faker->randomHtml(),
            'backend_description' => $this->faker->randomHtml(),
        ];
    }
}
