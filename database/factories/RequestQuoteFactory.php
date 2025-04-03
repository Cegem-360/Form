<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\RequestQuote;
use App\Models\WebsiteType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RequestQuote>
 */
class RequestQuoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = RequestQuote::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $website_length = $this->faker->randomElement(['short', 'medium', 'long']);

        $websites = [];
        foreach ($this->faker->words(3) as $word) {
            $websites[] = [
                'name' => $word,
                'length' => $this->faker->randomElement(['short', 'medium', 'long']),
            ];
        }

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'company_name' => $this->faker->company(),
            'website_type_id' => WebsiteType::factory(),
            'website_engine' => $this->faker->word(),
            'websites' => $websites,
            'have_website_graphic' => $this->faker->boolean(),
            'is_multilangual' => $this->faker->boolean(),
            'languages' => [$this->faker->word()],
            'is_ecommerce' => $this->faker->boolean(),
            'ecommerce_functionalities' => [$this->faker->word()],
        ];
    }
}
