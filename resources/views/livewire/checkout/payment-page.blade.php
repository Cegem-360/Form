<div class="container max-w-lg p-8 mx-auto bg-white rounded-lg shadow-md">
    <form wire:submit.prevent="updateCustomerData">
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

                    {{ Number::currency($requestQuote->getTotalPriceAttribute() / 2 ?? 0, in: 'HUF', locale: 'hu', precision: 0) }}
                    <span class="block text-xs font-normal text-gray-500">
                        Bruttó:
                        {{ Number::currency(($requestQuote->getTotalPriceAttribute() / 2) * 1.27 ?? 0, in: 'HUF', locale: 'hu', precision: 0) }}
                    </span>
                </span>
            </div>
        </div>

        <!-- Fizetési lehetőségek -->
        <div class="mb-4 text-center">

            @empty(!$data['paymentMethod'])

                <h2 class="mb-2 text-lg font-semibold text-center">Fizetés véglegesítése</h2>

                @if ($data['paymentMethod'] == 'bank_transfer')
                    <div class="text-center">
                        {{ $this->finalizeOrder() }}
                    </div>
                @elseif ($data['paymentMethod'] == 'stripe')
                    <div class="text-center">
                        {{ $this->payWithStripe() }}
                    </div>
                @else
                    <p class="text-center text-red-500">Kérjük, válasszon egy érvényes fizetési módot.</p>
                @endif
            @endempty
        </div>
    </form>
    <x-filament-actions::modals />
</div>
