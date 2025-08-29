<!DOCTYPE html>
<html lang="hu">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Üzemeltetési Árajánlat</title>
        <style>
            @page {
                margin: 20mm;
            }

            body {
                font-family: 'DejaVu Sans', Arial, sans-serif;
                font-size: 11pt;
                line-height: 1.6;
                color: #333;
            }

            .header-section {
                display: table;
                width: 100%;
                margin-bottom: 30px;
            }

            .logo-section {
                display: table-cell;
                width: 40%;
                vertical-align: middle;
            }

            .company-info {
                display: table-cell;
                width: 60%;
                text-align: right;
                vertical-align: middle;
                font-size: 10pt;
                color: #666;
            }

            .document-title {
                text-align: center;
                font-size: 20pt;
                font-weight: bold;
                color: #2563eb;
                margin: 30px 0;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .quote-number {
                text-align: center;
                font-size: 12pt;
                color: #666;
                margin-bottom: 25px;
            }

            .client-info {
                background-color: #f8f9fa;
                padding: 20px;
                border-radius: 8px;
                margin-bottom: 30px;
            }

            .client-info-title {
                font-weight: bold;
                font-size: 14pt;
                color: #2563eb;
                margin-bottom: 15px;
            }

            .info-row {
                margin-bottom: 8px;
            }

            .info-label {
                font-weight: bold;
                display: inline-block;
                width: 150px;
            }

            .section {
                margin-bottom: 30px;
            }

            .section-title {
                font-weight: bold;
                font-size: 14pt;
                color: #2563eb;
                border-bottom: 2px solid #2563eb;
                padding-bottom: 8px;
                margin-bottom: 15px;
            }

            .services-table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
            }

            .services-table th {
                background-color: #2563eb;
                color: white;
                padding: 12px;
                text-align: left;
                font-weight: bold;
            }

            .services-table td {
                padding: 12px;
                border-bottom: 1px solid #e5e7eb;
            }

            .services-table tr:nth-child(even) {
                background-color: #f9fafb;
            }

            .service-name {
                font-weight: bold;
                color: #1f2937;
            }

            .service-description {
                font-size: 10pt;
                color: #6b7280;
                margin-top: 4px;
            }

            .price-summary {
                background-color: #eff6ff;
                padding: 20px;
                border-radius: 8px;
                margin: 30px 0;
            }

            .price-row {
                display: table;
                width: 100%;
                margin-bottom: 10px;
            }

            .price-label {
                display: table-cell;
                width: 70%;
                font-size: 12pt;
            }

            .price-value {
                display: table-cell;
                width: 30%;
                text-align: right;
                font-size: 12pt;
            }

            .total-row {
                border-top: 2px solid #2563eb;
                padding-top: 10px;
                margin-top: 10px;
                font-weight: bold;
                font-size: 14pt;
            }

            .total-row .price-value {
                color: #2563eb;
            }

            .benefits-list {
                list-style: none;
                padding: 0;
            }

            .benefits-list li {
                padding-left: 25px;
                margin-bottom: 10px;
                position: relative;
            }

            .benefits-list li:before {
                content: "✓";
                position: absolute;
                left: 0;
                color: #10b981;
                font-weight: bold;
                font-size: 14pt;
            }

            .terms-section {
                background-color: #f9fafb;
                padding: 20px;
                border-radius: 8px;
                margin: 30px 0;
            }

            .terms-list {
                padding-left: 20px;
            }

            .terms-list li {
                margin-bottom: 8px;
            }

            .validity-box {
                border: 2px solid #2563eb;
                padding: 15px;
                text-align: center;
                margin: 30px 0;
                border-radius: 8px;
                background-color: #eff6ff;
            }

            .validity-text {
                font-size: 12pt;
                color: #2563eb;
                font-weight: bold;
            }

            .contact-section {
                background-color: #1f2937;
                color: white;
                padding: 20px;
                border-radius: 8px;
                margin-top: 30px;
            }

            .contact-title {
                font-size: 14pt;
                font-weight: bold;
                margin-bottom: 15px;
            }

            .contact-info {
                font-size: 11pt;
                line-height: 1.8;
            }

            .footer {
                margin-top: 40px;
                text-align: center;
                font-size: 9pt;
                color: #9ca3af;
                border-top: 1px solid #e5e7eb;
                padding-top: 20px;
            }

            .highlight {
                background-color: #fef3c7;
                padding: 2px 6px;
                border-radius: 4px;
            }
        </style>
    </head>

    <body>
        <div class="header-section">
            <div class="logo-section">
                <strong style="font-size: 18pt; color: #2563eb;">Cégem 360 Kft.</strong>
            </div>
            <div class="company-info">
                1182 Budapest, Gulipán utca 6.<br>
                Adószám: 14286249-2-43<br>
                Cégjegyzékszám: 01 09 897122<br>
                Tel: +36 20 331 9550<br>
                E-mail: tamas@cegem360.hu
            </div>
        </div>

        <div class="document-title">
            ÜZEMELTETÉSI ÁRAJÁNLAT
        </div>

        <div class="quote-number">
            Árajánlat száma: ÜA-{{ date('Y') }}-{{ str_pad($project->id ?? '001', 3, '0', STR_PAD_LEFT) }}<br>
            Dátum: {{ now()->format('Y. m. d.') }}
        </div>

        <div class="client-info">
            <div class="client-info-title">AJÁNLATKÉRŐ ADATAI</div>
            <div class="info-row">
                <span class="info-label">Cégnév:</span>
                <strong>{{ $request_quote->company_name ?? ($client->name ?? 'Ajánlatkérő neve') }}</strong>
            </div>
            <div class="info-row">
                <span class="info-label">Kapcsolattartó:</span>
                {{ $contact_person->name ?? 'Kapcsolattartó neve' }}
            </div>
            <div class="info-row">
                <span class="info-label">E-mail:</span>
                {{ $client->email ?? 'email@example.com' }}
            </div>
            <div class="info-row">
                <span class="info-label">Projekt:</span>
                {{ $project->name ?? 'Weboldal neve' }}
            </div>
        </div>

        <div class="section">
            <div class="section-title">ÜZEMELTETÉSI SZOLGÁLTATÁSOK</div>

            <table class="services-table">
                <thead>
                    <tr>
                        <th style="width: 60%">Szolgáltatás</th>
                        <th style="width: 20%">Gyakoriság</th>
                        <th style="width: 20%; text-align: right;">Díj (nettó)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="service-name">Weboldal hosting és tárhely</div>
                            <div class="service-description">Biztonságos és gyors szerverszolgáltatás, garantált 99.9%
                                rendelkezésre állással</div>
                        </td>
                        <td>Folyamatos</td>
                        <td style="text-align: right;">Díjban foglalt</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="service-name">Biztonsági mentések</div>
                            <div class="service-description">Automatikus napi mentések készítése, 30 napos
                                visszaállítási lehetőséggel</div>
                        </td>
                        <td>Naponta</td>
                        <td style="text-align: right;">Díjban foglalt</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="service-name">Szoftverfrissítések</div>
                            <div class="service-description">CMS, bővítmények és biztonsági frissítések telepítése</div>
                        </td>
                        <td>Hetente</td>
                        <td style="text-align: right;">Díjban foglalt</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="service-name">Monitoring és felügyelet</div>
                            <div class="service-description">24/7 üzemidő figyelés, azonnali értesítés problémák esetén
                            </div>
                        </td>
                        <td>Folyamatos</td>
                        <td style="text-align: right;">Díjban foglalt</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="service-name">Technikai támogatás</div>
                            <div class="service-description">E-mail és telefonos support munkaidőben (hétfő-péntek 9-17
                                óra)</div>
                        </td>
                        <td>Szükség szerint</td>
                        <td style="text-align: right;">Díjban foglalt</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="service-name">Teljesítmény optimalizálás</div>
                            <div class="service-description">Sebesség és teljesítmény folyamatos monitorozása és
                                javítása</div>
                        </td>
                        <td>Havonta</td>
                        <td style="text-align: right;">Díjban foglalt</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="service-name">SSL tanúsítvány</div>
                            <div class="service-description">Let's Encrypt SSL tanúsítvány biztosítása és automatikus
                                megújítása</div>
                        </td>
                        <td>Automatikus</td>
                        <td style="text-align: right;">Díjban foglalt</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="price-summary">
            <div class="price-row">
                <div class="price-label">Üzemeltetési alapdíj:</div>
                <div class="price-value">
                    @if ($support_pack?->price)
                        {{ Number::currency($support_pack->price, 'HUF', 'hu', 0) }}
                    @else
                        {{ Number::currency(15000, 'HUF', 'hu', 0) }}
                    @endif
                </div>
            </div>
            <div class="price-row">
                <div class="price-label">Számlázási időszak:</div>
                <div class="price-value">Havonta</div>
            </div>
            <div class="price-row">
                <div class="price-label">ÁFA (27%):</div>
                <div class="price-value">
                    {{ $support_pack?->price ? Number::currency($support_pack->price * 0.27, 'HUF', 'hu', 0) : '4.050 Ft' }}
                </div>
            </div>
            <div class="price-row total-row">
                <div class="price-label">Összesen havonta:</div>
                <div class="price-value">
                    {{ $support_pack?->price ? Number::currency($support_pack->price * 1.27, 'HUF', 'hu', 0) : '19.050 Ft' }}
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">MIT TARTALMAZ AZ ÜZEMELTETÉSI CSOMAG?</div>
            <ul class="benefits-list">
                <li>Garantált 99.9% rendelkezésre állás SLA megállapodással</li>
                <li>Napi automatikus biztonsági mentések 30 napos megőrzéssel</li>
                <li>Havi 2 óra fejlesztési/módosítási munkaidő</li>
                <li>Azonnali hibaelhárítás kritikus problémák esetén</li>
                <li>Havi teljesítményjelentés és statisztikák</li>
                <li>GDPR megfelelőség és adatbiztonság</li>
                <li>Vírus- és malware védelem</li>
                <li>Tűzfal és DDoS védelem</li>
                <li>Domain és DNS kezelés</li>
                <li>E-mail postafiók kezelés (max. 10 db)</li>
            </ul>
        </div>

        <div class="terms-section">
            <div class="section-title" style="border: none; color: #1f2937;">SZERZŐDÉSI FELTÉTELEK</div>
            <ul class="terms-list">
                <li><strong>Szerződés időtartama:</strong> Határozatlan idejű, 30 napos felmondási idővel</li>
                <li><strong>Fizetési feltételek:</strong> Havi előre fizetés, 8 napos fizetési határidővel</li>
                <li><strong>Fizetési mód:</strong> Átutalás vagy bankkártyás fizetés</li>
                <li><strong>Garantált reakcióidő:</strong> Kritikus hiba esetén 2 óra, egyéb esetben 24 óra</li>
                <li><strong>Support elérhetőség:</strong> Munkanapokon 9:00-17:00 között</li>
                <li><strong>Extra munkadíj:</strong> A havi 2 órát meghaladó fejlesztési munkák esetén 15.000 Ft +
                    ÁFA/óra</li>
            </ul>
        </div>

        <div class="validity-box">
            <div class="validity-text">
                Ez az árajánlat {{ now()->addDays(30)->format('Y. m. d.') }}-ig érvényes
            </div>
        </div>

        <div class="contact-section">
            <div class="contact-title">KAPCSOLAT</div>
            <div class="contact-info">
                Amennyiben kérdése van árajánlatunkkal kapcsolatban, keressen minket bizalommal:<br>
                <strong>Tóth Tamás</strong> - Ügyvezető<br>
                Telefon: +36 20 331 9550<br>
                E-mail: tamas@cegem360.hu<br>
                Web: www.cegem360.hu
            </div>
        </div>

        <div class="footer">
            Köszönjük bizalmát! Reméljük, hogy hamarosan üzleti partnereink között üdvözölhetjük.<br>
            © {{ date('Y') }} Cégem 360 Kft. - Minden jog fenntartva
        </div>
    </body>

</html>
