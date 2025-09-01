<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\RolesEnum;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RoleSeeder::class,
            UserAndRolesSeeder::class,
            WebsiteTypeSeeder::class,
            WebsiteLanguageSeeder::class,
            SupportPackSeeder::class,
            RequestQuoteFunctionalitySeeder::class,
            RequestQuoteSeeder::class,
            OrderSeeder::class,
            OptionSeeder::class,
            PdfOptionSeeder::class,
            PermissionUpSeeder::class,
            RoleUpSeeder::class,
        ]);

        $guest = User::factory()->create([
            'name' => 'Test User',
            'email' => 'guest@guest.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $guest->assignRole(RolesEnum::GUEST);

        $superAdmin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
        ]);
        User::query()->find($superAdmin->id)->assignRole(RolesEnum::SUPER_ADMIN);

    }
}
