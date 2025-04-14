<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class UserAndRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,

        ]);
        Artisan::call('permissions:sync');

        User::factory(10)->create();

        // Admin user create and dumy normal filament user but not admin and user for only project,

    }
}
