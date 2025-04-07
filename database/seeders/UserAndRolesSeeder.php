<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class UserAndRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            /* PermissionSeeder::class,
            UserRoleSeeder::class,
            UserPermissionSeeder::class,
            UserRolePermissionSeeder::class, */

        ]);

        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Admin user create and dumy normal filament user but not admin and user for only project,

        User::factory()->create([
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'email' => 'admin@admin.com',
            'email_verified_at' => Carbon::now(),
        ]);

        Artisan::call('permissions:sync');
    }
}
