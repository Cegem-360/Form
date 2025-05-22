<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\GuardName;
use App\Enums\PermissionsEnum;
use App\Enums\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

final class PermissionUpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (PermissionsEnum::cases() as $case) {
            $value = $case->value;
            Permission::create(['guard_name' => GuardName::WEB->value, 'name' => $value.' Role']);
            Permission::create(['guard_name' => GuardName::WEB->value, 'name' => $value.' Permission']);
        }

        Permission::whereGuardName(GuardName::WEB->value)->get()->each(function ($permission): void {
            $permission->assignRole([RolesEnum::SUPER_ADMIN, RolesEnum::ADMIN]);
        });
    }
}
