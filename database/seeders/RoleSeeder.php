<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\GuardName;
use App\Enums\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

final class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RolesEnum::cases() as $role) {
            Role::query()->firstOrCreate(['name' => $role->value, 'guard_name' => GuardName::WEB->value]);
        }

    }
}
