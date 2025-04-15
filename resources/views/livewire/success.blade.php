<x-layouts.app>
    <div>

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
            <x-filament-panels::form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                    {{ __('Log Out') }}
                </button>

            </x-filament-panels::form>
        </div>

        <div class="mt-4">
            <a href="{{ route('home') }}"
                class="px-4 py-2 text-white bg-purple-500 rounded hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500">
                Admin Panel
            </a>
        </div>
    </div>
</x-layouts.app>
