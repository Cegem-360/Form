<div class="min-h-screen py-10 bg-gray-50">
    <div class="flex flex-col max-w-5xl mx-auto overflow-hidden bg-white shadow-lg rounded-2xl md:flex-row">
        <!-- Bal oldal: Kép -->
        <div class="flex items-center justify-center bg-gray-100 md:w-1/2">
            <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=600&q=80"
                alt="Order illustration" class="object-cover w-full h-full max-h-[500px]">
        </div>
        <!-- Jobb oldal: Összegzés -->
        <div class="flex flex-col justify-between p-8 md:w-1/2">
            <div>
                <div class="mb-2 text-sm font-semibold text-indigo-600">Payment successful</div>
                <h1 class="mb-2 text-3xl font-bold">Thanks for ordering</h1>
                <p class="mb-6 text-gray-600">We appreciate your order, we're currently processing it. So hang tight and
                    we'll send you confirmation very soon!</p>
                <div class="mb-4">
                    <span class="block text-xs text-gray-500">Tracking number</span>
                    <span
                        class="block font-mono text-sm font-semibold text-blue-700">{{ $order->tracking_number ?? $order->id }}</span>
                </div>
                <!-- Tételek listája -->
                <div class="mb-6 border divide-y divide-gray-200 rounded-lg">
                    @foreach ($order->orderItems as $item)
                        <div class="flex items-center gap-4 p-4">
                            <img src="{{ $item->image ?? 'https://via.placeholder.com/48x48' }}"
                                alt="{{ $item->name }}" class="object-cover w-12 h-12 bg-gray-100 rounded">
                            <div class="flex-1">
                                <div class="font-medium">{{ $item->name }}</div>
                                <div class="text-xs text-gray-500">{{ $item->variant ?? '' }}</div>
                            </div>
                            <div class="font-semibold text-gray-700">{{ number_format($item->price, 2) }}
                                {{ $order->currency }}</div>
                        </div>
                    @endforeach
                </div>
                <!-- Összegzés -->
                <div class="mb-6">
                    <div class="flex justify-between mb-1 text-sm">
                        <span class="text-gray-600">Subtotal</span>
                        <span>{{ number_format($order->subtotal ?? $order->total, 2) }} {{ $order->currency }}</span>
                    </div>
                    <div class="flex justify-between mb-1 text-sm">
                        <span class="text-gray-600">Shipping</span>
                        <span>{{ isset($order->shipping_cost) ? number_format($order->shipping_cost, 2) : 'Free' }}
                            {{ $order->shipping_cost ? $order->currency : '' }}</span>
                    </div>
                    <div class="flex justify-between mb-1 text-sm">
                        <span class="text-gray-600">Taxes</span>
                        <span>{{ isset($order->tax) ? number_format($order->tax, 2) : '-' }}
                            {{ $order->tax ? $order->currency : '' }}</span>
                    </div>
                    <div class="flex justify-between pt-2 mt-2 text-lg font-bold border-t">
                        <span>Total</span>
                        <span>{{ number_format($order->total, 2) }} {{ $order->currency }}</span>
                    </div>
                </div>
                <!-- Szállítási és fizetési adatok -->
                <div class="grid grid-cols-1 gap-4 pt-4 text-sm border-t md:grid-cols-2">
                    <div>
                        <div class="mb-1 text-gray-500">Shipping Address</div>
                        <div class="text-gray-700">{{ $order->shipping_address }}</div>
                    </div>
                    <div>
                        <div class="mb-1 text-gray-500">Payment Information</div>
                        <div class="flex items-center gap-2">
                            <span
                                class="inline-block px-2 py-1 text-xs text-blue-800 bg-blue-100 rounded">{{ $order->payment_method }}</span>
                            <span
                                class="text-gray-700">{{ $order->card_last4 ? 'Ending with ' . $order->card_last4 : '' }}</span>
                            <span class="text-xs text-gray-400">{{ $order->card_expiry ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-8 text-right">
                <a href="#" class="font-semibold text-indigo-600 hover:underline">Continue Shopping
                    &rarr;</a>
            </div>
        </div>
    </div>
</div>
