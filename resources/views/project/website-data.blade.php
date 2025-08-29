<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->name ?? 'Projekt' }} - Weboldal adatok</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            opacity: 0.9;
            font-size: 14px;
        }

        .content {
            padding: 30px;
        }

        .info-section {
            margin-bottom: 30px;
        }

        .info-section h2 {
            color: #1e40af;
            font-size: 20px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e5e7eb;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 16px;
            color: #1f2937;
            font-weight: 500;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .data-table th {
            background: #f3f4f6;
            color: #374151;
            text-align: left;
            padding: 12px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .data-table td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            color: #4b5563;
            font-size: 14px;
        }

        .data-table tr:hover {
            background: #f9fafb;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-primary {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background: #fed7aa;
            color: #92400e;
        }

        .badge-info {
            background: #e0e7ff;
            color: #3730a3;
        }

        .functionality-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .functionality-item {
            background: #f3f4f6;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            color: #4b5563;
        }

        .price-highlight {
            font-size: 18px;
            font-weight: bold;
            color: #059669;
        }

        .languages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }

        .language-card {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
        }

        .language-flag {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .language-name {
            font-size: 14px;
            color: #374151;
            font-weight: 500;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #9ca3af;
        }

        .section-divider {
            height: 1px;
            background: #e5e7eb;
            margin: 30px 0;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .container {
                box-shadow: none;
                border-radius: 0;
            }

            .header {
                background: #2563eb !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .content {
                padding: 20px;
            }

            .header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $project->name ?? 'Projekt információk' }}</h1>
            <p>Weboldal adatok és funkciók áttekintése</p>
        </div>

        <div class="content">
            @if($requestQuote)
                <!-- Alapinformációk -->
                <div class="info-section">
                    <h2>Alapadatok</h2>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Árajánlat neve</span>
                            <span class="info-value">{{ $requestQuote->quotation_name ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Ügyfél neve</span>
                            <span class="info-value">{{ $requestQuote->name ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $requestQuote->email ?? '-' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Telefon</span>
                            <span class="info-value">{{ $requestQuote->phone ?? '-' }}</span>
                        </div>
                        @if($requestQuote->company_name)
                        <div class="info-item">
                            <span class="info-label">Cégnév</span>
                            <span class="info-value">{{ $requestQuote->company_name }}</span>
                        </div>
                        @endif
                        <div class="info-item">
                            <span class="info-label">Ügyfél típus</span>
                            <span class="info-value">
                                <span class="badge badge-info">
                                    {{ $requestQuote->client_type == 'company' ? 'Cég' : 'Magánszemély' }}
                                </span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>

                <!-- Weboldal információk -->
                <div class="info-section">
                    <h2>Weboldal részletek</h2>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th style="width: 30%">Tulajdonság</th>
                                <th style="width: 70%">Érték</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Weboldal típus</strong></td>
                                <td>
                                    <span class="badge badge-primary">
                                        {{ $requestQuote->websiteType->name ?? 'Nincs megadva' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Oldalak száma</strong></td>
                                <td>{{ $requestQuote->websites ?? '0' }} oldal</td>
                            </tr>
                            <tr>
                                <td><strong>Grafikai terv</strong></td>
                                <td>
                                    @if($requestQuote->have_website_graphic)
                                        <span class="badge badge-success">Van grafikai terv</span>
                                    @else
                                        <span class="badge badge-warning">Nincs grafikai terv</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Többnyelvű</strong></td>
                                <td>
                                    @if($requestQuote->is_multilangual)
                                        <span class="badge badge-success">Igen</span>
                                    @else
                                        <span class="badge badge-info">Nem</span>
                                    @endif
                                </td>
                            </tr>
                            @if($requestQuote->default_language)
                            <tr>
                                <td><strong>Alapértelmezett nyelv</strong></td>
                                <td>{{ $requestQuote->default_language }}</td>
                            </tr>
                            @endif
                            @if($requestQuote->website_engine)
                            <tr>
                                <td><strong>Motor</strong></td>
                                <td>{{ $requestQuote->website_engine }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td><strong>Fizetési mód</strong></td>
                                <td>{{ $requestQuote->payment_method ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Fizetési státusz</strong></td>
                                <td>
                                    @if($requestQuote->is_payed)
                                        <span class="badge badge-success">Kifizetve</span>
                                    @else
                                        <span class="badge badge-warning">Fizetésre vár</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Teljes ár</strong></td>
                                <td>
                                    <span class="price-highlight">
                                        {{ number_format($requestQuote->total_price ?? 0, 0, ',', ' ') }} Ft
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Nyelvek -->
                @if($requestQuote->is_multilangual && $requestQuote->requestLanguages->count() > 0)
                <div class="section-divider"></div>
                <div class="info-section">
                    <h2>Nyelvek</h2>
                    <div class="languages-grid">
                        @foreach($requestQuote->requestLanguages as $language)
                        <div class="language-card">
                            <div class="language-flag">
                                @php
                                    $flags = [
                                        'hu' => '🇭🇺',
                                        'en' => '🇬🇧',
                                        'de' => '🇩🇪',
                                        'fr' => '🇫🇷',
                                        'es' => '🇪🇸',
                                        'it' => '🇮🇹',
                                        'ro' => '🇷🇴',
                                        'sk' => '🇸🇰',
                                        'hr' => '🇭🇷',
                                        'sr' => '🇷🇸',
                                    ];
                                    $langCode = strtolower(substr($language->language ?? '', 0, 2));
                                @endphp
                                {{ $flags[$langCode] ?? '🌐' }}
                            </div>
                            <div class="language-name">{{ $language->language ?? '-' }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Funkciók -->
                @if($requestQuote->requestQuoteFunctionalities->count() > 0)
                <div class="section-divider"></div>
                <div class="info-section">
                    <h2>Funkciók és szolgáltatások</h2>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Funkció neve</th>
                                <th>Típus</th>
                                <th>Ár</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requestQuote->requestQuoteFunctionalities as $functionality)
                            <tr>
                                <td><strong>{{ $functionality->name ?? '-' }}</strong></td>
                                <td>
                                    @if($functionality->is_default)
                                        <span class="badge badge-primary">Alapértelmezett</span>
                                    @else
                                        <span class="badge badge-info">Extra</span>
                                    @endif
                                </td>
                                <td>{{ number_format($functionality->price ?? 0, 0, ',', ' ') }} Ft</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                <!-- Projekt leírás -->
                @if($requestQuote->project_description)
                <div class="section-divider"></div>
                <div class="info-section">
                    <h2>Projekt leírás</h2>
                    <div style="background: #f9fafb; padding: 20px; border-radius: 8px; color: #4b5563; line-height: 1.6;">
                        {{ $requestQuote->project_description }}
                    </div>
                </div>
                @endif

            @else
                <div class="empty-state">
                    <p>Nincs árajánlat adat ehhez a projekthez.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>