<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Form;
use App\Models\User;
use App\Models\Domain;
use App\Enums\GuardName;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\RolesEnum;
use App\Enums\OpenAIRole;
use App\Enums\PermissionsEnum;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\SystemChatParameter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Permission;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Form::factory(20)->create();
        Domain::factory()->create([
            'name' => 'end-website',
            'url' => 'https://end-website.cegem360.hu/',
        ]);
        // Domain::factory(10)->create();

        $uxBlocks = Http::withBasicAuth('tothtamas', 'Ttoth2020!')->get('https://end-website.cegem360.hu/wp-json/wp/v2/ux-blocks?per_page=50');

        foreach ($uxBlocks->json() as $uxBlock) {

            SystemChatParameter::factory()->create([
                'form_field_name' => $uxBlock['title']['rendered'],
                'form_field_id' => $uxBlock['id'],
                'role' => OpenAIRole::SYSTEM,
                'content' => 'Egy WordPress oldalt szerkesztő asszisztens vagy. Egy megadott szöveg alapján egy weboldal új oldalához tartozó tartalmat kell elkészítened.',
            ]);
        }

        $this->call([
            RoleSeeder::class,
            UserAndRolesSeeder::class,
            WebsiteTypeSeeder::class,
            WebsiteLanguageSeeder::class,
            SupportPackSeeder::class,
            StripeSeeder::class,
            RequestQuoteFunctionalitySeeder::class,
            RequestQuoteSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            OptionSeeder::class,
            PdfOptionSeeder::class,
        ]);
        $guest = User::factory()->create([
            'name' => 'Test User',
            'email' => 'guest@guest.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $guest->assignRole(RolesEnum::GUEST);

        foreach ([PermissionsEnum::VIEW_ANY->value, PermissionsEnum::VIEW->value, PermissionsEnum::CREATE->value, PermissionsEnum::UPDATE->value, PermissionsEnum::DELETE->value, PermissionsEnum::DELETE_ANY->value, PermissionsEnum::REPLICATE->value, PermissionsEnum::RESTORE->value, PermissionsEnum::RESTORE_ANY->value, PermissionsEnum::REORDER->value, PermissionsEnum::FORCE_DELETE->value, PermissionsEnum::FORCE_DELETE_ANY->value] as $value) {
            Permission::create(['guard_name' => GuardName::WEB->value, 'name' => $value.' Role']);
            Permission::create(['guard_name' => GuardName::WEB->value, 'name' => $value.' Permission']);
        }

        Permission::whereGuardName(GuardName::WEB->value)->get()->each(function ($permission): void {
            $permission->assignRole(RolesEnum::SUPER_ADMIN);
        });
        Permission::whereGuardName(GuardName::WEB->value)->get()->each(function ($permission): void {
            $permission->assignRole(RolesEnum::ADMIN);
        });

        Role::findByName(RolesEnum::GUEST->value)->givePermissionTo([
            'update User',
            'delete User',
            'view-any RequestQuote',
            'view RequestQuote',
            'create RequestQuote',
        ]);

        Role::findByName(RolesEnum::GUEST->value)->givePermissionTo([
            'update User',
            'delete User',
            'view-any RequestQuote',
            'view RequestQuote',
            'create RequestQuote',
        ]);

        $superAdmin = User::factory()->create([
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'email' => 'admin@admin.com',
            'email_verified_at' => Carbon::now(),
        ]);
        User::find($superAdmin->id)->assignRole(RolesEnum::SUPER_ADMIN);

    }
}
