<div class="container max-w-2xl p-8 mx-auto bg-white rounded-lg shadow-md">
    <x-application-logo class="mx-auto mb-6 " />
    <form>
        <h1 class="mb-6 text-2xl font-bold text-center">Fizetési oldal</h1>
        <!-- Megrendelő adatai -->
        <div class="mb-6">
            <h2 class="mb-2 text-lg font-semibold">Megrendelő adatai</h2>

            {{ $this->form }}
        </div>
        <!-- Kosár összegzése -->
        <div class="p-4 mb-6 rounded bg-gray-50">
            <h2 class="mb-2 text-lg font-semibold">Kosár összegzése</h2>
            <div class="flex items-center justify-between">
                <span class="font-medium">Előleg összeg:</span>
                <span class="text-xl font-bold text-green-700">

                    {{ Number::currency($requestQuote->totalPrice / 2 ?? 0, in: 'HUF', locale: 'hu', precision: 0) }}
                    <span class="font-normal text-gray-700">+ Áfa</span>
                    <span class="block text-xs font-normal text-gray-500">
                        Bruttó:
                        {{ Number::currency(($requestQuote->totalPrice / 2) * 1.27 ?? 0, in: 'HUF', locale: 'hu', precision: 0) }}
                    </span>
                </span>
            </div>
        </div>

        <!-- Fizetési lehetőségek -->
        @if ($data['terms'] == true && $data['privacy'] == true && $requestQuote->payment_method)
            <div class="mb-8 space-y-8 text-center">
                <h2 class="mb-4 text-lg font-semibold text-center">Fizetés véglegesítése</h2>
                @if ($requestQuote->payment_method == 'bank_transfer')
                    <div class="text-center">
                        {{ $this->finalizeOrder() }}
                    </div>
                @elseif ($requestQuote->payment_method == 'stripe')
                    <div class="text-center">
                        {{ $this->payWithStripe() }}
                    </div>
                @endif
            </div>
        @endif
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('cart.summary', ['requestQuote' => $this->requestQuote]) }}"
            class="px-6 py-3 text-lg font-semibold text-white transition bg-blue-600 shadow rounded-xl hover:bg-blue-700">
            Vissza a kosárhoz
        </a>
    </div>

    <x-filament-actions::modals />
</div>
