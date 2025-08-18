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
        <h1>Form Question</h1>
        <p>This is a basic HTML template for the form question view.</p>

        <h2>Form Question Data</h2>
        <ul>
            <li><span class="label">ID:</span> {{ $formQuestion->id }}</li>
            <li><span class="label">Title:</span> {{ $formQuestion->title }}</li>
            <li><span class="label">Description:</span> {{ $formQuestion->description }}</li>
            <li><span class="label">Created At:</span> {{ $formQuestion->created_at }}</li>
            <li><span class="label">Updated At:</span> {{ $formQuestion->updated_at }}</li>
            <li><span class="label">Domain ID:</span> {{ $formQuestion->domain_id }}</li>
            <li><span class="label">Token:</span> {{ $formQuestion->token }}</li>
            <li><span class="label">Company Name:</span> {{ $formQuestion->company_name }}</li>
            <li><span class="label">Contact Name:</span> {{ $formQuestion->contact_name }}</li>
            <li><span class="label">Contact Email:</span> {{ $formQuestion->contact_email }}</li>
            <li><span class="label">Contact Phone:</span> {{ $formQuestion->contact_phone }}</li>
            <li><span class="label">Logo:</span> {{ $formQuestion->logo }}</li>
            <li><span class="label">Activities:</span> {{ $formQuestion->activities }}</li>
            <li><span class="label">Have Existing Website:</span> {{ $formQuestion->have_exist_website }}</li>
            <li><span class="label">Existing Website URL:</span> {{ $formQuestion->exist_website_url }}</li>
            <li><span class="label">Is Exact Deadline:</span> {{ $formQuestion->is_exact_deadline }}</li>
            <li><span class="label">Deadline:</span> {{ $formQuestion->deadline }}</li>
            <li><span class="label">Formatting Milestone:</span> {{ $formQuestion->formating_milestone }}</li>
            <li><span class="label">Visual Feeling:</span> {{ $formQuestion->visual_fealing }}</li>
            <li><span class="label">Tone of Website:</span> {{ $formQuestion->tone_of_website }}</li>
            <li><span class="label">Other Tone of Website:</span> {{ $formQuestion->other_tone_of_website }}</li>
            <li><span class="label">Have Existing Design:</span> {{ $formQuestion->have_exist_design }}</li>
            <li><span class="label">Inspire Websites:</span>
                <ul>
                    @foreach ($formQuestion->inspire_websites ?? [] as $website)
                        <li>{{ $website }}</li>
                    @endforeach
                </ul>
            </li>
            <li><span class="label">Banned Elements:</span>
                <ul>
                    @foreach ($formQuestion->banned_elements ?? [] as $element)
                        <li>{{ $element }}</li>
                    @endforeach
                </ul>
            </li>
            <li><span class="label">Primary Color:</span> {{ $formQuestion->primary_color }}</li>
            <li><span class="label">Secondary Color:</span> {{ $formQuestion->secondary_color }}</li>
            <li><span class="label">Additional Colors:</span>
                <ul>
                    @foreach ($formQuestion->additional_colors ?? [] as $color)
                        <li>{{ $color }}</li>
                    @endforeach
                </ul>
            </li>
            <li><span class="label">Preferred Font Types:</span>
                <ul>
                    @foreach ($formQuestion->prefered_font_types ?? [] as $font)
                        <li>{{ $font }}</li>
                    @endforeach
                </ul>
            </li>
            <li><span class="label">Use Video or Animation:</span> {{ $formQuestion->use_video_or_animation }}</li>
            <li><span class="label">Own Company Videos:</span>
                <ul>
                    @foreach ($formQuestion->own_company_videos ?? [] as $video)
                        <li>{{ $video }}</li>
                    @endforeach
                </ul>
            </li>
            <li><span class="label">Main Pages:</span>
                <ul>
                    @foreach ($formQuestion->main_pages ?? [] as $pages)
                        <li>
                            <ul>
                                @foreach ($pages ?? [] as $page)
                                    <li>{{ $page }}</li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li><span class="label">Other Pages:</span> {{ $formQuestion->other_pages }}</li>
            <li><span class="label">Have Product Catalog:</span> {{ $formQuestion->have_product_catalog }}</li>
            <li><span class="label">Product Catalog:</span>
                <ul>
                    @foreach ($formQuestion->product_catalog ?? [] as $catalog)
                        <li>{{ $catalog }}</li>
                    @endforeach
                </ul>
            </li>
            <li><span class="label">Need Multi Language:</span> {{ $formQuestion->need_multi_language }}</li>
            <li><span class="label">Languages for Website:</span> {{ $formQuestion->languages_for_website }}</li>
            <li><span class="label">Call to Actions:</span> {{ $formQuestion->call_to_actions }}</li>
            <li><span class="label">Have Blog:</span> {{ $formQuestion->have_blog }}</li>
            <li><span class="label">Existing Blog Count:</span> {{ $formQuestion->exist_blog_count }}</li>
            <li><span class="label">Importance of SEO:</span> {{ $formQuestion->importance_of_seo }}</li>
            <li><span class="label">Have Paid Advertising:</span> {{ $formQuestion->have_payed_advertising }}</li>
            <li><span class="label">Other Expectation or Request:</span>
                {{ $formQuestion->other_expectation_or_request }}</li>
            <li><span class="label">Products CSV File:</span> {{ $formQuestion->products_csv_file }}</li>
            <li><span class="label">Highlighted Categories:</span>
                <ul>
                    @foreach ($formQuestion->highlighted_categories ?? [] as $category)
                        <li>{{ $category }}</li>
                    @endforeach
                </ul>
            </li>
            <li><span class="label">Bruto Netto:</span> {{ $formQuestion->bruto_netto }}</li>
            <li><span class="label">Store Address:</span> {{ $formQuestion->store_address }}</li>
            <li><span class="label">Shipping Address:</span> {{ $formQuestion->shipping_address }}</li>
            <li><span class="label">Parcel Points:</span>
                <ul>
                    @foreach ($formQuestion->parcel_points ?? [] as $point)
                        <li>{{ $point }}</li>
                    @endforeach
                </ul>
            </li>
            <li><span class="label">Have Contracted Accountant:</span> {{ $formQuestion->have_contracted_accountant }}
            </li>
            <li><span class="label">Contracted Accountants:</span>
                <ul>
                    @foreach ($formQuestion->contracted_accountants ?? [] as $accountant)
                        <li>{{ $accountant }}</li>
                    @endforeach
                </ul>
            </li>
            <li><span class="label">Payment Methods:</span>
                <ul>
                    @foreach ($formQuestion->payment_methods ?? [] as $method)
                        <li>{{ $method }}</li>
                    @endforeach
                </ul>
            </li>
            <li><span class="label">Have Contracted Online Bank Card Payment:</span>
                {{ $formQuestion->have_contracted_online_bank_card_payment }}</li>
            <li><span class="label">Online Bank Card Payment Options:</span>
                <ul>
                    @foreach ($formQuestion->online_bank_card_payment_options ?? [] as $option)
                        <li>{{ $option }}</li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </body>

</html>
