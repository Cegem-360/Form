<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ClientType;
use App\Models\RequestQuote;
use App\Models\User;
use App\Models\WebsiteLanguage;
use App\Models\WebsiteType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<RequestQuote>
 */
final class RequestQuoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Model>
     */
    protected $model = RequestQuote::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $websites = [];
        foreach ($this->faker->words(3) as $word) {
            $websites[] = [
                'name' => $word,
                'required' => $this->faker->boolean(),
                'length' => $this->faker->randomElement(['short', 'medium', 'large']),
                'description' => $this->faker->randomHtml(),
                'images' => null,
            ];
        }

        $website_type_id = WebsiteType::firstOrCreate([
            'name' => $this->faker->randomElement(['weboldal', 'webshop', 'landing page']),
        ])->id;

        // Biztosítsuk, hogy legalább 3 nyelv legyen
        if (WebsiteLanguage::count() < 3) {
            WebsiteLanguage::factory()->count(3 - WebsiteLanguage::count())->create();
        }

        $languages = [];
        $default_language = WebsiteLanguage::all()->random(1)->first();
        $otherLanguages = WebsiteLanguage::where('id', '!=', $default_language->id)->get();
        if ($otherLanguages->count() < 2) {
            foreach ($otherLanguages as $language) {
                $languages[] = $language->name;
            }
        } else {
            foreach ($otherLanguages->random(2) as $language) {
                $languages[] = $language->name;
            }
        }

        return [
            'user_id' => User::factory(),
            'quotation_name' => $this->faker->name(),
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'client_type' => $this->faker->randomElement(array_column(ClientType::cases(), 'value')),
            'billing_address' => $this->faker->address(),
            'company_name' => $this->faker->company(),
            'company_address' => $this->faker->address(),
            'project_description' => $this->faker->randomHtml(),
            // website type
            'website_type_id' => $website_type_id,
            'website_engine' => $this->faker->randomElement(['wordpress', 'shopify', 'laravel']),
            'websites' => $websites,
            'have_website_graphic' => $this->faker->boolean(),
            'is_multilangual' => $this->faker->boolean(),
            'default_language' => $default_language->id,
            'languages' => $languages,
            'payment_method' => $this->faker->randomElement(['stripe',  'bank_transfer']),
            'is_payed' => $this->faker->boolean(),
        ];
    }
}
