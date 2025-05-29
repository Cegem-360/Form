<div class="flex flex-col items-center justify-center min-h-[60vh] py-12 bg-gradient-to-br from-red-50 to-white">
    <div class="w-full max-w-lg px-8 py-8 mb-8 text-center bg-white border border-red-200 shadow-lg rounded-2xl">
        <div class="flex justify-center mb-4">
            <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="#fee2e2" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01" stroke="currentColor"
                    stroke-width="2" />
            </svg>
        </div>
        <h2 class="mb-2 text-3xl font-extrabold text-red-700">Sikertelen rendelés</h2>
        <p class="mb-2 text-lg text-gray-700">Sajnáljuk, a rendelés feldolgozása nem sikerült.</p>
        <p class="text-gray-600">Kérjük, próbáld újra, vagy vedd fel velünk a kapcsolatot!</p>
    </div>
    <div class="flex gap-4">
        <a href="{{ route('cart.summary', ['requestQuote' => $requestQuote->id]) }}"
            class="px-6 py-2 font-semibold text-white transition bg-blue-600 rounded-lg shadow hover:bg-blue-700">
            Visszaa kosárhoz
        </a>
        {{--  <a href="{{ route('kerdoiv') }}"
            class="px-6 py-2 font-semibold text-gray-800 transition bg-gray-200 rounded-lg shadow hover:bg-gray-300">
            Vissza az árajánlat oldalra
        </a> --}}
    </div>
</div>
