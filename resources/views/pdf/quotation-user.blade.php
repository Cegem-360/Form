<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quotation</title>
        <style>
            /* Inline CSS from your app's styles */
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                line-height: 1.6;
            }

            .container {
                width: 100%;
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
            }

            .header {
                text-align: center;
                margin-bottom: 20px;
            }

            .header h1 {
                margin: 0;
                font-size: 24px;
            }

            .quotation-details {
                margin-bottom: 20px;
            }

            .quotation-details p {
                margin: 5px 0;
            }

            .footer {
                text-align: center;
                margin-top: 20px;
                font-size: 12px;
                color: #777;
            }
        </style>
        @vite(['resources/js/app.js'])

    </head>

    <body>
        <div class="container">
            <div class="header">
                <h1>Quotation</h1>
            </div>
            <div class="quotation-details">
                <p><strong>Quotation ID:</strong> {{ $requestQuote->id }}</p>
                <p><strong>Customer Name:</strong> {{ $requestQuote->customer_name }}</p>
                <p><strong>Email:</strong> {{ $requestQuote->email }}</p>
                <p><strong>Phone:</strong> {{ $requestQuote->phone }}</p>
                <p><strong>Project Description:</strong> {{ $requestQuote->project_description }}</p>
                <p><strong>Company Name:</strong> {{ $requestQuote->company_name }}</p>
                <p><strong>Website Type:</strong> {{ $requestQuote->websiteType()->first()->name ?? 'N/A' }}</p>
                <p><strong>Have Website Graphic:</strong> {{ $requestQuote->have_website_graphic ? 'Yes' : 'No' }}</p>
                <p><strong>Is Multilingual:</strong> {{ $requestQuote->is_multilangual ? 'Yes' : 'No' }}</p>
                <p><strong>Languages:</strong> {{ implode(', ', $requestQuote->languages ?? []) }}</p>
                <p><strong>Is E-commerce:</strong> {{ $requestQuote->is_ecommerce ? 'Yes' : 'No' }}</p>
                <p><strong>E-commerce Functionalities:</strong>
                    {{ implode(', ', $requestQuote->ecommerce_functionalities ?? []) }}</p>
                <p><strong>Website Engine:</strong> {{ $requestQuote->website_engine }}</p>
            </div>

            <div class="calculation">
                <h3>Cost Calculation</h3>

                @foreach ($requestQuote->websites as $page)
                    <p><strong>{{ $page['name'] }}:</strong> <strong>Cost:</strong>
                        {{ match ($page['length']) {
                            'short' => number_format(20000, 0, ',', ' ') . ' Ft',
                            'medium' => number_format(40000, 0, ',', ' ') . ' Ft',
                            'long' => number_format(70000, 0, ',', ' ') . ' Ft',
                            default => number_format(0, 0, ',', ' ') . ' Ft',
                        } }}
                    </p>
                    <p></p>
                @endforeach
            </div>
            <div class="footer">
                <p>Thank you for choosing our services!</p>
            </div>
        </div>
    </body>

</html>
