<!DOCTYPE html>
<html lang="hu">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Árajánlatkérés - {{ $formQuestion->company_name }}</title>
        <style>
            @page {
                margin: 30px;
                size: A4;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: DejaVu Sans, sans-serif;
                color: #1a202c;
                line-height: 1.6;
                font-size: 11px;
                background: #f7fafc;
            }

            /* Header styling */
            .header {
                background: linear-gradient(135deg, #5B21B6 0%, #7C3AED 50%, #8B5CF6 100%);
                padding: 30px;
                margin: -30px -30px 30px -30px;
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            .header::before {
                content: '';
                position: absolute;
                top: -50%;
                right: -10%;
                width: 40%;
                height: 200%;
                background: rgba(255, 255, 255, 0.05);
                transform: rotate(35deg);
            }

            h1 {
                color: #ffffff;
                font-size: 24px;
                font-weight: 700;
                letter-spacing: 0.5px;
                text-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
                position: relative;
                z-index: 1;
            }

            .subtitle {
                color: rgba(255, 255, 255, 0.9);
                font-size: 12px;
                margin-top: 5px;
                position: relative;
                z-index: 1;
            }

            /* Section headers */
            h2 {
                color: #2d3748;
                font-size: 14px;
                font-weight: 700;
                margin: 25px 0 15px 0;
                padding: 10px 15px;
                background: linear-gradient(90deg, #f7fafc 0%, #edf2f7 100%);
                border-left: 4px solid #7C3AED;
                border-radius: 0 4px 4px 0;
                text-transform: none;
                letter-spacing: 0.3px;
                page-break-after: avoid;
            }

            /* Main content list */
            ul {
                list-style: none;
                padding: 0;
                margin: 0 0 20px 0;
            }

            /* Main list items */
            li {
                background: #ffffff;
                margin: 0 0 8px 0;
                padding: 12px 18px;
                border: 1px solid #e2e8f0;
                border-radius: 6px;
                position: relative;
                page-break-inside: avoid;
                transition: all 0.2s;
            }

            /* Remove hover effect for print */
            @media print {
                li {
                    border: 1px solid #e2e8f0 !important;
                }
            }

            /* Labels */
            .label {
                font-weight: 600;
                color: #4a5568;
                display: inline-block;
                min-width: 180px;
                margin-right: 15px;
                font-size: 11px;
                position: relative;
            }

            .label::after {
                content: ':';
                position: absolute;
                right: 10px;
            }

            /* Values */
            .value {
                color: #2d3748;
                font-size: 11px;
            }

            /* Nested lists */
            li ul {
                margin: 10px 0 0 195px;
                padding: 10px;
                background: #f8fafc;
                border-radius: 4px;
                border-left: 3px solid #cbd5e0;
            }

            li ul li {
                background: transparent;
                border: none;
                border-radius: 0;
                padding: 6px 8px;
                margin: 4px 0;
                font-size: 10px;
                border-left: 2px solid #e2e8f0;
            }

            li ul li:last-child {
                margin-bottom: 0;
            }

            /* Boolean values styling */
            .boolean-yes {
                color: #22c55e;
                font-weight: 600;
                padding: 2px 8px;
                background: #dcfce7;
                border-radius: 4px;
                display: inline-block;
            }

            .boolean-no {
                color: #ef4444;
                font-weight: 600;
                padding: 2px 8px;
                background: #fee2e2;
                border-radius: 4px;
                display: inline-block;
            }

            /* Empty value styling */
            .empty {
                color: #9ca3af;
                font-style: italic;
                font-size: 10px;
            }

            /* Color display */
            .color-display {
                display: inline-flex;
                align-items: center;
                gap: 8px;
            }

            .color-box {
                display: inline-block;
                width: 24px;
                height: 24px;
                border-radius: 4px;
                border: 2px solid #e5e7eb;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            }

            .color-value {
                font-family: monospace;
                font-size: 10px;
                color: #6b7280;
                background: #f3f4f6;
                padding: 2px 6px;
                border-radius: 3px;
            }

            /* Status badge */
            .status-badge {
                display: inline-block;
                padding: 4px 12px;
                border-radius: 16px;
                font-size: 10px;
                font-weight: 600;
                background: linear-gradient(90deg, #8B5CF6 0%, #7C3AED 100%);
                color: #ffffff;
                text-transform: uppercase;
                letter-spacing: 0.3px;
            }

            /* Rich text content */
            li ul.rich-content {
                background: #fefefe;
                border-left: 3px solid #8B5CF6;
                padding: 12px;
                margin-top: 8px;
            }

            li ul.rich-content li {
                border-left: none;
                padding-left: 0;
            }

            /* Page info */
            .page-info {
                background: #faf5ff;
                border: 1px solid #e9d5ff;
                padding: 10px;
                border-radius: 4px;
                margin: 5px 0;
            }

            .page-info strong {
                color: #7C3AED;
                display: block;
                margin-bottom: 4px;
            }

            /* Footer */
            .footer {
                margin-top: 30px;
                padding-top: 15px;
                border-top: 2px solid #e2e8f0;
                text-align: center;
                color: #6b7280;
                font-size: 9px;
            }

            /* Improve readability */
            @media print {
                body {
                    background: white;
                }
                
                .header {
                    background: #7C3AED !important;
                    print-color-adjust: exact;
                    -webkit-print-color-adjust: exact;
                }
                
                h2 {
                    background: #f7fafc !important;
                    print-color-adjust: exact;
                    -webkit-print-color-adjust: exact;
                }
            }
        </style>
    </head>

    <body>
        <div class="header">
            <h1>Árajánlatkérés részletei</h1>
            <div class="subtitle">{{ $formQuestion->company_name }}</div>
        </div>

        <h2>Alapvető információk</h2>
        <ul>
            <li><span class="label">Azonosító</span> <span class="value">{{ $formQuestion->id }}</span></li>
            <li><span class="label">Létrehozva</span> <span class="value">{{ $formQuestion->created_at->format('Y. m. d. H:i') }}</span></li>
            <li><span class="label">Utoljára módosítva</span> <span class="value">{{ $formQuestion->updated_at->format('Y. m. d. H:i') }}</span></li>
            <li><span class="label">Domain ID</span> <span class="value">{{ $formQuestion->domain_id }}</span></li>
            <li><span class="label">Token</span> <span class="value">{{ $formQuestion->token }}</span></li>
            <li><span class="label">Státusz</span> 
                @if($formQuestion->status)
                    <span class="status-badge">{{ $formQuestion->status->value }}</span>
                @else
                    <span class="empty">-</span>
                @endif
            </li>
            <li><span class="label">Felhasználó ID</span> <span class="value">{{ $formQuestion->user_id }}</span></li>
            <li><span class="label">Projekt ID</span> <span class="value">{{ $formQuestion->project_id }}</span></li>
        </ul>

        <h2>Cég információk</h2>
        <ul>
            <li><span class="label">Cég név</span> <span class="value">{{ $formQuestion->company_name }}</span></li>
            <li><span class="label">Kapcsolattartó neve</span> <span class="value">{{ $formQuestion->contact_name }}</span></li>
            <li><span class="label">Kapcsolattartó email</span> <span class="value">{{ $formQuestion->contact_email }}</span></li>
            <li><span class="label">Kapcsolattartó telefon</span> <span class="value">{{ $formQuestion->contact_phone }}</span></li>
            <li><span class="label">Kapcsolattartó pozíció</span> <span class="value">{{ $formQuestion->contact_positsion }}</span></li>
            <li><span class="label">Logo</span> <span class="value">{{ $formQuestion->logo ?: '-' }}</span></li>
            <li><span class="label">Tevékenységek</span>
                @if (is_array($formQuestion->activities) || is_object($formQuestion->activities))
                    <ul>
                        @foreach ($formQuestion->activities as $activity)
                            <li>{{ $activity }}</li>
                        @endforeach
                    </ul>
                @elseif(!empty($formQuestion->activities))
                    {{ $formQuestion->activities }}
                @else
                    -
                @endif
            </li>
        </ul>

        <h2>Weboldal információk</h2>
        <ul>
            <li><span class="label">Van meglévő weboldal</span>
                <span class="{{ $formQuestion->have_exist_website ? 'boolean-yes' : 'boolean-no' }}">{{ $formQuestion->have_exist_website ? 'Igen' : 'Nem' }}</span></li>
            <li><span class="label">Meglévő weboldal URL</span> 
                @if($formQuestion->exist_website_url)
                    <span class="value">{{ $formQuestion->exist_website_url }}</span>
                @else
                    <span class="empty">-</span>
                @endif
            </li>
            <li><span class="label">Pontos határidő</span>
                <span class="{{ $formQuestion->is_exact_deadline ? 'boolean-yes' : 'boolean-no' }}">{{ $formQuestion->is_exact_deadline ? 'Igen' : 'Nem' }}</span>
            </li>
            <li><span class="label">Határidő</span>
                @if($formQuestion->deadline)
                    <span class="value">{{ $formQuestion->deadline->format('Y. m. d.') }}</span>
                @else
                    <span class="empty">-</span>
                @endif
            </li>
            <li><span class="label">Cég bemutatása</span> 
                @if($formQuestion->formating_milestone)
                    <span class="value">{{ $formQuestion->formating_milestone }}</span>
                @else
                    <span class="empty">-</span>
                @endif
            </li>
            <li><span class="label">Vizuális érzet</span> 
                @if($formQuestion->visual_feeling)
                    <span class="value">{{ $formQuestion->visual_feeling }}</span>
                @else
                    <span class="empty">-</span>
                @endif
            </li>
            <li><span class="label">Weboldal hangvétele</span> 
                @if($formQuestion->tone_of_website)
                    <span class="value">{{ $formQuestion->tone_of_website }}</span>
                @else
                    <span class="empty">-</span>
                @endif
            </li>
        </ul>

        <h2>Dizájn információk</h2>
        <ul>
            <li><span class="label">Van meglévő dizájn</span>
                <span class="{{ $formQuestion->have_exist_design ? 'boolean-yes' : 'boolean-no' }}">{{ $formQuestion->have_exist_design ? 'Igen' : 'Nem' }}</span></li>
            <li><span class="label">Dizájn fájlok</span>
                @if (is_array($formQuestion->design_files) || is_object($formQuestion->design_files))
                    <ul>
                        @foreach ($formQuestion->design_files as $file)
                            <li>{{ $file }}</li>
                        @endforeach
                    </ul>
                @elseif(!empty($formQuestion->design_files))
                    {{ $formQuestion->design_files }}
                @else
                    -
                @endif
            </li>
            <li><span class="label">Saját céges képek</span>
                @if (is_array($formQuestion->own_company_images) || is_object($formQuestion->own_company_images))
                    <ul>
                        @foreach ($formQuestion->own_company_images as $img)
                            <li>{{ $img }}</li>
                        @endforeach
                    </ul>
                @elseif(!empty($formQuestion->own_company_images))
                    {{ $formQuestion->own_company_images }}
                @else
                    -
                @endif
            </li>

            <li><span class="label">Nem kívánatos elemek</span>
                @if (is_array($formQuestion->banned_elements) || is_object($formQuestion->banned_elements))
                    <ul>
                        @foreach ($formQuestion->banned_elements as $element)
                            <li>{{ $element }}</li>
                        @endforeach
                    </ul>
                @elseif(!empty($formQuestion->banned_elements))
                    {{ $formQuestion->banned_elements }}
                @else
                    -
                @endif
            </li>
            <li><span class="label">Elsődleges szín</span> 
                @if($formQuestion->primary_color)
                    <span class="color-display">
                        <span class="color-box" style="background-color: {{ $formQuestion->primary_color }}"></span>
                        <span class="color-value">{{ $formQuestion->primary_color }}</span>
                    </span>
                @else
                    <span class="empty">-</span>
                @endif
            </li>
            <li><span class="label">Másodlagos szín</span> 
                @if($formQuestion->secondary_color)
                    <span class="color-display">
                        <span class="color-box" style="background-color: {{ $formQuestion->secondary_color }}"></span>
                        <span class="color-value">{{ $formQuestion->secondary_color }}</span>
                    </span>
                @else
                    <span class="empty">-</span>
                @endif
            </li>
            <li><span class="label">További színek</span>
                @if (is_array($formQuestion->additional_colors) || is_object($formQuestion->additional_colors))
                    <ul>
                        @foreach ($formQuestion->additional_colors as $color)
                            <li>
                                <span class="color-display">
                                    <span class="color-box" style="background-color: {{ $color }}"></span>
                                    <span class="color-value">{{ $color }}</span>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @elseif(!empty($formQuestion->additional_colors))
                    {{ $formQuestion->additional_colors }}
                @else
                    -
                @endif
            </li>
            <li><span class="label">Preferált betűtípusok</span>
                @if (is_array($formQuestion->prefered_font_types) || is_object($formQuestion->prefered_font_types))
                    <ul>
                        @foreach ($formQuestion->prefered_font_types as $font)
                            <li>{{ $font }}</li>
                        @endforeach
                    </ul>
                @elseif(!empty($formQuestion->prefered_font_types))
                    {{ $formQuestion->prefered_font_types }}
                @else
                    -
                @endif
            </li>
        </ul>

        <h2>Média és tartalom</h2>
        <ul>
            <li><span class="label">Videó vagy animáció használata</span>
                <span class="{{ $formQuestion->use_video_or_animation ? 'boolean-yes' : 'boolean-no' }}">{{ $formQuestion->use_video_or_animation ? 'Igen' : 'Nem' }}</span></li>
            <li><span class="label">Saját céges videók</span>
                @if (is_array($formQuestion->own_company_videos) || is_object($formQuestion->own_company_videos))
                    <ul>
                        @foreach ($formQuestion->own_company_videos as $video)
                            <li>{{ $video }}</li>
                        @endforeach
                    </ul>
                @elseif(!empty($formQuestion->own_company_videos))
                    {{ $formQuestion->own_company_videos }}
                @else
                    -
                @endif
            </li>
            <li><span class="label">Főoldalak</span>
                @if (is_array($formQuestion->main_pages) || is_object($formQuestion->main_pages))
                    <ul>
                        @foreach ($formQuestion->main_pages as $page)
                            <li>
                                @php
                                    $name = null;
                                    $desc = '';
                                    if (is_array($page)) {
                                        $name = $page['name'] ?? null;
                                        $desc = isset($page['description'])
                                            ? trim(strip_tags($page['description']))
                                            : '';
                                    } elseif (is_object($page)) {
                                        $name = $page->name ?? null;
                                        $desc = isset($page->description) ? trim(strip_tags($page->description)) : '';
                                    }
                                @endphp
                                @if (!empty($name))
                                    <div class="page-info">
                                        <strong>{{ $name }}</strong>
                                        @if (!empty($desc))
                                            <div>{!! is_array($page) ? $page['description'] : $page->description !!}</div>
                                        @endif
                                    </div>
                                @else
                                    <span class="empty">-</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    -
                @endif
            </li>

        </ul>

        <h2>Termék katalógus</h2>
        <ul>
            <li><span class="label">Van termék katalógus</span>
                <span class="{{ $formQuestion->have_product_catalog ? 'boolean-yes' : 'boolean-no' }}">{{ $formQuestion->have_product_catalog ? 'Igen' : 'Nem' }}</span></li>
            <li><span class="label">Termék katalógus</span>
                @if (is_array($formQuestion->product_catalog) || is_object($formQuestion->product_catalog))
                    <ul>
                        @foreach ($formQuestion->product_catalog as $catalog)
                            <li>{{ is_scalar($catalog) ? $catalog : json_encode($catalog) }}</li>
                        @endforeach
                    </ul>
                @elseif(!empty($formQuestion->product_catalog))
                    {{ $formQuestion->product_catalog }}
                @else
                    -
                @endif
            </li>
        </ul>

        <h2>Nyelvi beállítások és CTA</h2>
        <ul>
            <li><span class="label">Többnyelvű oldal</span>
                <span class="{{ $formQuestion->need_multi_language ? 'boolean-yes' : 'boolean-no' }}">{{ $formQuestion->need_multi_language ? 'Igen' : 'Nem' }}</span></li>
            <li><span class="label">Weboldal nyelvei</span>
                @if (is_array($formQuestion->languages_for_website) || is_object($formQuestion->languages_for_website))
                    <ul>
                        @foreach ($formQuestion->languages_for_website as $language)
                            <li>{{ $language }}</li>
                        @endforeach
                    </ul>
                @elseif(!empty($formQuestion->languages_for_website))
                    <span class="value">{{ $formQuestion->languages_for_website }}</span>
                @else
                    <span class="empty">-</span>
                @endif
            </li>
            <li><span class="label">Call to Action-ök</span>
                @if (is_array($formQuestion->call_to_actions) || is_object($formQuestion->call_to_actions))
                    <ul>
                        @foreach ($formQuestion->call_to_actions as $cta)
                            <li>{{ is_scalar($cta) ? $cta : json_encode($cta) }}</li>
                        @endforeach
                    </ul>
                @elseif(!empty($formQuestion->call_to_actions))
                    {{ $formQuestion->call_to_actions }}
                @else
                    -
                @endif
            </li>
        </ul>

        <h2>Marketing és SEO</h2>
        <ul>
            <li><span class="label">Blog</span> 
                <span class="{{ $formQuestion->have_blog ? 'boolean-yes' : 'boolean-no' }}">{{ $formQuestion->have_blog ? 'Igen' : 'Nem' }}</span></li>
            <li><span class="label">Meglévő blog bejegyzések száma</span>
                @if($formQuestion->exist_blog_count)
                    <span class="value">{{ $formQuestion->exist_blog_count }}</span>
                @else
                    <span class="empty">-</span>
                @endif
            </li>
            <li><span class="label">SEO fontossága</span> 
                <span class="{{ $formQuestion->importance_of_seo ? 'boolean-yes' : 'boolean-no' }}">{{ $formQuestion->importance_of_seo ? 'Igen' : 'Nem' }}</span>
            </li>
            <li><span class="label">Fizetett hirdetés</span>
                <span class="{{ $formQuestion->have_payed_advertising ? 'boolean-yes' : 'boolean-no' }}">{{ $formQuestion->have_payed_advertising ? 'Igen' : 'Nem' }}</span></li>
            <li><span class="label">Egyéb elvárások vagy kérések</span>
                @if($formQuestion->other_expectation_or_request)
                    <span class="value">{{ $formQuestion->other_expectation_or_request }}</span>
                @else
                    <span class="empty">-</span>
                @endif
            </li>
        </ul>

        <h2>Webshop információk</h2>
        <ul>
            <li><span class="label">Termék CSV fájl</span>
                @if (is_array($formQuestion->products_csv_file) || is_object($formQuestion->products_csv_file))
                    <ul>
                        @foreach ($formQuestion->products_csv_file as $csv)
                            <li>{{ $csv }}</li>
                        @endforeach
                    </ul>
                @elseif(!empty($formQuestion->products_csv_file))
                    {{ $formQuestion->products_csv_file }}
                @else
                    -
                @endif
            </li>
            <li><span class="label">Kiemelt kategóriák</span>
                @if (is_array($formQuestion->highlighted_categories) || is_object($formQuestion->highlighted_categories))
                    <ul>
                        @foreach ($formQuestion->highlighted_categories as $category)
                            <li>{{ $category }}</li>
                        @endforeach
                    </ul>
                @elseif(!empty($formQuestion->highlighted_categories))
                    {{ $formQuestion->highlighted_categories }}
                @else
                    -
                @endif
            </li>
            <li><span class="label">Bruttó/Nettó</span> 
                @if($formQuestion->bruto_netto)
                    <span class="value">{{ $formQuestion->bruto_netto }}</span>
                @else
                    <span class="empty">-</span>
                @endif
            </li>
            <li><span class="label">Üzlet címe</span> 
                @if($formQuestion->store_address)
                    <span class="value">{{ $formQuestion->store_address }}</span>
                @else
                    <span class="empty">-</span>
                @endif
            </li>
            <li><span class="label">Szállítási cím</span> 
                @if($formQuestion->shipping_address)
                    <span class="value">{{ $formQuestion->shipping_address }}</span>
                @else
                    <span class="empty">-</span>
                @endif
            </li>
            <li><span class="label">Csomagpontok</span>
                @if (is_array($formQuestion->parcel_points) || is_object($formQuestion->parcel_points))
                    <ul>
                        @foreach ($formQuestion->parcel_points as $point)
                            <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                @elseif(!empty($formQuestion->parcel_points))
                    {{ $formQuestion->parcel_points }}
                @else
                    -
                @endif
            </li>
        </ul>

        <h2>Pénzügyi információk</h2>
        <ul>
            <li><span class="label">Van szerződött könyvelő</span>
                <span class="{{ $formQuestion->have_contracted_accountant ? 'boolean-yes' : 'boolean-no' }}">{{ $formQuestion->have_contracted_accountant ? 'Igen' : 'Nem' }}</span></li>
            <li><span class="label">Szerződött könyvelők</span>
                @if (is_array($formQuestion->contracted_accountants) || is_object($formQuestion->contracted_accountants))
                    <ul>
                        @foreach ($formQuestion->contracted_accountants as $accountant)
                            <li>{{ $accountant }}</li>
                        @endforeach
                    </ul>
                @elseif(!empty($formQuestion->contracted_accountants))
                    {{ $formQuestion->contracted_accountants }}
                @else
                    -
                @endif
            </li>
            <li><span class="label">Fizetési módok</span>
                @if (is_array($formQuestion->payment_methods) || is_object($formQuestion->payment_methods))
                    <ul>
                        @foreach ($formQuestion->payment_methods as $method)
                            <li>{{ $method }}</li>
                        @endforeach
                    </ul>
                @elseif(!empty($formQuestion->payment_methods))
                    {{ $formQuestion->payment_methods }}
                @else
                    -
                @endif
            </li>
            <li><span class="label">Van szerződött online bankkártya fizetés</span>
                <span class="{{ $formQuestion->have_contracted_online_bank_card_payment ? 'boolean-yes' : 'boolean-no' }}">{{ $formQuestion->have_contracted_online_bank_card_payment ? 'Igen' : 'Nem' }}</span></li>
            <li><span class="label">Online bankkártya fizetési opciók</span>
                @if (is_array($formQuestion->online_bank_card_payment_options) ||
                        is_object($formQuestion->online_bank_card_payment_options))
                    <ul>
                        @foreach ($formQuestion->online_bank_card_payment_options as $option)
                            <li>{{ $option }}</li>
                        @endforeach
                    </ul>
                @elseif(!empty($formQuestion->online_bank_card_payment_options))
                    {{ $formQuestion->online_bank_card_payment_options }}
                @else
                    -
                @endif
            </li>
        </ul>

        <div class="footer">
            Generálva: {{ now()->format('Y. m. d. H:i') }}
        </div>
    </body>

</html>
