<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Laravel\Cashier\Cashier;

final class StripeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prices = Cashier::stripe()->prices->all([
            'active' => true,
            'expand' => ['data.product'],
        ]);

        foreach ($prices->data as $price) {
            $product = Product::create([
                'stripe_product_id' => $price->product->default_price,
                'name' => $price->product->name,
                'description' => $price->product->description,
            ]);
            // dump($price);
        }

        // Product::;
        // dump($prices);
    }
}
