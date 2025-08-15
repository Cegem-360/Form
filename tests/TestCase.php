<?php

declare(strict_types=1);

namespace Tests;

use App\Enums\GuardName;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

abstract class TestCase extends BaseTestCase
{
    final public function createAdmin(): User
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'admin']);
        Artisan::call('permissions:sync');
        $permissions = Permission::all();
        $role->syncPermissions($permissions);

        $user->assignRole('admin');

        return $user;
    }

    final public function createGuest(): User
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'guest']);
        $permissions[] = Permission::create(['guard_name' => GuardName::WEB->value, 'name' => 'create User']);
        $permissions[] = Permission::create(['guard_name' => GuardName::WEB->value, 'name' => 'view User']);
        $permissions[] = Permission::create(['guard_name' => GuardName::WEB->value, 'name' => 'view-any User']);
        $permissions[] = Permission::create(['guard_name' => GuardName::WEB->value, 'name' => 'update User']);
        $role->syncPermissions($permissions);

        $user->assignRole('admin');

        return $user;
    }
}
