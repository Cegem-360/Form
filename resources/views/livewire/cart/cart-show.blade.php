<div class="container p-6 mx-auto">
    <h1 class="mb-4 text-2xl font-bold">Your Cart</h1>

    <!-- Pages Section -->
    <div class="mt-8">
        <h2 class="mb-4 text-xl font-bold">Pages</h2>
        <ul class="bg-white divide-y divide-gray-200 rounded-lg shadow-md">
            @foreach ($this->requestQuote->websites as $page)
                <li class="p-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="font-medium">
                            {{ $page['name'] }}
                        </div>
                        <div class="text-right text-gray-500">
                            Length: {{ $page['length'] }} |
                            Price:
                            {{ match ($page['length']) {
                                'short' => Number::currency(20000, in: 'HUF', locale: 'hu'),
                                'medium' => Number::currency(40000, in: 'HUF', locale: 'hu'),
                                'long' => Number::currency(70000, in: 'HUF', locale: 'hu'),
                            } }}
                        </div>
                    </div>
                    <div class="mt-2 text-gray-500">
                        Description: {!! $page['description'] ?? 'No description available' !!}
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Request Quote Functions Table -->
    <div class="mt-8">
        <h2 class="mb-4 text-xl font-bold">Request Quote Functions</h2>
        <table class="min-w-full bg-white rounded-lg shadow-md">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600">Function Name</th>
                    <th class="px-4 py-2 text-left text-gray-600">Description</th>
                    <th class="px-4 py-2 text-left text-gray-600">Price</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($this->requestQuote->requestQuoteFunctionalities as $function)
                    <tr>
                        <td class="px-4 py-2 font-medium">{{ $function['name'] }}</td>
                        <td class="px-4 py-2 text-gray-500">{{ $function['description'] ?? 'No description available' }}
                        </td>
                        <td class="px-4 py-2 text-gray-500">
                            {{ Number::currency($function['price'], in: 'HUF', locale: 'hu') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Keep the form section -->
    <form method="POST" wire:submit="checkout" class="mt-6">

        {{ $this->form }}

    </form>
    <x-filament-actions::modals />
    {{--  <input id="card-holder-name" type="text">

    <!-- Stripe Elements Placeholder -->
    <div id="card-element"></div>

    <button id="card-button">
        Process Payment
    </button>
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const stripe = Stripe(
            'pk_test_51RCJGJBCJOrnQDeASCDDeE2PT2a01dtf3g8J75NTHS9XVEUb2N6lZXxPfNN9y32h6FCUX6Z345P8NPyMYCZnJ15i00DgOvZqGz'
        );

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');

        cardButton.addEventListener('click', async (e) => {
            const {
                paymentMethod,
                error
            } = await stripe.createPaymentMethod(
                'card', cardElement, {
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            );

            if (error) {
                // Display "error.message" to the user...
            } else {
                // The card has been verified successfully...
                console.log('PaymentMethod created:', paymentMethod);
                @this.set('paymentMethodId', paymentMethod.id);
                @this.call('checkout');
            }
        });
    </script> --}}

    <div class="flex items-center justify-between mt-4">
        <span class="text-lg font-bold">Total: {{ Number::currency($total, in: 'HUF', locale: 'hu') }}</span>
        {{-- <a href="{{ route('checkout') }}"
            class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Checkout</a> --}}
        {{ $this->submitAction }}
    </div>
</div>
