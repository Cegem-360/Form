<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\OpenAIRole;
use App\Enums\RolesEnum;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Domain;
use App\Models\SystemChatParameter;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        /*
         Domain::factory()->create([
             'name' => 'end-website',
             'url' => 'https://end-website.cegem360.hu/',
         ]);
         */

        // Domain::factory(10)->create();

        // $uxBlocks = Http::withBasicAuth('tothtamas', 'Ttoth2020!')->get('https://end-website.cegem360.hu/wp-json/wp/v2/ux-blocks?per_page=50')
        /*
         foreach ($uxBlocks->json() as $uxBlock) {

            SystemChatParameter::factory()->create([
                'form_field_name' => $uxBlock['title']['rendered'],
                'form_field_id' => $uxBlock['id'],
                'role' => OpenAIRole::SYSTEM,
                'content' => 'Egy WordPress oldalt szerkesztő asszisztens vagy. Egy megadott szöveg alapján egy weboldal új oldalához tartozó tartalmat kell elkészítened.',
            ]);
        }
        */

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
        User::find($superAdmin->id)->assignRole(RolesEnum::SUPER_ADMIN);

    }
}
