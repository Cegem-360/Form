<!DOCTYPE html>
<html lang="hu">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form Question</title>
        <style>
            body {
                font-family: DejaVu Sans;
                margin: 20px;
            }

            h1,
            h2 {
                color: #2c3e50;
            }

            ul {
                list-style-type: none;
                padding: 0;
            }

            li {
                background: #ecf0f1;
                margin: 5px 0;
                padding: 10px;
                border-radius: 5px;
            }

            .label {
                font-weight: bold;
                color: #2980b9;
            }
        </style>
    </head>

    <body>
        <h1>Árajánlatkérés részletei</h1>

        <h2>Alapvető információk</h2>
        <ul>
            <li><span class="label">Azonosító:</span> {{ $formQuestion->id }}</li>
            <li><span class="label">Létrehozva:</span> {{ $formQuestion->created_at->format('Y-m-d H:i') }}</li>
            <li><span class="label">Utoljára módosítva:</span> {{ $formQuestion->updated_at->format('Y-m-d H:i') }}</li>
            <li><span class="label">Domain ID:</span> {{ $formQuestion->domain_id }}</li>
            <li><span class="label">Token:</span> {{ $formQuestion->token }}</li>
            <li><span class="label">Státusz:</span> {{ $formQuestion->status ? $formQuestion->status->value : '-' }}
            </li>
            <li><span class="label">Felhasználó ID:</span> {{ $formQuestion->user_id }}</li>
            <li><span class="label">Projekt ID:</span> {{ $formQuestion->project_id }}</li>
        </ul>

        <h2>Cég információk</h2>
        <ul>
            <li><span class="label">Cég név:</span> {{ $formQuestion->company_name }}</li>
            <li><span class="label">Kapcsolattartó neve:</span> {{ $formQuestion->contact_name }}</li>
            <li><span class="label">Kapcsolattartó email:</span> {{ $formQuestion->contact_email }}</li>
            <li><span class="label">Kapcsolattartó telefon:</span> {{ $formQuestion->contact_phone }}</li>
            <li><span class="label">Kapcsolattartó pozíció:</span> {{ $formQuestion->contact_positsion }}</li>
            <li><span class="label">Logo:</span> {{ $formQuestion->logo }}</li>
            <li><span class="label">Tevékenységek:</span>
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
            <li><span class="label">Van meglévő weboldal:</span>
                {{ $formQuestion->have_exist_website ? 'Igen' : 'Nem' }}</li>
            <li><span class="label">Meglévő weboldal URL:</span> {{ $formQuestion->exist_website_url ?: '-' }}</li>
            <li><span class="label">Pontos határidő:</span> {{ $formQuestion->is_exact_deadline ? 'Igen' : 'Nem' }}
            </li>
            <li><span class="label">Határidő:</span>
                {{ $formQuestion->deadline ? $formQuestion->deadline->format('Y-m-d') : '-' }}
            </li>
            <li><span class="label">Cég bemutatása:</span> {{ $formQuestion->formating_milestone ?: '-' }}</li>
            <li><span class="label">Vizuális érzet:</span> {{ $formQuestion->visual_feeling ?: '-' }}</li>
            <li><span class="label">Weboldal hangvétele:</span> {{ $formQuestion->tone_of_website ?: '-' }}</li>
        </ul>

        <h2>Dizájn információk</h2>
        <ul>
            <li><span class="label">Van meglévő dizájn:</span>
                {{ $formQuestion->have_exist_design ? 'Igen' : 'Nem' }}</li>
            <li><span class="label">Dizájn fájlok:</span>
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
            <li><span class="label">Saját céges képek:</span>
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

            <li><span class="label">Nem kívánatos elemek:</span>
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
            <li><span class="label">Elsődleges szín:</span> {{ $formQuestion->primary_color ?: '-' }}</li>
            <li><span class="label">Másodlagos szín:</span> {{ $formQuestion->secondary_color ?: '-' }}</li>
            <li><span class="label">További színek:</span>
                @if (is_array($formQuestion->additional_colors) || is_object($formQuestion->additional_colors))
                    <ul>
                        @foreach ($formQuestion->additional_colors as $color)
                            <li>{{ $color }}</li>
                        @endforeach
                    </ul>
                @elseif(!empty($formQuestion->additional_colors))
                    {{ $formQuestion->additional_colors }}
                @else
                    -
                @endif
            </li>
            <li><span class="label">Preferált betűtípusok:</span>
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
            <li><span class="label">Videó vagy animáció használata:</span>
                {{ $formQuestion->use_video_or_animation ? 'Igen' : 'Nem' }}</li>
            <li><span class="label">Saját céges videók:</span>
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
            <li><span class="label">Főoldalak:</span>
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
                                    <div><strong>{{ $name }}</strong></div>
                                    @if (!empty($desc))
                                        <div>{!! is_array($page) ? $page['description'] : $page->description !!}</div>
                                    @endif
                                @else
                                    -
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
            <li><span class="label">Van termék katalógus:</span>
                {{ $formQuestion->have_product_catalog ? 'Igen' : 'Nem' }}</li>
            <li><span class="label">Termék katalógus:</span>
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
            <li><span class="label">Többnyelvű oldal:</span>
                {{ $formQuestion->need_multi_language ? 'Igen' : 'Nem' }}</li>
            <li><span class="label">Weboldal nyelvei:</span> {{ $formQuestion->languages_for_website ?: '-' }}</li>
            <li><span class="label">Call to Action-ök:</span>
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
            <li><span class="label">Blog:</span> {{ $formQuestion->have_blog ? 'Igen' : 'Nem' }}</li>
            <li><span class="label">Meglévő blog bejegyzések száma:</span>
                {{ $formQuestion->exist_blog_count ?: '-' }}</li>
            <li><span class="label">SEO fontossága:</span> {{ $formQuestion->importance_of_seo ? 'Igen' : 'Nem' }}
            </li>
            <li><span class="label">Fizetett hirdetés:</span>
                {{ $formQuestion->have_payed_advertising ? 'Igen' : 'Nem' }}</li>
            <li><span class="label">Egyéb elvárások vagy kérések:</span>
                {{ $formQuestion->other_expectation_or_request ?: '-' }}</li>
        </ul>

        <h2>Webshop információk</h2>
        <ul>
            <li><span class="label">Termék CSV fájl:</span>
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
            <li><span class="label">Kiemelt kategóriák:</span>
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
            <li><span class="label">Bruttó/Nettó:</span> {{ $formQuestion->bruto_netto ?: '-' }}</li>
            <li><span class="label">Üzlet címe:</span> {{ $formQuestion->store_address ?: '-' }}</li>
            <li><span class="label">Szállítási cím:</span> {{ $formQuestion->shipping_address ?: '-' }}</li>
            <li><span class="label">Csomagpontok:</span>
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
            <li><span class="label">Van szerződött könyvelő:</span>
                {{ $formQuestion->have_contracted_accountant ? 'Igen' : 'Nem' }}</li>
            <li><span class="label">Szerződött könyvelők:</span>
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
            <li><span class="label">Fizetési módok:</span>
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
            <li><span class="label">Van szerződött online bankkártya fizetés:</span>
                {{ $formQuestion->have_contracted_online_bank_card_payment ? 'Igen' : 'Nem' }}</li>
            <li><span class="label">Online bankkártya fizetési opciók:</span>
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
    </body>

</html>
