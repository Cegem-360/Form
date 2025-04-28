<div>
    <h1 class="my-4 text-2xl font-bold text-center">Thank You for Your Order!</h1>
    <p class="mb-6 text-center text-gray-600">Your order has been successfully placed. We appreciate your business!</p>

    <div class="p-6 bg-white rounded-lg shadow-md">
        <h2 class="mb-4 text-lg font-semibold">Order Details</h2>
        <ul class="mb-4">
            <li><strong>Order Number:</strong> {{ $order->id }}</li>
            <li><strong>Date:</strong> {{ $order->created_at->format('F j, Y') }}</li>
            <li><strong>Total:</strong> {{ $order->total }} {{ $order->currency }}</li>
        </ul>

        <h2 class="mb-4 text-lg font-semibold">Shipping Address</h2>
        <p>{{ $order->shipping_address }}</p>

        <h2 class="mt-6 mb-4 text-lg font-semibold">Payment Method</h2>
        <p>{{ $order->payment_method }}</p>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('shop') }}" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Continue
            Shopping</a>
    </div>
</div>
