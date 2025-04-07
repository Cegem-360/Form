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
            'admin',
            'guest',
            'super-admin',
            'project-manager',
            'project-editor',
            'project-viewer',
            'request-quote-user',
            'request-quote-admin',
            'partner',
            'b2b-user',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role, 'guard_name' => GuardName::WEB->value]);
        }
    }
}
