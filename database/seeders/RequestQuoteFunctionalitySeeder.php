<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\RequestQuoteFunctionality;
use Illuminate\Database\Seeder;

class RequestQuoteFunctionalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // RequestQuoteFunctionality::factory()->count(10)->create();
        RequestQuoteFunctionality::create([
            'name' => 'Contact form',
            'price' => 30000,
        ]);
        RequestQuoteFunctionality::create([
            'name' => 'Advanced form',
            'price' => 50000,
        ]);
        RequestQuoteFunctionality::create([
            'name' => 'Simple apointment form',
            'price' => 60000,
        ]);
        RequestQuoteFunctionality::create([
            'name' => 'Advanced apointment form',
            'price' => 120000,
        ]);
        RequestQuoteFunctionality::create([
            'name' => 'Newsletter form',
            'price' => 50000,
        ]);
        RequestQuoteFunctionality::create([
            'name' => 'Popup',
            'price' => 30000,
        ]);
    }
}
