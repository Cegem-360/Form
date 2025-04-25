<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Model;
use App\Enums\OpenAIRole;
use App\Models\SystemChatParameter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SystemChatParameter>
 */
class SystemChatParameterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Model>
     */
    protected $model = SystemChatParameter::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'form_field_name' => $this->faker->text,
            'form_field_id' => $this->faker->randomNumber(),
            'role' => $this->faker->randomElement(OpenAIRole::cases())->value,
            'content' => $this->faker->sentence,
        ];
    }
}
