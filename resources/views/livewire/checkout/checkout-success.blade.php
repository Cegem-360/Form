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
                <div class="mb-2 text-sm font-semibold text-indigo-600">Fizetés sikeres</div>
                <h1 class="mb-2 text-3xl font-bold">Köszönjük rendelését!</h1>
                <p class="mb-6 text-gray-600">Köszönjük, hogy minket választott! Rendelését feldolgozzuk, hamarosan
                    visszaigazolást küldünk.</p>
                <div class="mb-4">
                    <span class="block text-xs text-gray-500">Rendelésszám</span>
                    <span
                        class="block font-mono text-sm font-semibold text-blue-700">{{ $order->id ?? $requestQuote->id }}</span>
                </div>
                <div class="mb-4">
                    <span class="block text-xs text-gray-500">Rendelés dátuma</span>
                    <span class="block text-sm font-bold">{{ $order->created_at?->format('Y.m.d H:i') ?? '' }}</span>
                </div>
                <div class="mb-4">
                    <span class="block text-xs text-gray-500">Fizetési mód</span>
                    <span
                        class="block text-sm font-bold">{{ __($order->requestQuote->payment_method) ?? 'Ismeretlen' }}</span>
                </div>
                @if ('bank_transfer' === $order->requestQuote->payment_method)
                    <div class="p-4 mb-4 border border-gray-200 rounded bg-gray-50">
                        <div class="mb-2 text-xs font-semibold text-gray-500">Banki átutalási adatok:</div>
                        <ul class="space-y-1 text-sm text-gray-700 list-none">
                            <li><span class="font-semibold">Kedvezményezett neve:</span> Cégem 360 Kft.</li>
                            <li><span class="font-semibold">Bankszámlaszám:</span> 12600016-17129425-18957306</li>
                            <li><span class="font-semibold">Bank:</span> Wise</li>
                            <li><span class="font-semibold">Közlemény:</span> Rendelésszám:
                                {{ $order->id ?? $requestQuote->id }}</li>
                        </ul>
                    </div>
                @endif
                <div class="mb-4">
                    <div class="mb-1 text-xs font-semibold text-gray-500">Árajánlat összeg:</div>
                    <div class="text-2xl font-bold text-green-700">
                        {{ Number::currency($order->requestQuote->getTotalPriceAttribute(), in: 'HUF', locale: 'hu', precision: 0) }}
                        <span class="font-normal text-gray-700">+ Áfa</span>
                    </div>
                    <div class="text-sm text-gray-500">
                        (Bruttó:
                        {{ Number::currency($order->requestQuote->getTotalPriceAttribute() * 1.27, in: 'HUF', locale: 'hu', precision: 0) }})
                    </div>
                </div>
                <div class="mb-4">
                    <div class="mb-1 text-xs font-semibold text-gray-500">Előleg összeg:</div>
                    <div class="text-2xl font-bold text-green-700">
                        {{ Number::currency($order->requestQuote->getTotalPriceAttribute() / 2, in: 'HUF', locale: 'hu', precision: 0) }}
                        <span class="font-normal text-gray-700">+ Áfa</span>
                    </div>
                    <div class="text-sm text-gray-500">
                        (Bruttó:
                        {{ Number::currency(($order->requestQuote->getTotalPriceAttribute() / 2) * 1.27, in: 'HUF', locale: 'hu', precision: 0) }})
                    </div>
                </div>
                <!-- Tételek listája -->
                <div class="mb-6 border divide-y divide-gray-200 rounded-lg">
                    @foreach ($order->orderItems ?? [] as $item)
                        <div class="flex items-center gap-4 p-4">
                            <img src="{{ $item->image ?? 'https://via.placeholder.com/48x48' }}"
                                alt="{{ $item->name }}" class="object-cover w-12 h-12 bg-gray-100 rounded">
                            <div class="flex-1">
                                <div class="font-medium">{{ $item->name }}</div>
                                <div class="text-xs text-gray-500">{{ $item->variant ?? '' }}</div>
                            </div>
                            <div class="font-semibold text-gray-700">
                                {{ Number::currency($item->price, in: 'HUF', locale: 'hu', precision: 0) }}</div>
                        </div>
                    @endforeach
                </div>
                <!-- Fizetési információk, ha Stripe vagy utalás -->
                @if (in_array($order->payment_method ?? '', ['stripe', 'utalas']))
                    <div class="p-4 mt-6 border border-blue-200 rounded bg-blue-50">
                        <h2 class="mb-2 text-lg font-semibold">Fizetési teendők</h2>
                        @if (($order->payment_method ?? '') === 'stripe')
                            <p class="mb-2">A fizetés Stripe-on keresztül történt. Amennyiben bármilyen
                                probléma
                                merülne fel, kérjük, vegye fel velünk a kapcsolatot.</p>
                        @else
                            <p class="mb-2">A fizetési mód: átutalás. Kérjük, utalja el a végösszeget az
                                alábbi
                                bankszámlára:</p>
                            <ul class="mb-2 text-left list-disc list-inside">
                                <li><b>Cégnév:</b> Cegem360 Kft.</li>
                                <li><b>Bankszámlaszám:</b> 126000161712942518957306</li>
                                <li><b>Bank:</b> Wise</li>
                                <li><b>Közlemény:</b> Rendelésszám: {{ $order->id ?? $requestQuote->id }}</li>
                            </ul>
                            <p class="text-xs text-gray-500">A számlát e-mailben is elküldjük Önnek.</p>
                        @endif
                    </div>
                @endif
            </div>
            <div class="mt-8 text-right">
                <a href="/" class="font-semibold text-indigo-600 hover:underline">Vissza a főoldalra
                    &rarr;</a>
            </div>
        </div>
    </div>
</div>
