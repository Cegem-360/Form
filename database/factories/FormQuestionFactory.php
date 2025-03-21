<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Domain;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FormQuestion>
 */
class FormQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'domain_id' => Domain::factory(),
            'token' => Str::random(60),
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'company_name' => $this->faker->company,
            'website' => $this->faker->url,
            'introduction' => $this->faker->text,
            'company_history' => $this->faker->text,
            'company_mission' => $this->faker->text,
            'company_goals' => $this->faker->text,
            'presentation_text' => $this->faker->text,
            'team_introduction' => $this->faker->text,
            'company_values' => $this->faker->text,
        ];
    }
}
