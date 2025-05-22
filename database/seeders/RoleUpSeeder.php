<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

final class RoleUpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::findByName(RolesEnum::GUEST->value)->givePermissionTo([
            'update User',
            'delete User',
            'view-any RequestQuote',
            'view RequestQuote',
            'create RequestQuote',
        ]);

        Role::findByName(RolesEnum::USER->value)->givePermissionTo([
            'update User',
            'delete User',
            'view-any RequestQuote',
            'view RequestQuote',
            'create RequestQuote',
            'view-any Order',
            'view Order',
            'view-any FormQuestion',
            'view FormQuestion',
        ]);

        Role::findByName(RolesEnum::RESELLER->value)->givePermissionTo([
            'update User',
            'delete User',
            'view-any RequestQuote',
            'view RequestQuote',
            'create RequestQuote',
            'view-any Order',
            'view Order',
            'view-any Project',
            'view Project',
            'view-any ProjectCommission',
            'view ProjectCommission',
        ]);
    }
}
