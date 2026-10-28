<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\StripeCurrency;
use App\Enums\TransactionStatus;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
final class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->numberBetween(1000, 1000000),
            'currency' => StripeCurrency::HUF,
            'status' => TransactionStatus::PENDING,
        ];
    }
}
