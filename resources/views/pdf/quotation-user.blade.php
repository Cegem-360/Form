@use('App\Models\WebsiteLanguage')
<x-layouts.app>

    <div class="font-sans text-gray-900 bg-white">
        <style>
            .page-break {
                page-break-after: always;
            }
        </style>
        <!-- Borító -->
        <x-layouts.pdf.partials.cover :requestQuote="$requestQuote" />
        <!-- Rólunk -->
        <x-layouts.pdf.partials.about-us />
        <!-- Fejléc és ajánlat fő adatai -->
        <div class="px-12 py-8">
            <div class="flex items-center justify-between mb-8">
                <img src="data:image/png;base64,{{ base64_encode(Vite::content('resources/images/cegem360-logo.png')) }}"
                    alt="Logo" class="h-20" />
                <div class="text-right">
                    <h1 class="text-4xl font-bold text-blue-700">Árajánlat</h1>
                    <h3 class="text-lg">Sorszám: {{ $requestQuote->id }}</h3>
                </div>
            </div>
            <div class="flex flex-wrap gap-12 mb-8">
                <div class="flex-1 min-w-[300px]">
                    <h4 class="font-semibold">Tárgy</h4>
                    <p>Árajánlat {{ $requestQuote->company_name ?? $requestQuote->name }}
                        {{ $requestQuote->website_engine }} {{ $requestQuote->websiteType->name }} készítésére
                    </p>
                    <h4 class="mt-4 font-semibold">Ajánlatot adó cég:</h4>
                    <p>
                        Cégem 360 Kft.<br>
                        Székhely: 1182 Budapest, Gulipán utca 6.<br>
                        Iroda: 1146 Budapest, Istvánmezei út 1-3. IV. emelet<br>
                        Adószám: 14286249-2-43<br>
                        Cégjegyzékszám: 01 09 897122
                    </p>
                </div>
                <div class="flex-1 min-w-[300px]">
                    <h4 class="font-semibold">Készült</h4>
                    <p>{{ \Carbon\Carbon::now()->format('Y.m.d.') }}</p>
                    <h4 class="mt-4 font-semibold">Ajánlat érvényessége</h4>
                    <p>{{ \Carbon\Carbon::now()->addMonth()->format('Y.m.d.') }}</p>
                    <h4 class="mt-4 font-semibold">Kapcsolattartók:</h4>
                    <p>
                        Tóth Tamás<br>
                        <a href="tel:+36203319550" class="text-blue-700">+36 20 331 9550</a><br>
                        <a href="mailto:tamas@cegem360.hu" class="text-blue-700">tamas@cegem360.hu</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="page-break"></div>

        <!-- Projekt leírása -->
        <div class="px-12 py-8">
            <x-layouts.pdf.partials.logo />
            <h3 class="mb-4 text-2xl font-bold">A projekt leírása</h3>
            <p class="mb-4">Letisztult, igényes, átlátható weboldal készítése, megújítása a legújabb trendeknek és az
                ügyfél igényeinek megfelelően
                <strong>
                    {{ $requestQuote->websiteType->name }} {{ $requestQuote->website_engine }} alapú motorral.
                </strong>
            </p>
            <p class="mb-4">{!! $requestQuote->project_description !!}</p>
            <ul class="pl-8 mb-4 list-disc">
                <li>minőségi, új webdesign</li>
                <li>okostelefonra optimalizált megjelenés elkészítése</li>
                @foreach ($requestQuote->websites as $page)
                    @if ($page['required'])
                        <li>{{ $page['name'] }} ({{ __(ucfirst($page['length'])) }} terjedelem)</li>
                    @endif
                @endforeach
                <li>különböző, legújabb védelmi rendszerek telepítése</li>
                <li>alap Google optimalizálás beállítás: struktúra és meta adatok beállítása, Google Analytics
                    telepítése, beállítása</li>
                <li>különböző közösségi média platformok mérőinek telepítése (Facebook Pixel)</li>
                <li>GDPR beállítások (Süti értesítés, Adatvédelmi nyilatkozat)</li>
                @if ($requestQuote?->requestQuoteFunctionalities)
                    @foreach ($requestQuote->requestQuoteFunctionalities ?? [] as $functionality)
                        <li class="mb-2">
                            <span class="font-semibold">{{ $functionality->name }}</span><br>
                            <span class="text-xs">{{ $functionality->description }}</span>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>

        <div class="page-break"></div>
        <!-- Munkafolyamat -->
        <div class="px-12 py-8">
            <h2 class="mb-4 text-2xl font-bold">Munkafolyamat leírása</h2>
            <!-- ...a teljes folyamatleírásod, minden címhez, listához, bekezdéshez Tailwind utility osztályokat adva... -->
            <h3 class="mt-6 mb-2 text-xl font-semibold">1. Konzultáció és tervezés</h3>
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
            <h3 class="mt-6 mb-2 text-xl font-semibold">3. Back-end fejlesztés</h3>
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
            </ul>
            <h2 class="mt-8 mb-2 text-xl font-bold">Vállalási határidő</h2>
            <p class="mb-2">A weboldal a szükséges anyagok (szövegek, képek, logók, egyéb információk) átadását követő
                30 munkanapon belül elkészül.
            </p>
        </div>
        <div class="page-break"></div>
        <!-- Díjazás táblázat -->
        <div class="px-12 py-8">
            <h2 class="mb-4 text-2xl font-bold">A feladat díjazása</h2>
            <table class="min-w-full text-sm border border-gray-300">
                <thead>
                    <tr class="bg-blue-100">
                        <th class="px-4 py-2 border">MEGNEVEZÉS</th>
                        <th class="px-4 py-2 border">MENNYISÉG</th>
                        <th class="px-4 py-2 border">EGYSÉGDÍJ</th>
                        <th class="px-4 py-2 border">ÖSSZESEN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-4 py-2 font-bold border">{{ $requestQuote->website_engine }} weboldal készítés
                        </td>
                        <td class="px-4 py-2 border"></td>
                        <td class="px-4 py-2 border"></td>
                        <td class="px-4 py-2 border"></td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border">Keretrendszer beállítása (védelmi, GDPR, süti elfogadás,
                            Analytics, Webmester eszközök)</td>
                        <td class="px-4 py-2 border">1 db</td>
                        <td class="px-4 py-2 border">80000 Ft</td>
                        <td class="px-4 py-2 border">80000 Ft</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 border">UI tervezés (drótváz, design)</td>
                        <td class="px-4 py-2 border">1 db</td>
                        <td class="px-4 py-2 border">80000 Ft</td>
                        <td class="px-4 py-2 border">80000 Ft</td>
                    </tr>
                    @foreach ($requestQuote->websites as $page)
                        @if ($page['required'])
                            <tr>
                                <td class="px-4 py-2 border">{{ $page['name'] }}</td>
                                <td class="px-4 py-2 border">{{ __(ucfirst($page['length'])) }}</td>
                                <td class="px-4 py-2 border">
                                    {{ match ($page['length']) {
                                        'short' => Number::currency(20000, in: 'HUF', locale: 'hu', precision: 0),
                                        'medium' => Number::currency(40000, in: 'HUF', locale: 'hu', precision: 0),
                                        'long' => Number::currency(70000, in: 'HUF', locale: 'hu', precision: 0),
                                        default => Number::currency(0, in: 'HUF', locale: 'hu', precision: 0),
                                    } }}
                                </td>
                                <td class="px-4 py-2 border"></td>
                            </tr>
                        @endif
                    @endforeach
                    @foreach ($requestQuote->requestQuoteFunctionalities as $functionality)
                        <tr>
                            <td class="px-4 py-2 border">{{ $functionality->name }}<br><span
                                    class="text-xs">{{ $functionality->description }}</span></td>
                            <td class="px-4 py-2 border">1 db</td>
                            <td class="px-4 py-2 border">
                                {{ Number::currency($functionality->price, in: 'HUF', locale: 'hu', precision: 0) }} Ft
                            </td>
                            <td class="px-4 py-2 border"></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" class="px-4 py-2 text-right border">
                            <h3 class="font-bold">Összesen:</h3>
                        </td>
                        <td colspan="2" class="px-4 py-2 text-right border">
                            <h3 class="font-bold">
                                {{ Number::currency($requestQuote->getTotalPriceAttribute(), in: 'HUF', locale: 'hu', precision: 0) }}
                                + ÁFA
                            </h3>
                        </td>
                    </tr>
                    @if ($requestQuote->is_multilangual)
                        <tr>
                            <td class="px-4 py-2 font-bold border">Nyelvesítés</td>
                            <td class="px-4 py-2 border"></td>
                            <td class="px-4 py-2 border">felár 30%</td>
                            <td class="px-4 py-2 border"></td>
                        </tr>
                        @if ($requestQuote?->languages)
                            @foreach ($requestQuote->languages ?? [] as $language)
                                <tr>
                                    <td class="px-4 py-2 border">{{ WebsiteLanguage::find($language)?->name }}</td>
                                    <td class="px-4 py-2 border"></td>
                                    <td class="px-4 py-2 border"></td>
                                    <td class="px-4 py-2 border"></td>
                                </tr>
                            @endforeach
                        @endif
                    @endif
                    <tr>
                        <td colspan="2" class="px-4 py-2 text-right border">
                            <h3 class="font-bold">Előleg összeg:</h3>
                        </td>
                        <td colspan="2" class="px-4 py-2 text-right border">
                            <h3 class="font-bold">
                                {{ Number::currency($requestQuote->getTotalPriceAttribute() / 2, in: 'HUF', locale: 'hu', precision: 0) }}
                                + ÁFA
                            </h3>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</x-layouts.app>
