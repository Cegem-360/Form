<!DOCTYPE html>
<html lang="hu">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Példa Dokumentum</title>
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
                font-size: 16pt;
            }

            .section {
                margin-bottom: 30px;
            }

            .section-title {
                font-weight: bold;
                font-size: 14pt;
                margin-bottom: 15px;
                color: #333;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
                border: 2px solid #000;
            }

            td, th {
                border: 1px solid #000;
                padding: 12px;
                vertical-align: top;
            }

            .label-cell {
                font-weight: bold;
                background-color: #f8f9fa;
                width: 30%;
            }

            .value-cell {
                width: 70%;
            }

            .example-content {
                padding: 20px;
                background-color: #f0f8ff;
                border-left: 4px solid #007bff;
                margin: 20px 0;
                font-style: italic;
            }
        </style>
    </head>

    <body>
        <div class="header">
            PÉLDA DOKUMENTUM
        </div>

        <div class="example-content">
            <strong>Megjegyzés:</strong> Ez egy példa dokumentum sablon. A projekt és árajánlat adatok elérhetők a változókban, 
            de jelenleg csak példa adatokat jelenít meg.
        </div>

        <div class="section">
            <div class="section-title">Projekt Adatok</div>
            <table>
                <tr>
                    <td class="label-cell">Projekt neve:</td>
                    <td class="value-cell">Példa Projekt Név</td>
                </tr>
                <tr>
                    <td class="label-cell">Projekt azonosító:</td>
                    <td class="value-cell">#12345</td>
                </tr>
                <tr>
                    <td class="label-cell">Státusz:</td>
                    <td class="value-cell">Aktív</td>
                </tr>
                <tr>
                    <td class="label-cell">Kezdés dátuma:</td>
                    <td class="value-cell">2025. 01. 15.</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Ügyfél Információk</div>
            <table>
                <tr>
                    <td class="label-cell">Ügyfél neve:</td>
                    <td class="value-cell">Példa Ügyfél Kft.</td>
                </tr>
                <tr>
                    <td class="label-cell">Email cím:</td>
                    <td class="value-cell">ugyfel@pelda.hu</td>
                </tr>
                <tr>
                    <td class="label-cell">Kapcsolattartó:</td>
                    <td class="value-cell">Kiss Péter</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Árajánlat Részletek</div>
            <table>
                <tr>
                    <td class="label-cell">Árajánlat száma:</td>
                    <td class="value-cell">AJ-2025-001</td>
                </tr>
                <tr>
                    <td class="label-cell">Weboldal típus:</td>
                    <td class="value-cell">Vállalati weboldal</td>
                </tr>
                <tr>
                    <td class="label-cell">Motor:</td>
                    <td class="value-cell">WordPress</td>
                </tr>
                <tr>
                    <td class="label-cell">Összeg:</td>
                    <td class="value-cell">450.000 Ft + ÁFA</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">Egyéb Adatok</div>
            <table>
                <tr>
                    <td class="label-cell">Dokumentum típus:</td>
                    <td class="value-cell">Példa PDF</td>
                </tr>
                <tr>
                    <td class="label-cell">Generálás dátuma:</td>
                    <td class="value-cell">{{ now()->format('Y. m. d. H:i') }}</td>
                </tr>
                <tr>
                    <td class="label-cell">Megjegyzés:</td>
                    <td class="value-cell">Ez egy tesztelési célú dokumentum sablon.</td>
                </tr>
            </table>
        </div>

        <div style="margin-top: 60px; text-align: center; font-size: 10pt; color: #666;">
            <p>Ez a dokumentum automatikusan generálva lett a rendszer által.</p>
            <p>Generálás időpontja: {{ now()->format('Y. m. d. H:i:s') }}</p>
        </div>

    </body>

</html>