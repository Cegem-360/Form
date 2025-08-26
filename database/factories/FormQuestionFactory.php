<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Domain;
use App\Models\FormQuestion;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<FormQuestion>
 */
final class FormQuestionFactory extends Factory
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
            'project_id' => Project::factory(),
            'token' => Str::random(60),
            'company_name' => $this->faker->company(),
            'contact_name' => $this->faker->name(),
            'contact_email' => $this->faker->email(),
            'contact_phone' => $this->faker->phoneNumber(),
            'contact_positsion' => $this->faker->jobTitle(),

        ];
    }
}
