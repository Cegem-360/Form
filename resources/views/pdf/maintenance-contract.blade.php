<!DOCTYPE html>
<html lang="hu">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Üzemeltetési Megbízási Szerződés</title>
        <style>
            @page {
                margin: 20mm;
            }

            body {
                font-family: 'DejaVu Sans', Arial, sans-serif;
                font-size: 11pt;
                line-height: 1.5;
                color: #000;
            }

            .header {
                text-align: center;
                margin-bottom: 30px;
                font-weight: bold;
                font-size: 16pt;
            }

            .contract-number {
                text-align: center;
                margin-bottom: 20px;
                font-size: 12pt;
            }

            .section {
                margin-bottom: 25px;
            }

            .section-title {
                font-weight: bold;
                font-size: 13pt;
                margin-bottom: 10px;
                color: #333;
            }

            .parties {
                display: table;
                width: 100%;
                margin-bottom: 20px;
            }

            .party {
                display: table-cell;
                width: 48%;
                vertical-align: top;
                padding: 10px;
                border: 1px solid #ccc;
            }

            .party-spacer {
                display: table-cell;
                width: 4%;
            }

            .party-title {
                font-weight: bold;
                margin-bottom: 8px;
                font-size: 12pt;
            }

            .clause {
                margin-bottom: 15px;
                text-align: justify;
            }

            .clause-title {
                font-weight: bold;
                margin-bottom: 8px;
            }

            .clause ol, .clause ul {
                margin: 10px 0;
                padding-left: 20px;
            }

            .clause li {
                margin-bottom: 5px;
            }

            .price-table {
                width: 100%;
                border-collapse: collapse;
                margin: 15px 0;
            }

            .price-table td, .price-table th {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }

            .price-table th {
                background-color: #f0f0f0;
                font-weight: bold;
            }

            .signature-section {
                margin-top: 50px;
                display: table;
                width: 100%;
            }

            .signature-box {
                display: table-cell;
                width: 48%;
                text-align: center;
                vertical-align: bottom;
            }

            .signature-spacer {
                display: table-cell;
                width: 4%;
            }

            .signature-line {
                border-bottom: 1px solid #000;
                margin: 40px auto 10px;
                width: 200px;
            }

            .signature-label {
                font-size: 10pt;
                margin-bottom: 5px;
            }

            .page-break {
                page-break-before: always;
            }
        </style>
    </head>

    <body>
        <div class="header">
            ÜZEMELTETÉSI MEGBÍZÁSI SZERZŐDÉS
        </div>

        <div class="contract-number">
            Szerződés száma: ÜMS-{{ date('Y') }}-{{ str_pad($project->id ?? '001', 3, '0', STR_PAD_LEFT) }}
        </div>

        <div class="section">
            <div class="parties">
                <div class="party">
                    <div class="party-title">MEGBÍZÓ:</div>
                    <div>
                        <strong>{{ $request_quote->company_name ?? $client->name ?? 'Megbízó Név' }}</strong><br>
                        Székhelye: -<br>
                        Adószáma: -<br>
                        Cégjegyzékszáma: -<br>
                        Képviseli: {{ $contact_person->name ?? 'Kapcsolattartó' }}<br>
                        E-mail: {{ $client->email ?? 'email@example.com' }}
                    </div>
                </div>
                <div class="party-spacer"></div>
                <div class="party">
                    <div class="party-title">MEGBÍZOTT:</div>
                    <div>
                        <strong>Cégem 360 Kft.</strong><br>
                        Székhelye: 1182 Budapest, Gulipán utca 6.<br>
                        Adószáma: 14286249-2-43<br>
                        Cégjegyzékszáma: 01 09 897122<br>
                        Képviseli: Tóth Tamás<br>
                        E-mail: tamas@cegem360.hu<br>
                        Telefon: +36 20 331 9550
                    </div>
                </div>
            </div>
        </div>

        <div class="clause">
            A felek az alábbiakban meghatározott feltételekkel üzemeltetési megbízási szerződést kötnek a 
            {{ $project->name ?? 'weboldal' }} üzemeltetésére vonatkozóan.
        </div>

        <div class="section">
            <div class="clause-title">1. A szerződés tárgya</div>
            <div class="clause">
                1.1. A Megbízott vállalja a Megbízó tulajdonában lévő weboldal folyamatos üzemeltetését, 
                karbantartását és technikai támogatását.<br><br>
                1.2. Az üzemeltetés magában foglalja:
                <ul>
                    <li>A weboldal folyamatos működésének biztosítása</li>
                    <li>Rendszeres biztonsági mentések készítése</li>
                    <li>Szoftverfrissítések telepítése</li>
                    <li>Biztonsági javítások alkalmazása</li>
                    <li>Teljesítmény optimalizálás</li>
                    <li>Alapvető technikai támogatás nyújtása</li>
                </ul>
            </div>
        </div>

        <div class="section">
            <div class="clause-title">2. A szerződés időtartama</div>
            <div class="clause">
                2.1. Jelen szerződés {{ now()->format('Y. m. d.') }} napján lép hatályba.<br><br>
                2.2. A szerződés határozatlan időre szól, 30 napos felmondási idővel bármelyik fél által 
                indoklás nélkül felmondható.<br><br>
                2.3. A szerződés rendkívüli felmondásának eseteit a Polgári Törvénykönyv szabályai szerint 
                kell értelmezni.
            </div>
        </div>

        <div class="section">
            <div class="clause-title">3. Díjazás</div>
            <div class="clause">
                3.1. Az üzemeltetési szolgáltatás díja:
                
                <table class="price-table">
                    <thead>
                        <tr>
                            <th>Szolgáltatás megnevezése</th>
                            <th>Gyakorisága</th>
                            <th>Díj (nettó)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Alapvető üzemeltetés</td>
                            <td>Havonta</td>
                            <td>{{ $support_pack->price ? Number::currency($support_pack->price, 'HUF', 'hu', 0) : '15.000 Ft' }}</td>
                        </tr>
                        <tr>
                            <td>Biztonsági mentés</td>
                            <td>Hetente</td>
                            <td>A fenti díjban foglaltatik</td>
                        </tr>
                        <tr>
                            <td>Technikai támogatás</td>
                            <td>Szükség szerint</td>
                            <td>A fenti díjban foglaltatik</td>
                        </tr>
                    </tbody>
                </table>

                3.2. A díjfizetés havonta előre történik, minden hónap 5. napjáig.<br><br>
                3.3. A díjak nem tartalmazzák az ÁFA-t, melyet a hatályos jogszabályok szerint kell felszámítani.
            </div>
        </div>

        <div class="section">
            <div class="clause-title">4. A felek kötelezettségei</div>
            <div class="clause">
                4.1. <strong>Megbízott kötelezettségei:</strong>
                <ul>
                    <li>A weboldal 99%-os rendelkezésre állásának biztosítása</li>
                    <li>24 órán belüli hibaelhárítás</li>
                    <li>Havi rendszeres jelentés készítése</li>
                    <li>Adatbiztonság és adatvédelem biztosítása</li>
                </ul>

                4.2. <strong>Megbízó kötelezettségei:</strong>
                <ul>
                    <li>Díjak határidőben történő megfizetése</li>
                    <li>Szükséges hozzáférések biztosítása</li>
                    <li>Változások időben történő jelzése</li>
                    <li>Együttműködés a karbantartási munkálatok során</li>
                </ul>
            </div>
        </div>

        <div class="section">
            <div class="clause-title">5. Felelősség</div>
            <div class="clause">
                5.1. A Megbízott kizárólag a szerződésben vállalt kötelezettségek elmulasztásából eredő 
                károkért felel.<br><br>
                5.2. A Megbízott felelőssége kizárt vis maior esetén, illetve ha a kár harmadik személy 
                jogellenes magatartásából származik.<br><br>
                5.3. A Megbízott kártérítési felelőssége a havonta fizetett díj összegében maximálva van.
            </div>
        </div>

        <div class="section">
            <div class="clause-title">6. Egyéb rendelkezések</div>
            <div class="clause">
                6.1. A jelen szerződésben nem szabályozott kérdésekben a Polgári Törvénykönyv rendelkezései 
                az irányadóak.<br><br>
                6.2. A szerződésmódosítás csak írásos formában érvényes.<br><br>
                6.3. Esetleges jogviták rendezésére a felek kikötik a Magyar bíróságok kizárólagos illetékességét.
            </div>
        </div>

        <div class="signature-section">
            <div class="signature-box">
                <div class="signature-line"></div>
                <div class="signature-label">Megbízó</div>
                <div>{{ $request_quote->company_name ?? $client->name ?? 'Megbízó Név' }}</div>
            </div>
            <div class="signature-spacer"></div>
            <div class="signature-box">
                <div class="signature-line"></div>
                <div class="signature-label">Megbízott</div>
                <div>Cégem 360 Kft.</div>
            </div>
        </div>

        <div style="margin-top: 30px; text-align: center; font-size: 10pt; color: #666;">
            Budapest, {{ now()->format('Y. m. d.') }}
        </div>

    </body>

</html>