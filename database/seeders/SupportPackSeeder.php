<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\SupportPack;
use Illuminate\Database\Seeder;

final class SupportPackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SupportPack::factory()->create([
            'name' => 'Basic',
        ]);
        SupportPack::factory()->create([
            'name' => 'Standard',
        ]);
        SupportPack::factory()->create([
            'name' => 'Premium',
        ]);
    }
}
