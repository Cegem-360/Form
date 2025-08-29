@use('App\Models\WebsiteLanguage')
@use('App\Models\PdfOption')
@use('App\Models\WebsiteTypePrice')
<x-layouts.app>

    <div class="font-sans text-gray-900 bg-white max-w-[210mm] mx-auto">
        <style>
            @page {
                size: A4;
                margin: 2cm;
            }

            /*
            @page {
                margin-top: 40in;
                padding-top: 50in;
            }
            */
            body {
                width: 100%;
                max-width: 210mm;
                margin: 0 auto;
            }

            .page-break {
                page-break-before: always;
            }

            tr {
                -webkit-column-break-inside: avoid;
                page-break-inside: avoid;
                break-inside: avoid;
            }

            table {
                width: 100%;
                max-width: 100%;
                table-layout: fixed;
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
                    alt="Logo" class="h-20" style="display: none;" />
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

        <!-- Projekt leírása -->
        <div class="px-12 py-8">
            <h3 class="mb-4 text-2xl font-bold">A projekt leírása</h3>
            <p class="mb-4">Letisztult, igényes, átlátható weboldal készítése, megújítása a legújabb trendeknek és az
                ügyfél igényeinek megfelelően
                <strong>
                    {{ $requestQuote->websiteType->name }} {{ $requestQuote->website_engine }} alapú motorral.
                </strong>
            </p>

            <ul class="pl-8 mb-4 list-disc">
                <li>minőségi, új webdesign</li>
                <li>okostelefonra optimalizált megjelenés elkészítése</li>
                @foreach ($requestQuote->websites ?? [] as $page)
                    @if (isset($page['required']) && $page['required'])
                        <li>{{ $page['name'] }} ({{ __(ucfirst($page['length'] ?? 'medium')) }} terjedelem)</li>
                    @endif
                @endforeach
                <li>különböző, legújabb védelmi rendszerek telepítése</li>
                <li>alap Google optimalizálás beállítás: struktúra és meta adatok beállítása, Google Analytics
                    telepítése, beállítása</li>
                <li>különböző közösségi média platformok mérőinek telepítése (Facebook Pixel)</li>
                <li>GDPR beállítások (Süti értesítés, Adatvédelmi nyilatkozat)</li>
                @if ($requestQuote?->requestQuoteFunctionalitiesNotDefault)
                    @foreach ($requestQuote->requestQuoteFunctionalitiesNotDefault ?? [] as $functionality)
                        <li class="mb-2">
                            <span class="font-semibold">{{ $functionality->name }}</span><br>
                            <span class="text-xs">{!! $functionality->description !!}</span>
                        </li>
                    @endforeach
                @endif
            </ul>
            <p class="mb-4">{!! $requestQuote->project_description !!}</p>
        </div>

        <div class="page-break"></div>
        <!-- Munkafolyamat -->
        <div class="px-12 py-8">
            <h2 class="mb-4 text-2xl font-bold">Munkafolyamat leírása</h2>
            <!-- ...a teljes folyamatleírásod, minden címhez, listához, bekezdéshez Tailwind utility osztályokat adva... -->

            {!! PdfOption::whereWebsiteTypeId($requestQuote->websiteType->id)->whereWebsiteEngine($requestQuote->website_engine)->first()?->frontend_description !!}
            <br />
            {!! PdfOption::whereWebsiteTypeId($requestQuote->websiteType->id)->whereWebsiteEngine($requestQuote->website_engine)->first()?->backend_description !!}

            <h2 class="mt-8 mb-2 text-xl font-bold">Vállalási határidő</h2>
            <p class="mb-2">A weboldal a szükséges anyagok (szövegek, képek, logók, egyéb információk)
                átadását követő
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
                        <td class="px-4 py-2 font-bold border">
                            {{ $requestQuote->website_engine }} weboldal készítés
                        </td>
                        <td class="px-4 py-2 border"></td>
                        <td class="px-4 py-2 border"></td>
                        <td class="px-4 py-2 border"></td>
                    </tr>
                    @foreach ($requestQuote->requestQuoteFunctionalitiesDefault ?? [] as $functionality)
                        <tr>
                            <td class="px-4 py-2 border">{{ $functionality->name }}<br><span
                                    class="text-xs">{{ $functionality->description }}</span></td>
                            <td class="px-4 py-2 border">1 db</td>
                            <td class="px-4 py-2 border">
                                {{ Number::currency($functionality->price, in: 'HUF', locale: 'hu', precision: 0) }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ Number::currency($functionality->price, in: 'HUF', locale: 'hu', precision: 0) }}
                            </td>
                        </tr>
                    @endforeach
                    @foreach ($requestQuote->websites ?? [] as $page)
                        @if (isset($page['required']) && $page['required'])
                            <tr>
                                <td class="px-4 py-2 border">{{ $page['name'] }}</td>
                                <td class="px-4 py-2 border">{{ __(ucfirst($page['length'] ?? 'medium')) }}</td>
                                <td class="px-4 py-2 border">
                                    {{ Number::currency(WebsiteTypePrice::whereWebsiteTypeId($requestQuote->websiteType->id)->whereWebsiteEngine($requestQuote->website_engine)->whereSize($page['length'] ?? 'medium')->first()?->price,in: 'HUF',locale: 'hu',precision: 0) }}
                                </td>
                                <td class="px-4 py-2 border">
                                    {{ Number::currency(WebsiteTypePrice::whereWebsiteTypeId($requestQuote->websiteType->id)->whereWebsiteEngine($requestQuote->website_engine)->whereSize($page['length'] ?? 'medium')->first()?->price,in: 'HUF',locale: 'hu',precision: 0) }}
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    @foreach ($requestQuote->requestQuoteFunctionalitiesNotDefault ?? [] as $functionality)
                        <tr>
                            <td class="px-4 py-2 border">{{ $functionality->name }}<br><span
                                    class="text-xs">{{ $functionality->description }}</span></td>
                            <td class="px-4 py-2 border">1 db</td>
                            <td class="px-4 py-2 border">
                                {{ Number::currency($functionality->price, in: 'HUF', locale: 'hu', precision: 0) }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ Number::currency($functionality->price, in: 'HUF', locale: 'hu', precision: 0) }}
                            </td>
                        </tr>
                    @endforeach
                    @if ($requestQuote->is_multilangual)
                        <tr>
                            <td colspan="2" class="px-4 py-2 text-right border">
                                <h3 class="font-bold">Részösszeg:</h3>
                            </td>
                            <td colspan="2" class="px-4 py-2 text-right border">
                                <h3 class="font-bold">
                                    {{ Number::currency($requestQuote->getTotalPriceAttributeNoLanguages(), in: 'HUF', locale: 'hu', precision: 0) }}
                                    + ÁFA
                                </h3>
                            </td>
                        </tr>
                    @endif
                    @if ($requestQuote->is_multilangual)
                        <tr>
                            <td class="px-4 py-2 font-bold border">Nyelvesítés</td>
                            <td class="px-4 py-2 border"></td>
                            <td class="px-4 py-2 border">
                                felár {{ intval($requestQuote->requestQuotePercent() * 100) }}%
                            </td>
                            <td class="px-4 py-2 border"></td>
                        </tr>
                        @if ($requestQuote?->languages)
                            @foreach ($requestQuote->languages ?? [] as $language)
                                <tr>
                                    <td class="px-4 py-2 border">{{ WebsiteLanguage::find($language)?->name }}</td>
                                    <td class="px-4 py-2 border"></td>
                                    <td class="px-4 py-2 border">
                                        {{ Number::currency(round($requestQuote->getTotalPriceAttributeNoLanguages() * $requestQuote->requestQuotePercent()), in: 'HUF', locale: 'hu', precision: 0) }}
                                    </td>
                                    <td class="px-4 py-2 border">
                                        {{ Number::currency(round($requestQuote->getTotalPriceAttributeNoLanguages() * $requestQuote->requestQuotePercent()), in: 'HUF', locale: 'hu', precision: 0) }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endif
                    <tr>
                        <td colspan="2" class="px-4 py-2 text-right border">
                            <h3 class="font-bold">Összesen:</h3>
                        </td>
                        <td colspan="2" class="px-4 py-2 text-right border">
                            <h3 class="font-bold">
                                {{ Number::currency($requestQuote->totalPrice, in: 'HUF', locale: 'hu', precision: 0) }}
                                + ÁFA
                            </h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="px-4 py-2 text-right border">
                            <h3 class="font-bold">Előleg összeg:</h3>
                        </td>
                        <td colspan="2" class="px-4 py-2 text-right border">
                            <h3 class="font-bold">
                                {{ Number::currency($requestQuote->totalPrice / 2, in: 'HUF', locale: 'hu', precision: 0) }}
                                + ÁFA
                            </h3>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="px-12 py-8">
            <x-layouts.pdf.partials.financial-commitment-terms />

        </div>
    </div>

</x-layouts.app>
