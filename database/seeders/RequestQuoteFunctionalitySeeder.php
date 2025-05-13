<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\RequestQuoteFunctionality;
use App\Models\WebsiteType;
use Illuminate\Database\Seeder;

final class RequestQuoteFunctionalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // RequestQuoteFunctionality::factory()->count(10)->create();

        $websiteTypes = WebsiteType::all();
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Kapcsolati űrlap',
            'price' => 30000,
            'website_type_id' => $websiteTypes->random()->id,
            'description' => 'Egy egyszerű webes űrlap, amelyen keresztül a látogatók közvetlenül üzenetet küldhetnek Önnek az oldalon keresztül, anélkül, hogy el kellene hagyniuk azt.',

        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Árajánlatkérő űrla',
            'price' => 50000,
            'website_type_id' => $websiteTypes->random()->id,
            'description' => 'Lehetővé teszi az érdeklődők számára, hogy specifikus termékekre vagy szolgáltatásokra kérjenek részletes árajánlatot, rögzítve az összes szükséges információt',
        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Probléma bejelentő űrlap',
            'price' => 40000,
            'website_type_id' => $websiteTypes->random()->id,
            'description' => 'Lehetővé teszi a felhasználók számára, hogy technikai vagy egyéb problémákat jelentsenek be az oldalon keresztül, részletes információk megadásával.',
        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Hírlevél feliratkozás',
            'price' => 60000,
            'website_type_id' => $websiteTypes->random()->id,
            'description' => 'Egy beépített funkció, amellyel a látogatók feliratkozhatnak az Ön e-mail listájára, hogy értesüljenek híreiről, akcióiról vagy újdonságairól.',
        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Pop-up ablak',
            'price' => 120000,
            'website_type_id' => $websiteTypes->random()->id,
            'description' => 'Egy felugró felület, amely automatikusan megjelenik a látogatóknak bizonyos feltételek teljesülésekor (pl. oldalra érkezéskor, kilépés előtt), figyelemfelkeltő üzenetek vagy ajánlatok megjelenítésére.',
        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Árajánlatkérő rendszer',
            'price' => 50000,
            'website_type_id' => $websiteTypes->random()->id,
            'description' => 'Ez a modul egy összetettebb, testreszabható felületet biztosít a weboldalon, ahol a felhasználók több paraméter alapján, részletesebben tudnak árajánlatot összeállítani és beküldeni az Ön termékeihez vagy szolgáltatásaihoz.',
        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Chat',
            'price' => 30000,
            'website_type_id' => $websiteTypes->random()->id,
            'description' => 'Valós idejű kommunikációs eszköz, amely lehetővé teszi a weboldal látogatói számára, hogy azonnali üzenetet váltsanak Önnel vagy az ügyfélszolgálattal, növelve az elkötelezettséget. Adot chatt szolgáltató kérhet felárat.',
        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Blog / Hírek szekció',
            'price' => 30000,
            'website_type_id' => $websiteTypes->random()->id,
            'description' => 'Tartalommarketingre és a látogatók rendszeres tájékoztatására szolgáló felület, ahol cikkeket, híreket tehet közzé.',
        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Felhasználói fiók / Regisztráció',
            'price' => 30000,
            'website_type_id' => $websiteTypes->random()->id,
            'description' => 'Lehetővé teszi a látogatók számára, hogy fiókot hozzanak létre, bejelentkezzenek, és hozzáférjenek személyre szabott tartalmakhoz vagy szolgáltatásokhoz (pl. rendelési előzmények, kedvencek).',
        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Közösségi média integráció',
            'price' => 30000,
            'website_type_id' => $websiteTypes->random()->id,
            'description' => 'Keresőfunkció: Egy beépített keresőmező, amellyel a látogatók könnyedén megtalálhatják a weboldalon belüli tartalmakat, termékeket vagy szolgáltatásokat.',
        ]);
        RequestQuoteFunctionality::factory()->create([
            'name' => 'Chat',
            'price' => 30000,
            'website_type_id' => $websiteTypes->random()->id,
            'description' => 'Közösségi média integráció: Közvetlen linkek a közösségi média felületekre, megosztás gombok vagy beágyazott feedek az oldal tartalmának népszerűsítésére.',
        ]);
    }
}
