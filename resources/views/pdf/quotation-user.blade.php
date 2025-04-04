<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation</title>
    {{-- <link rel="stylesheet" href="{{ Vite::asset('resources/css/style.css') }}">
    <link rel="stylesheet" href="resource_path('css/style.css')">
    @vite('resources/css/style.css') --}}
    <style>
        html {
            margin: 0;
        }

        body {
            font-family: Monaco, system-ui, sans-serif;
            margin: 100px 0;
            padding: 0;
            line-height: 1.6;
        }

        .main-content {
            margin: 100px 0;
        }

        .container {
            width: 100%;
            max-width: 700px;
            margin-right: 50px;
            margin-left: 50px;
            margin-bottom: 100px;
        }

        .page-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            padding: 30px 60px;
            z-index: -1;
        }

        .logo-wrapper {
            margin-bottom: 20px;
            text-align: right;
        }

        .logo {
            max-width: 200px;
            height: auto;
        }

        .header {
            margin-bottom: 60px;
        }

        .header-content-wrapper {
            position: relative;
        }

        .header-left {
            padding-right: 30px;
            width: 70%;
        }

        .header-right {
            position: absolute;
            right: 0;
            top: 0;
            width: 30%;
        }

        h1 {
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        h2 {
            margin-top: 60px;
            padding-bottom: 3px;
            border-bottom: 1px solid #aaa;
            font-size: 20px;
        }

        h3 {
            color: #39A2DB;
        }

        h4 {
            margin-top: 10px;
            margin-bottom: 0;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        p {
            margin: 0;
            font-size: 14px;
        }

        .quotation-details {
            margin-bottom: 20px;
        }

        .quotation-details p {
            margin: 5px 0;
        }

        #price-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        #price-table thead {
            background-color: #39A2DB;
            color: white;
        }

        #price-table th,
        #price-table td {
            padding: 5px 10px;
            text-align: left;
            vertical-align: top;
            font-size: 12px;
        }

        #price-table th {
            font-size: 12px;
            font-weight: normal;
            letter-spacing: 1px;
        }

        #price-table td {
            border-bottom: 1px solid #aaa;
        }

        #price-table tbody tr {
            border-bottom: 3px solid #aaa;
        }

        #price-table tbody tr:last-child {
            border-bottom: none;
            /* Remove border for the last row */
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            text-align: center;
            margin-top: 20px;
            padding: 50px;
            font-size: 12px;
            color: #777;
            background-color: #ccc;
            z-index: -1;
        }

        .page-break {
            page-break-after: always;
        }

        .page-cover {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .page-cover-image {
            /* margin: -100px 0; */
            width: 100%;
            height: 100%;
        }
    </style>
    @vite(['resources/js/app.js'])

</head>

<body>
    <div class="page-cover">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(resource_path('images/weboldal-arajanlat-borito-01.jpg'))) }}"
            alt="Borító" class="page-cover-image">
    </div>
    <div class="cover-text" style="z-index: 10; color: white;">
        <p style="position: absolute; top: 100px; left: 100px; font-size: 24px; font-weight: bold;">cégem360</p>
        <p style="position: absolute; top: 100px; right: 50px; font-size: 24px; text-transform: uppercase;">
            Prémium weboldal készítés</p>
        <p style="position: absolute; top: 500px; left: 100px; font-size: 48px; font-weight: bold;">
            Ügyfél neve {{ $requestQuote->customer_name }} részére</p>
        <p style="position: absolute; top: 580px; left: 100px; font-size: 32px;">
            Árajánlat weboldal fejlesztésre</p>
    </div>

    <div class="page-break"></div>

    <div class="page-cover">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(resource_path('images/weboldal-arajanlat-borito-02.jpg'))) }}"
            alt="Tartalom" class="page-cover-image">
    </div>

    <div class="page-break"></div>

    <div class="page-cover">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(resource_path('images/weboldal-arajanlat-borito-03.jpg'))) }}"
            alt="Rólunk" class="page-cover-image">
    </div>

    <div class="page-break"></div>

    {{-- <div class="main-content"> --}}
    <div class="page-header">
        <div class="logo-wrapper">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(resource_path('images/cegem360-logo.png'))) }}"
                alt="Logo" class="logo">
        </div>
    </div>
    <div class="container">
        <h1 class="">Quotation</h1>
        <h3>Sorszám: {{ $requestQuote->id }}</h3>
        <div class="header" style="display: flex; justify-content: space-between; gap: 100px;">
            <h4>Árajánlat</h4>
            <h2>{{ $requestQuote->customer_name }} részére</h2>
            <div class="header-content-wrapper">
                <div class="header-left">
                    <h4>Tárgy</h4>
                    <p>Árajánlat {{ $requestQuote->company_name }} {{ $requestQuote->website_engine }} készítésére
                    </p>
                    <h4>AJÁNLATTEVŐ CÉG:</h4>
                    <p>Cégem 360 Kft.<br />
                        Székhely: 1182 Budapest, Gulipán utca 6.<br />
                        Iroda: 1146 Budapest, Istvánmezei út 1-3. IV. emelet<br />
                        Adószám: 14286249-2-43<br />
                        Cégjegyzékszám: 01 09 897122</p>
                </div>
                <div class="header-right">
                    <h4>Készült</h4>
                    <p>{{ \Carbon\Carbon::now()->format('Y.m.d.') }}</p>
                    <h4>Ajánlat érvényessége</h4>
                    <p>{{ \Carbon\Carbon::now()->addMonth()->format('Y.m.d.') }}</p>
                    <h4>Kapcsolattartók:</h4>
                    <p>Tóth Tamás<br />
                        <a href="tel:+36203319550">+36 20 331 9550</a><br />
                        <a href="mailto:tamas@cegem360.hu">tamas@cegem360.hu</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="quotation-details">
            <h3>A projekt leírása</h3>
            <p>Letisztult, igényes, átlátható weboldal készítése, megújítása a legújabb trendeknek és az ügyfél
                igényeinek, megfelelően <strong>egyedi fejlesztésű {{ $requestQuote->website_engine }} alapú
                    motorral.</strong></p>
            <ul>
                <li>minőségi, új webdesign</li>
                <li>okostelefonra optimalizált megjelenés elkészítése</li>
                <li>főoldal és Rólunk (Nagy terjedelem) 3 aloldal készítése (Katalógus, Rólunk, Kapcsolat)</li>
                <li>webshop készítése az árajánlathoz írt specifikációk alapján</li>
                <li>kategóriák és termékek feltöltése</li>
                <li>különböző, legújabb védelmi rendszerek telepítése</li>
                <li>alap Google optimalizálás beállítás: struktúra és meta adatok beállítása, Google Analytics
                    telepítése, beállítása (Analitikai jelentések a látogatottságára vonatkozóan)</li>
                <li>különböző közösségi média platformok mérőinek telepítése (Facebook Pixel)</li>
                <li>GDPR beállítások (Süti értesítés, Adatvédelmi nyilatkozat)</li>
                <li>üzenetküldő űrlap</li>
            </ul>

            <p><strong>Quotation ID:</strong> {{ $requestQuote->id }}</p>
            <p><strong>Customer Name:</strong> {{ $requestQuote->customer_name }}</p>
            <p><strong>Email:</strong> {{ $requestQuote->email }}</p>
            <p><strong>Phone:</strong> {{ $requestQuote->phone }}</p>
            <p><strong>Project Description:</strong> {{ $requestQuote->project_description }}</p>
            <p><strong>Company Name:</strong> {{ $requestQuote->company_name }}</p>
            <p><strong>Website Type:</strong> {{ $requestQuote->websiteType()->first()->name ?? 'N/A' }}</p>
            <p><strong>Have Website Graphic:</strong> {{ $requestQuote->have_website_graphic ? 'Yes' : 'No' }}</p>
            <p><strong>Is Multilingual:</strong> {{ $requestQuote->is_multilangual ? 'Yes' : 'No' }}</p>
            <p><strong>Languages:</strong> {{ implode(', ', $requestQuote->languages ?? []) }}</p>
            <p><strong>Is E-commerce:</strong> {{ $requestQuote->is_ecommerce ? 'Yes' : 'No' }}</p>
            <p><strong>E-commerce Functionalities:</strong>
                {{ implode(', ', is_array($requestQuote->ecommerce_functionalities) ? $requestQuote->ecommerce_functionalities : []) }}
            </p>
            <p><strong>Website Engine:</strong> {{ $requestQuote->website_engine }}</p>
        </div>

        <div class="page-break"></div>

        <div>
            <h2>Munkafolyamat leírása</h2>
            <h3>1. Konzultáció és tervezés</h3>
            <p>A projekt kezdeti szakaszában:</p>
            <ul>
                <li>Kezdeti konzultáció:</li>
                <ul>
                    <li>Ügyfél igényeinek felmérése, célok, elvárások megismerése.</li>
                    <li>Célközönség és versenytársak elemzése.</li>
                </ul>
                <li>Specifikáció meghatározása:</li>
                <ul>
                    <li>Funkciók és szolgáltatások részletezése.</li>
                    <li>Weboldal struktúrájának, funkcióinak és funkcionális követelményeinek kidolgozása.</li>
                </ul>
                <li>UI tervezés:</li>
                <ul>
                    <li>Drótvázak készítése: Alapvető vázlatok, amelyek bemutatják az oldal elrendezését és a
                        navigációt.</li>
                    <li>UI design: A vizuális tervek elkészítése, színek, betűtípusok, gombok, ikonok tervezése.
                        Fontos,
                        hogy az ügyfél itt véglegesítse a designt, hogy a későbbi szakaszok gördülékenyen
                        haladhassanak.
                    </li>
                    <li>Design visszajelzések beépítése, véglegesítés.</li>
                </ul>
                <li>Prototípus bemutatása:</li>
                <ul>
                    <li>Kattintható prototípus, amellyel az ügyfél előre látja, hogyan fog kinézni és működni az
                        oldal.
                        Ennek elfogadása után lehet továbblépni a fejlesztésre.</li>
                </ul>
            </ul>
            <h3>2. Front-end fejlesztés</h3>
            <p>Ebben a szakaszban az UI tervek alapján a főoldal és aloldalak elkészítése:</p>
            <ul>
                <li>HTML, CSS, JavaScript fejlesztés:</li>
                <ul>
                    <li>Az oldal felépítése az elfogadott UI design alapján.</li>
                </ul>
                <li>Reszponzív design:</li>
                <ul>
                    <li>Mobilra, tabletre és asztali számítógépekre optimalizálás, hogy az oldal minden eszközön jól
                        működjön.</li>
                </ul>
                <li>Animációk és interakciók:</li>
                <ul>
                    <li>Görgetési effektek, hover animációk, felhasználói visszajelzések (pl. gombnyomások)
                        megvalósítása.</li>
                </ul>
                <li>SEO alapú HTML szerkezet:</li>
                <ul>
                    <li>SEO-barát kódolás, figyelve a meta címekre, leírásokra és heading struktúrára.</li>
                </ul>
            </ul>
            <h3>3. Back-end fejlesztés</h3>
            <p>A Laravel alapú szerver oldali fejlesztés következik:</p>
            <ul>
                <li>Adatbázis tervezés:</li>
                <ul>
                    <li>Táblák, kapcsolatok, migrációk létrehozása.</li>
                </ul>
                <li>Adminisztrációs felület fejlesztése:</li>
                <ul>
                    <li>Az ügyfél számára kezelőfelület biztosítása, ahol tartalmakat és adatokat kezelhet.</li>
                </ul>
                <li>Felhasználói hitelesítés:</li>
                <ul>
                    <li>Regisztráció, bejelentkezés, jogosultságok kezelése.</li>
                </ul>
                <li>API integrációk:</li>
                <ul>
                    <li>Külső szolgáltatások (pl. fizetési rendszerek, harmadik fél API-k) integrálása.</li>
                </ul>
                <li>Felhasználói felület összekapcsolása a backenddel:</li>
                <ul>
                    <li>Formok kezelése, adatok dinamikus betöltése.</li>
                </ul>
            </ul>
            <h3>4. Tesztelés és hibajavítás</h3>
            <p>Az oldal funkcióinak és teljesítményének alapos ellenőrzése:</p>
            <ul>
                <li>Egységtesztek:</li>
                <ul>
                    <li>Laravel tesztelési eszközök segítségével az egyes funkciók automatikus tesztelése.</li>
                </ul>
                <li>Kézi tesztelés:</li>
                <ul>
                    <li>Az oldal működésének kézi ellenőrzése különböző böngészőkben és eszközökön.</li>
                </ul>
                <li>Biztonsági tesztelés:</li>
                <ul>
                    <li>XSS, SQL injekciók és egyéb sebezhetőségek elleni védelem biztosítása.</li>
                </ul>
                <li>Teljesítményoptimalizálás:</li>
                <ul>
                    <li>Oldal sebességének javítása, képek tömörítése, caching beállítása.</li>
                </ul>
            </ul>
            <h3>5. Karbantartás és támogatás</h3>
            <p>Az elkészült projekt átadása és utólagos támogatás biztosítása:</p>
            <ul>
                <li>Oktatás és dokumentáció:</li>
                <ul>
                    <li>Az ügyfél képzése az adminisztrációs felület használatára, valamint részletes dokumentáció
                        átadása.</li>
                </ul>
                <li>Garancia időszak:</li>
                <ul>
                    <li>Bizonyos időszakra (1 hónap) ingyenes hibajavítások biztosítása.</li>
                </ul>
                <li>Folyamatos karbantartás:</li>
                <ul>
                    <li>Havi vagy éves díjas konstrukció, amely tartalmazza az oldal frissítését, biztonsági
                        mentéseket,
                        valamint kisebb fejlesztéseket.</li>
                </ul>
            </ul>
            <h2>Vállalási határidő</h2>
            <p>A weboldal a szükséges anyagok (szövegek, képek, logók, egyéb információk) átadását követő 30
                munkanapon
                belül elkészül.</p>
        </div>

        <div class="page-break"></div>

        <div id="price-table">
            <h2>A feladat díjazása</h2>
            <table>
                <thead>
                    <tr>
                        <th>MEGNEVEZÉS</th>
                        <th>MENNYISÉG</th>
                        <th>EGYSÉGDÍJ</th>
                        <th>ÖSSZESEN</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><b>WordPress alapú weboldal készítés</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Keretrendszer beállítása (védelmi, GDPR, süti elfogadás, Analytics, Webmester eszközök)
                        </td>
                        <td>1 db</td>
                        <td>80000 Ft</td>
                        <td>80000 Ft</td>
                    </tr>
                    <tr>
                        <td>UI tervezés (drótváz, design)</td>
                        <td>1 db</td>
                        <td>80000 Ft</td>
                        <td>80000 Ft</td>
                    </tr>
                    <tr>
                        <td>Főoldal</td>
                        <td>nagy</td>
                        <td>70000 Ft</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Rólunk</td>
                        <td>közepes</td>
                        <td>40000 Ft</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Kapcsolat</td>
                        <td>kicsi</td>
                        <td>20000 Ft</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Űrlap beállítás</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: right;">
                            <h3><b>+ ÁFA</b></h3>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Nyelvesítés</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Angol</td>
                        <td>1 db</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Német</td>
                        <td>5 db</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: right;">
                            <h3><b>+ ÁFA</b></h3>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="calculation">
            <h3>Cost Calculation</h3>

            @dump ($requestQuote)

            @foreach ($requestQuote->websites as $page)
                <p><strong>{{ $page['name'] }}:</strong> <strong>Cost:</strong>
                    {{ match ($page['length']) {
                        'short' => number_format(20000, 0, ',', ' ') . ' Ft',
                        'medium' => number_format(40000, 0, ',', ' ') . ' Ft',
                        'long' => number_format(70000, 0, ',', ' ') . ' Ft',
                        default => number_format(0, 0, ',', ' ') . ' Ft',
                    } }}
                </p>
                <p></p>
            @endforeach
        </div>
    </div>
    <div class="footer">
        <p>FOOTER</p>
    </div>
    {{-- </div> --}}
</body>

</html>
