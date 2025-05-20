<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;

final class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Option::create([
            'name' => 'request_quote',
            'options' => [
                [
                    'key' => 'language_percent',
                    'value' => 0.35,
                ],
            ],

        ]);
    }
}
