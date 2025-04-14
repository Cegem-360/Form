<div>
    <div class="p-6 bg-white rounded-lg shadow-md">
        <h2 class="mb-4 text-xl font-semibold text-gray-800">Cancel Subscription</h2>
        <p class="mb-6 text-gray-600">Are you sure you want to cancel your subscription? This action cannot be undone.
        </p>
        <button wire:click="cancelSubscription"
            class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
            Confirm Cancellation
        </button>
    </div>
    <div class="mt-4">
        <a href="{{ route('cart.summary') }}"
            class="px-4 py-2 text-white bg-gray-500 rounded hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
            Back to Cart Summary
        </a>
    </div>
    <div class="mt-4">
        <a href="{{ route('payment.page', ['record' => 1]) }}"
            class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Proceed to Payment
        </a>
    </div>
    <div class="mt-4">
        <a href="{{ route('checkout') }}"
            class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
            Finalize without Payment
        </a>

    </div>
    <div class="mt-4">
        <a href="{{ route('home') }}"
            class="px-4 py-2 text-white bg-gray-800 rounded hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-800">
            Back to Home
        </a>
    </div>
    <div class="mt-4">
        <a href="{{ route('profile') }}"
            class="px-4 py-2 text-white bg-purple-500 rounded hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500">
            View Profile
        </a>

    </div>
    <div class="mt-4">
        <a href="{{ route('orders') }}"
            class="px-4 py-2 text-white bg-yellow-500 rounded hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            View Orders
        </a>

    </div>
    <div class="mt-4">
        <a href="{{ route('support') }}"
            class="px-4 py-2 text-white bg-teal-500 rounded hover:bg-teal-600 focus:outline-none focus:ring-2 focus:ring-teal-500">
            Contact Support
        </a>

    </div>

    <div class="mt-4">
        <a href="{{ route('faq') }}"
            class="px-4 py-2 text-white bg-indigo-500 rounded hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            FAQ
        </a>

    </div>

    <div class="mt-4">
        <a href="{{ route('terms') }}"
            class="px-4 py-2 text-white bg-orange-500 rounded hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500">
            Terms of Service
        </a>

    </div>
    <div class="mt-4">
        <a href="{{ route('privacy') }}"
            class="px-4 py-2 text-white bg-pink-500 rounded hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-pink-500">
            Privacy Policy
        </a>

    </div>
    <div class="mt-4">
        <a href="{{ route('logout') }}"
            class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
            Logout
        </a>

    </div>
</div>
