<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\PdfOption;
use App\Models\WebsiteType;
use Illuminate\Database\Seeder;

final class PdfOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PdfOption::factory()->create([
            'website_type_id' => WebsiteType::whereName('Weboldal')->first()->id,
            'website_engine' => 'laravel',
            'frontend_description' => '<h3 class="mt-6 mb-2 text-xl font-semibold">1. Konzultáció és tervezés</h3>
            <p class="mb-2">A projekt kezdeti szakaszában:</p>
            <ul class="pl-8 mb-2 list-disc">
                <li>Kezdeti konzultáció:
                    <ul class="pl-8 list-disc">
                        <li>Ügyfél igényeinek felmérése, célok, elvárások megismerése.</li>
                        <li>Célközönség és versenytársak elemzése.</li>
                    </ul>
                </li>
                <li>Specifikáció meghatározása:
                    <ul class="pl-8 list-disc">
                        <li>Funkciók és szolgáltatások részletezése.</li>
                        <li>Weboldal struktúrájának, funkcióinak és funkcionális követelményeinek kidolgozása.</li>
                    </ul>
                </li>
                <li>UI tervezés:
                    <ul class="pl-8 list-disc">
                        <li>Drótvázak készítése: Alapvető vázlatok, amelyek bemutatják az oldal elrendezését és a
                            navigációt.</li>
                        <li>UI design: A vizuális tervek elkészítése, színek, betűtípusok, gombok, ikonok tervezése.
                            Fontos, hogy az ügyfél itt véglegesítse a designt, hogy a későbbi szakaszok gördülékenyen
                            haladhassanak.</li>
                        <li>Design visszajelzések beépítése, véglegesítés.</li>
                    </ul>
                </li>
                <li>Prototípus bemutatása:
                    <ul class="pl-8 list-disc">
                        <li>Kattintható prototípus, amellyel az ügyfél előre látja, hogyan fog kinézni és működni az
                            oldal. Ennek elfogadása után lehet továbblépni a fejlesztésre.</li>
                    </ul>
                </li>
            </ul>
            <h3 class="mt-6 mb-2 text-xl font-semibold">2. Front-end fejlesztés</h3>
            <p class="mb-2">Ebben a szakaszban az UI tervek alapján a főoldal és aloldalak elkészítése:</p>
            <ul class="pl-8 mb-2 list-disc">
                <li>HTML, CSS, JavaScript fejlesztés:
                    <ul class="pl-8 list-disc">
                        <li>Az oldal felépítése az elfogadott UI design alapján.</li>
                    </ul>
                </li>
                <li>Reszponzív design:
                    <ul class="pl-8 list-disc">
                        <li>Mobilra, tabletre és asztali számítógépekre optimalizálás, hogy az oldal minden eszközön jól
                            működjön.</li>
                    </ul>
                </li>
                <li>Animációk és interakciók:
                    <ul class="pl-8 list-disc">
                        <li>Görgetési effektek, hover animációk, felhasználói visszajelzések (pl. gombnyomások)
                            megvalósítása.</li>
                    </ul>
                </li>
                <li>SEO alapú HTML szerkezet:
                    <ul class="pl-8 list-disc">
                        <li>SEO-barát kódolás, figyelve a meta címekre, leírásokra és heading struktúrára.</li>
                    </ul>
                </li>
            </ul>
            ',
            'backend_description' => '<h3 class="mt-6 mb-2 text-xl font-semibold">3. Back-end fejlesztés</h3>
            <p class="mb-2">A Laravel alapú szerver oldali fejlesztés következik:</p>
            <ul class="pl-8 mb-2 list-disc">
                <li>Adatbázis tervezés:
                    <ul class="pl-8 list-disc">
                        <li>Táblák, kapcsolatok, migrációk létrehozása.</li>
                    </ul>
                </li>
                <li>Adminisztrációs felület fejlesztése:
                    <ul class="pl-8 list-disc">
                        <li>Az ügyfél számára kezelőfelület biztosítása, ahol tartalmakat és adatokat kezelhet.</li>
                    </ul>
                </li>
                <li>Felhasználói hitelesítés:
                    <ul class="pl-8 list-disc">
                        <li>Regisztráció, bejelentkezés, jogosultságok kezelése.</li>
                    </ul>
                </li>
                <li>API integrációk:
                    <ul class="pl-8 list-disc">
                        <li>Külső szolgáltatások (pl. fizetési rendszerek, harmadik fél API-k) integrálása.</li>
                    </ul>
                </li>
                <li>Felhasználói felület összekapcsolása a backenddel:
                    <ul class="pl-8 list-disc">
                        <li>Formok kezelése, adatok dinamikus betöltése.</li>
                    </ul>
                </li>
            </ul>
            <h3 class="mt-6 mb-2 text-xl font-semibold">4. Tesztelés és hibajavítás</h3>
            <p class="mb-2">Az oldal funkcióinak és teljesítményének alapos ellenőrzése:</p>
            <ul class="pl-8 mb-2 list-disc">
                <li>Egységtesztek:
                    <ul class="pl-8 list-disc">
                        <li>Laravel tesztelési eszközök segítségével az egyes funkciók automatikus tesztelése.</li>
                    </ul>
                </li>
                <li>Kézi tesztelés:
                    <ul class="pl-8 list-disc">
                        <li>Az oldal működésének kézi ellenőrzése különböző böngészőkben és eszközökön.</li>
                    </ul>
                </li>
                <li>Biztonsági tesztelés:
                    <ul class="pl-8 list-disc">
                        <li>XSS, SQL injekciók és egyéb sebezhetőségek elleni védelem biztosítása.</li>
                    </ul>
                </li>
                <li>Teljesítményoptimalizálás:
                    <ul class="pl-8 list-disc">
                        <li>Oldal sebességének javítása, képek tömörítése, caching beállítása.</li>
                    </ul>
                </li>
            </ul>
            <h3 class="mt-6 mb-2 text-xl font-semibold">5. Karbantartás és támogatás</h3>
            <p class="mb-2">Az elkészült projekt átadása és utólagos támogatás biztosítása:</p>
            <ul class="pl-8 mb-2 list-disc">
                <li>Oktatás és dokumentáció:
                    <ul class="pl-8 list-disc">
                        <li>Az ügyfél képzése az adminisztrációs felület használatára, valamint részletes dokumentáció
                            átadása.</li>
                    </ul>
                </li>
                <li>Garancia időszak:
                    <ul class="pl-8 list-disc">
                        <li>Bizonyos időszakra (1 hónap) ingyenes hibajavítások biztosítása.</li>
                    </ul>
                </li>
                <li>Folyamatos karbantartás:
                    <ul class="pl-8 list-disc">
                        <li>Havi vagy éves díjas konstrukció, amely tartalmazza az oldal frissítését, biztonsági
                            mentéseket, valamint kisebb fejlesztéseket.</li>
                    </ul>
                </li>
            </ul>',
        ]);
    }
}
