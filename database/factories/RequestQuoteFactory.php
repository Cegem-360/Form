<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ClientType;
use App\Models\RequestQuote;
use App\Models\User;
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
                'required' => $this->faker->boolean(),
                'length' => $this->faker->randomElement(['short', 'medium', 'long']),
                'description' => $this->faker->randomHtml(),
            ];
        }

        return [
            'user_id' => User::factory(),
            'quotation_name' => $this->faker->name(),
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'client_type' => $this->faker->randomElement(array_column(ClientType::cases(), 'value')),
            'company_name' => $this->faker->company(),
            'company_address' => $this->faker->address(),
            'company_vat_number' => $this->faker->word(),
            'company_contact_name' => $this->faker->name(),
            'project_description' => $this->faker->randomHtml(),
            // website type
            'website_type_id' => WebsiteType::factory(),
            'website_engine' => $this->faker->randomElement(['wordpress', 'shopify', 'laravel']),
            'websites' => $websites,
            'have_website_graphic' => $this->faker->boolean(),
            'is_multilangual' => $this->faker->boolean(),
            'languages' => [$this->faker->word()],
        ];
    }
}
