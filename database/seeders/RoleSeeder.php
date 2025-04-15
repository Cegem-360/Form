<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\GuardName;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
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

            'project-manager', // quotation module, ?invoice module, ?payment module, Project(s) module, can view all, can edit/view all

            'project-editor', // quotation module, ?invoice module, ?payment module, Project(s) module, can view all, can edit/view own
            'project-viewer', // quotation module, ?invoice module, ?payment module, Project(s) module, can view all, can view own
            'request-quote-user', // Quotation(s)->own module, Invoice(s)->own module, Payment(s)->own module
            'request-quote-admin', // quotation module, ?invoice module, ?payment module,
            'partner', // quotation module, ?invoice module, ?payment module,
            'b2b-user', // quotation module, ?invoice module, ?payment module,

        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role, 'guard_name' => GuardName::WEB->value]);
        }

    }
}
