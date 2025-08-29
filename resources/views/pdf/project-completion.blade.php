<!DOCTYPE html>
<html lang="hu">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Teljesítési Igazolás Weboldal Fejlesztésre</title>
        <style>
            @page {
                margin: 20mm;
            }

            body {
                font-family: 'DejaVu Sans', Arial, sans-serif;
                font-size: 12pt;
                line-height: 1.4;
                color: #000;
            }

            .header {
                text-align: center;
                margin-bottom: 40px;
                font-weight: bold;
                font-size: 14pt;
            }

            .section-title {
                font-weight: bold;
                font-size: 12pt;
                margin: 20px 0 10px 0;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
                border: 2px solid #000;
            }

            td, th {
                border: 1px solid #000;
                padding: 8px;
                vertical-align: top;
                font-size: 11pt;
            }

            .label-cell {
                font-weight: bold;
                background-color: #f5f5f5;
                width: 35%;
            }

            .value-cell {
                width: 65%;
            }

            .full-width {
                width: 100%;
            }

            .price-table td {
                text-align: left;
                padding: 6px 8px;
            }

            .price-right {
                text-align: right;
            }
        </style>
    </head>

    <body>
        <div class="header">
            TELJESÍTÉSI IGAZOLÁS WEBOLDAL FEJLESZTÉSRE
        </div>

        <div class="section-title">I. Megrendelő és Vállalkozó adatai</div>
        <table>
            <tr>
                <td class="label-cell">Megrendelő:</td>
                <td class="value-cell">{{ $request_quote->company_name ?? $client->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label-cell">Teljesítést igazoló</td>
                <td class="value-cell">{{ $contact_person->name ?? 'N/A' }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="label-cell">Vállalkozó:</td>
                <td class="value-cell">Cégem 360 Kft.</td>
            </tr>
            <tr>
                <td class="label-cell">Szerződést teljesítő neve:</td>
                <td class="value-cell">Tóth Tamás</td>
            </tr>
            <tr>
                <td class="label-cell">Vállalkozó székhelye, telephelye:</td>
                <td class="value-cell">1182 Budapest, Gulipán utca 6.</td>
            </tr>
            <tr>
                <td class="label-cell">Vállalkozó adószáma:</td>
                <td class="value-cell">14286249-2-43</td>
            </tr>
        </table>

        <div class="section-title">II. Szerződés adatai</div>
        <table class="price-table">
            <tr>
                <td class="label-cell">Szerződés tárgya:</td>
                <td class="value-cell">{{ $document_generated_at->format('Y. m. d.') }}-én kelt, {{ $document_number }} sorszámú árajánlat alapján {{ $project->name ?? 'weboldal' }} angol nyelvű változat elkészítése</td>
            </tr>
            <tr>
                <td class="label-cell">A vállalkozói díj összesen:</td>
                <td class="value-cell">
                    @if($order && $order->total_amount)
                        Nettó: {{ Number::currency($order->total_amount, 'HUF', 'hu', 0) }}<br>
                        ÁFA (27%): {{ Number::currency($order->total_amount * 0.27, 'HUF', 'hu', 0) }}<br>
                        Bruttó: {{ Number::currency($order->total_amount * 1.27, 'HUF', 'hu', 0) }}
                    @else
                        Nettó: 376.000,- Ft<br>
                        ÁFA (27%): 101.520,- Ft<br>
                        Bruttó: 477.520,- Ft
                    @endif
                </td>
            </tr>
        </table>

        <div class="section-title">III. Teljesítés adatai</div>
        <table>
            <tr>
                <td class="label-cell">Szerződés teljesítésének ellenértéke (nettó+ÁFA=bruttó):</td>
                <td class="value-cell">
                    @if($order && $order->total_amount)
                        Nettó: {{ Number::currency($order->total_amount * 0.6, 'HUF', 'hu', 0) }}<br>
                        ÁFA (27%): {{ Number::currency($order->total_amount * 0.6 * 0.27, 'HUF', 'hu', 0) }}<br>
                        Bruttó: {{ Number::currency($order->total_amount * 0.6 * 1.27, 'HUF', 'hu', 0) }}
                    @else
                        Nettó: 226.400,- Ft<br>
                        ÁFA (27%): 61.128,- Ft<br>
                        Bruttó: 287.528,- Ft
                    @endif
                </td>
            </tr>
            <tr>
                <td class="label-cell">A Szerződés teljesítésének időpontja:</td>
                <td class="value-cell">{{ $completion_date->format('Y. m. d.') }}</td>
            </tr>
            <tr>
                <td class="label-cell">A Szerződés keretében ellátott feladat rövid összefoglalása:</td>
                <td class="value-cell">A weboldal fejlesztési munkát az árajánlatban foglaltak szerint elvégezték.</td>
            </tr>
        </table>

        <div style="margin-top: 40px;">
            <p style="text-align: justify; line-height: 1.6; margin-bottom: 30px;">
                A Vállalkozó a Vállalkozási Szerződésben vállalt teljesítést adott határidőre, a Szerződésben 
                foglaltak szerint elvégezte. A Vállalkozó a jelen teljesítési igazolás alapján jogosult nettó 
                {{ $order && $order->total_amount ? Number::currency($order->total_amount * 0.6, 'HUF', 'hu', 0) : '226.400,-' }}Ft + 
                27% ÁFA, azaz összesen bruttó {{ $order && $order->total_amount ? Number::currency($order->total_amount * 0.6 * 1.27, 'HUF', 'hu', 0) : '287.528,-' }}Ft 
                összegű számlájának a Megrendelőhöz való benyújtására, amelyhez jelen aláírt igazolás másolatát kell 
                csatolnia a Vállalkozónak.
            </p>
            
            <div style="margin-bottom: 40px;">
                <div style="text-align: left; margin-bottom: 30px;">
                    Budapest, {{ $completion_date->format('Y.m.d.') }}
                </div>
            </div>

            <div style="text-align: right; margin-top: 80px;">
                <div style="border-bottom: 2px dotted #000; width: 300px; margin-left: auto; margin-bottom: 10px;"></div>
                <div style="text-align: center; width: 300px; margin-left: auto;">
                    <div style="font-weight: bold;">Megrendelő képviseletében</div>
                    <div>{{ $contact_person->name ?? 'Példa János' }}</div>
                </div>
            </div>
        </div>

    </body>

</html>