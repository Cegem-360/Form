<?php

namespace Database\Factories;

use App\Models\ProjectCommission;
use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProjectCommission>
 */
class ProjectCommissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'user_id' => User::factory(),
            'commission_amount' => $this->faker->numberBetween(100, 10000),
            'commission_percent' => $this->faker->numberBetween(1, 100),
            'commission_paid_amount' => $this->faker->numberBetween(0, 1),
        ];
    }
}
