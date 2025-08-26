<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Projekt Teljesitesi Igazolas</title>
    <style>
        @page {
            margin: 2cm;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #007bff;
        }
        .header h1 {
            color: #007bff;
            margin-bottom: 10px;
        }
        .document-number {
            color: #666;
            font-size: 14px;
        }
        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        .section-title {
            background-color: #f8f9fa;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            border-left: 4px solid #007bff;
        }
        .info-grid {
            display: table;
            width: 100%;
        }
        .info-row {
            display: table-row;
        }
        .info-label {
            display: table-cell;
            width: 40%;
            padding: 8px;
            font-weight: bold;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }
        .info-value {
            display: table-cell;
            width: 60%;
            padding: 8px;
            border: 1px solid #dee2e6;
        }
        .list-section {
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .list-section ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        .list-section li {
            margin-bottom: 5px;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .signature-section {
            margin-top: 50px;
            display: table;
            width: 100%;
        }
        .signature-box {
            display: table-cell;
            width: 45%;
            text-align: center;
            padding: 20px;
        }
        .signature-line {
            border-bottom: 1px solid #000;
            margin: 40px auto 10px;
            width: 200px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>PROJEKT TELJESÍTÉSI IGAZOLÁS</h1>
        <div class="document-number">Dokumentum száma: {{ $document_number }}</div>
        <div>Kiállítás dátuma: {{ $document_generated_at->format('Y. m. d.') }}</div>
    </div>

    <div class="section">
        <div class="section-title">Projekt Információk</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Projekt neve:</div>
                <div class="info-value">{{ $project->name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Projekt azonosító:</div>
                <div class="info-value">#{{ $project->id }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Kezdés dátuma:</div>
                <div class="info-value">{{ $start_date ? $start_date->format('Y. m. d.') : 'Nincs megadva' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Befejezés dátuma:</div>
                <div class="info-value">{{ $completion_date->format('Y. m. d.') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Projekt időtartama:</div>
                <div class="info-value">{{ $project_duration }} nap</div>
            </div>
            <div class="info-row">
                <div class="info-label">Státusz:</div>
                <div class="info-value">{{ $project->status?->value ?? 'Befejezett' }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Ügyfél Adatok</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Ügyfél neve:</div>
                <div class="info-value">{{ $client->name ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Email cím:</div>
                <div class="info-value">{{ $client->email ?? 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Kapcsolattartó:</div>
                <div class="info-value">{{ $contact_person->name ?? 'N/A' }}</div>
            </div>
            @if($request_quote)
            <div class="info-row">
                <div class="info-label">Cégnév:</div>
                <div class="info-value">{{ $request_quote->company_name ?? 'N/A' }}</div>
            </div>
            @endif
        </div>
    </div>

    @if(!empty($completed_elements))
    <div class="section">
        <div class="section-title">Teljesített Elemek</div>
        <div class="list-section">
            <ul>
                @foreach($completed_elements as $element)
                    <li>{{ is_array($element) ? implode(' - ', $element) : $element }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    @if(!empty($solved_problems))
    <div class="section">
        <div class="section-title">Megoldott Problémák</div>
        <div class="list-section">
            <ul>
                @foreach($solved_problems as $problem)
                    <li>{{ is_array($problem) ? implode(' - ', $problem) : $problem }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    @if(!empty($not_contained_elements))
    <div class="section">
        <div class="section-title">Nem Tartalmazott Elemek</div>
        <div class="list-section">
            <p>Az alábbi elemek nem képezték a projekt részét:</p>
            <ul>
                @foreach($not_contained_elements as $element)
                    <li>{{ is_array($element) ? implode(' - ', $element) : $element }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    @if($garanty_info)
    <div class="section">
        <div class="section-title">Garancia Információ</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Garancia:</div>
                <div class="info-value">{{ $garanty_info }}</div>
            </div>
        </div>
    </div>
    @endif

    @if($support_pack)
    <div class="section">
        <div class="section-title">Support Csomag</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Csomag neve:</div>
                <div class="info-value">{{ $support_pack->name }}</div>
            </div>
            @if($support_pack->description)
            <div class="info-row">
                <div class="info-label">Leírás:</div>
                <div class="info-value">{{ $support_pack->description }}</div>
            </div>
            @endif
        </div>
    </div>
    @endif

    <div class="signature-section">
        <div class="signature-box">
            <div class="signature-line"></div>
            <div>Megrendelő</div>
            <div>{{ $client->name ?? '' }}</div>
        </div>
        <div style="display: table-cell; width: 10%;"></div>
        <div class="signature-box">
            <div class="signature-line"></div>
            <div>Kivitelező</div>
            <div>{{ config('app.name') }}</div>
        </div>
    </div>

    <div class="footer">
        <p>Ez a dokumentum igazolja, hogy a fent részletezett projekt sikeresen teljesítésre került.</p>
        <p>Dokumentum generálva: {{ $document_generated_at->format('Y. m. d. H:i:s') }}</p>
    </div>
</body>
</html>