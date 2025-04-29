<div class="container max-w-lg p-8 mx-auto bg-white rounded-lg shadow-md">
    <h1 class="mb-6 text-2xl font-bold text-center">Fizetési oldal</h1>

    <!-- Megrendelő adatai -->
    <div class="mb-6">
        <h2 class="mb-2 text-lg font-semibold">Megrendelő adatai</h2>
        <form wire:submit.prevent="updateCustomerData">
            {{ $this->form }}
        </form>
    </div>

    <!-- Kosár összegzése -->
    <div class="p-4 mb-6 rounded bg-gray-50">
        <h2 class="mb-2 text-lg font-semibold">Kosár összegzése</h2>
        <div class="flex items-center justify-between">
            <span class="font-medium">Végösszeg:</span>
            <span
                class="text-xl font-bold text-green-700">{{ Number::currency($requestQuote->getTotalPriceAttribute() ?? 0, in: 'HUF', locale: 'hu') }}</span>
        </div>
    </div>

    <!-- Fizetési lehetőségek -->
    <div class="mb-4">
        <h2 class="mb-2 text-lg font-semibold">Fizetési lehetőségek</h2>
        <form action="{{ route('checkout') }}" method="POST" class="mb-2">

            @csrf
            <button type="submit"
                class="w-full px-4 py-2 mb-2 text-white transition bg-green-600 rounded hover:bg-green-700">Fizetés
                Stripe-pal</button>
        </form>
        <a href="{{ route('checkout') }}"
            class="block w-full px-4 py-2 text-center text-white transition bg-gray-500 rounded hover:bg-gray-600">Véglegesítés
            fizetés nélkül</a>
    </div>
    <x-filament-actions::modals />
</div>
