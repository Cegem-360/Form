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
        $roles = [
            'super-admin', // all modules

            'admin', // all modules, but not all permissions like a Boss

            'guest', // Quotation(s)->own module(edit only status),  Normal register but not ordered yet (can send and then cant edit) no project

            'user', // Quotation(s)->own module, Invoice(s)->own module, Payment(s)->own module, Project->own

        ];

        foreach (RolesEnum::cases() as $role) {
            Role::firstOrCreate(['name' => $role->value, 'guard_name' => GuardName::WEB->value]);
        }

    }
}
