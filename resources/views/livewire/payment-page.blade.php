<div class="container p-6 mx-auto">
    <h1 class="mb-4 text-2xl font-bold">Payment Page</h1>
    <p class="mb-6 text-gray-700">Proceed with your payment via Stripe or finalize your order without payment.</p>
    <form action="{{ route('checkout') }}" method="POST" class="mb-4">
        @csrf
        <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">Pay with
            Stripe</button>
    </form>
    <a href="{{ route('checkout') }}" class="px-4 py-2 text-white bg-gray-500 rounded hover:bg-gray-600">Finalize without
        Payment</a>
</div>
