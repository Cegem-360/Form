<div class="container p-6 mx-auto">
    <h1 class="mb-4 text-2xl font-bold">Your Cart</h1>

    <div class="p-4 bg-white rounded-lg shadow-md">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b">Product</th>
                    <th class="px-4 py-2 border-b">Quantity</th>
                    <th class="px-4 py-2 border-b">Price</th>
                    <th class="px-4 py-2 border-b">Total</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example Data -->
                <tr>
                    <td class="px-4 py-2 border-b">Example Product 1</td>
                    <td class="px-4 py-2 border-b">2</td>
                    <td class="px-4 py-2 border-b">$10.00</td>
                    <td class="px-4 py-2 border-b">$20.00</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 border-b">Example Product 2</td>
                    <td class="px-4 py-2 border-b">1</td>
                    <td class="px-4 py-2 border-b">$15.00</td>
                    <td class="px-4 py-2 border-b">$15.00</td>
                </tr>
            </tbody>
        </table>

    </div>

    <!-- Pages Section -->
    <div class="mt-8">
        <h2 class="mb-4 text-xl font-bold">Pages</h2>
        <ul class="bg-white divide-y divide-gray-200 rounded-lg shadow-md">
            @foreach ($this->requestQuote->websites as $page)
                <li class="flex items-center justify-between p-4">
                    <span class="font-medium">{{ $page['name'] }}</span>
                    <span class="text-gray-500">Length: {{ $page['length'] }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Keep the form section -->
    <form method="POST" wire:submit="checkout" class="mt-6">

        {{ $this->form }}

    </form>
    <x-filament-actions::modals />
    <div class="flex items-center justify-between mt-4">
        <span class="text-lg font-bold">Total: {{ Number::currency($total, in: 'HUF', locale: 'hu') }}</span>
        <button class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Checkout</button>
    </div>
</div>
