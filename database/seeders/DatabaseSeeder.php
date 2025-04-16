<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\GuardName;
use App\Enums\OpenAIRole;
use App\Models\Domain;
use App\Models\Form;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\SystemChatParameter;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
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
        Domain::factory(10)->create();

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
            UserAndRolesSeeder::class,
            WebsiteTypeSeeder::class,
            WebsiteLanguageSeeder::class,
            SupportPackSeeder::class,

            RequestQuoteFunctionalitySeeder::class,
            RequestQuoteSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
        ]);
        $guest = User::factory()->create([
            'name' => 'Test User',
            'email' => 'guest@guest.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $guest->assignRole('guest');

        foreach (['view-any', 'view', 'create', 'update', 'delete', 'delete-any', 'replicate', 'restore', 'restore-any', 'reorder', 'force-delete', 'force-delete-any'] as $value) {
            Permission::create(['guard_name' => GuardName::WEB->value, 'name' => $value . ' Role']);
            Permission::create(['guard_name' => GuardName::WEB->value, 'name' => $value . ' Permission']);
        }

        Permission::whereGuardName(GuardName::WEB->value)->get()->each(function ($permission) {
            $permission->assignRole('super-admin');
        });
        Permission::whereGuardName(GuardName::WEB->value)->get()->each(function ($permission) {
            $permission->assignRole('admin');
        });

        Role::findByName('guest')->givePermissionTo([
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
        User::find($superAdmin->id)->assignRole('super-admin');

    }
}
