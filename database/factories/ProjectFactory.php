<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<Project>
 */
final class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Model>
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'contact' => User::factory(),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,

            'status' => $this->faker->randomElement(ProjectStatus::class),
            'project_goal' => $this->faker->sentence,

            // 2.
            'original_project_goals' => $this->faker->paragraph,
            'completed_project_elements' => $this->faker->numberBetween(0, 100),
            'project_not_contained_elements' => $this->faker->numberBetween(0, 100),

            // 3.
            'completed_elements' => $this->faker->numberBetween(0, 100),
            'solved_problems' => $this->faker->numberBetween(0, 50),

            // 4.
            'garanty' => $this->faker->boolean,
            'support_pack_id' => $this->faker->randomDigitNotNull,
            'contact_channel_id' => $this->faker->randomDigitNotNull,

            'created_by' => $this->faker->randomDigitNotNull, // user_id
            'updated_by' => $this->faker->randomDigitNotNull, // user_id

        ];
    }
}
