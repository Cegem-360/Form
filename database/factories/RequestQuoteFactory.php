<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\WebsiteType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RequestQuote>
 */
class RequestQuoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'company_name' => $this->faker->company(),
            'website_type_id' => WebsiteType::factory(),
            'website_engine' => $this->faker->word(),
            'websites' => json_encode([$this->faker->word()]),
            'have_website_graphic' => $this->faker->boolean(),
            'is_multilangual' => $this->faker->boolean(),
            'languages' => json_encode([$this->faker->word()]),
            'functionalities' => json_encode([$this->faker->word()]),
            'is_ecommerce' => $this->faker->boolean(),
            'ecommerce_functionalities' => json_encode([$this->faker->word()]),
        ];
    }
}
