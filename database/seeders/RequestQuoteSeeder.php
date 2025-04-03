<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\RequestQuote;
use Illuminate\Database\Seeder;

class RequestQuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RequestQuote::factory()->count(100)->create();
    }
}
