<x-layouts.app>
    {{--  <div class="text-gray-900 bg-gray-100">
        <div class="container p-4 mx-auto">
            <h1 class="mb-4 text-3xl font-bold">Form Review</h1>
            <ul class="p-4 bg-white rounded-lg shadow-md">
                @foreach ($formData as $key => $value)
                    <li class="py-2 border-b border-gray-200">
                        <strong class="font-semibold">{{ $key }}:</strong>
                        @if (is_array($value))
                            <ul class="pl-4">
                                @foreach ($value as $item)
                                    <li>
                                        @if (is_array($item))
                                            <ul class="pl-4">
                                                @foreach ($item as $subItem)
                                                    <li>
                                                        <span class="text-gray-700">{{ $subItem }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-gray-700">{{ $item }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-700">{{ $value }}</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div> --}}

    <div class="text-gray-900 bg-gray-100">
        <div class="container p-4 mx-auto">
            <h1 class="mb-4 text-3xl font-bold">Köszönjük!</h1>
            <p class="text-lg">Köszönjük, hogy kitöltötte a űrlapot. Hamarosan felvesszük Önnel a kapcsolatot.</p>
            <blockquote class="pl-4 mt-4 text-lg italic border-l-4 border-gray-500">
                Az élet tele van lehetőségekkel és kihívásokkal, és minden egyes lépés, amit
                megteszünk, közelebb visz minket céljainkhoz. Ne feledje, hogy minden nap egy új kezdet, és minden
                pillanatban lehetőség van a fejlődésre és a tanulásra. Legyen bátor, és ne féljen új utakat felfedezni.
                Az önbizalom és a kitartás kulcsfontosságúak a sikerhez. Higgyen magában, és soha ne adja fel álmait. Az
                út néha nehéz lehet, de minden erőfeszítés, amit tesz, közelebb viszi Önt a céljaihoz. Köszönjük, hogy
                velünk tart, és reméljük, hogy együtt érhetjük el a legnagyobb sikereket.
            </blockquote>
        </div>
    </div>
</x-layouts.app>
