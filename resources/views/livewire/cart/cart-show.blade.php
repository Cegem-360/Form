<div>
    <form class="container flex flex-col gap-8 p-6 mx-auto lg:flex-row">
        @csrf

        <!-- Bal oldal: Kosár tartalma -->
        <div class="flex-1">
            <h1 class="mb-4 text-2xl font-bold">Kosár</h1>

            <!-- Oldalak szekció -->
            <div class="mb-8">
                <ul class="bg-white divide-y divide-gray-200 rounded-lg shadow-md">
                    @foreach ($this->requestQuote->websites ?? [] as $page)
                        @if ($page['required'])
                            <li class="flex items-center justify-between p-4">
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center justify-center w-24 h-16 bg-gray-100 rounded-md">
                                        <span class="text-xs text-gray-400">Kép</span>
                                    </div>
                                    <div>
                                        <div class="text-lg font-bold">{{ $page['name'] }}</div>
                                        <div class="text-sm text-gray-500">{{ $page['length'] }} oldal</div>
                                        <div class="mt-1 text-xs text-blue-700">{!! $page['description'] ?? 'Nincs leírás' !!}</div>
                                    </div>
                                </div>
                                <div class="text-right min-w-[120px]">
                                    <div class="text-sm text-gray-400 line-through">
                                        @if ($page['length'] === 'short')
                                            {{ Number::currency(25000, in: 'HUF', locale: 'hu') }}
                                        @elseif($page['length'] === 'medium')
                                            {{ Number::currency(45000, in: 'HUF', locale: 'hu') }}
                                        @else
                                            {{ Number::currency(80000, in: 'HUF', locale: 'hu') }}
                                        @endif
                                    </div>
                                    <div class="text-lg font-bold text-green-700">
                                        {{ match ($page['length']) {
                                            'short' => Number::currency(20000, in: 'HUF', locale: 'hu'),
                                            'medium' => Number::currency(40000, in: 'HUF', locale: 'hu'),
                                            'long' => Number::currency(70000, in: 'HUF', locale: 'hu'),
                                        } }}
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <!-- Funkciók szekció -->
            <div class="mb-8">
                <h2 class="mb-4 text-xl font-bold">Kiválasztott weboldal funkciók</h2>
                <ul class="bg-white divide-y divide-gray-200 rounded-lg shadow-md">
                    @foreach ($this->requestQuote->requestQuoteFunctionalities as $function)
                        <li class="flex items-center justify-between p-4">
                            <div>
                                <div class="font-medium">{{ $function->name }}</div>
                                <div class="text-xs text-gray-500">{{ $function->description ?? 'Nincs leírás' }}</div>
                            </div>
                            <div class="font-bold text-green-700">
                                {{ Number::currency($function['price'], in: 'HUF', locale: 'hu') }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Jobb oldal: Összegző kártya -->
        <div class="w-full lg:w-[380px]">
            <div class="p-6 mb-6 shadow-lg bg-gray-50 rounded-xl">
                <h2 class="mb-4 text-lg font-bold tracking-wide text-center">ÖSSZESÍTÉS</h2>
                <div class="flex justify-between py-1">
                    <span class="text-gray-700">Tételek összesen</span>
                    <span
                        class="font-semibold">{{ Number::currency($itemTotal ?? $total, in: 'HUF', locale: 'hu') }}</span>
                </div>
                {{--  <div class="flex justify-between py-1">
                <span class="text-gray-700">Kedvezmény</span>
                <span class="text-green-700">-{{ Number::currency($discount ?? 0, in: 'HUF', locale: 'hu') }}</span>
            </div>
            <div class="flex justify-between py-1">
                <span class="text-gray-700">Szállítás</span>
                <span class="text-green-700">Ingyenes</span>
            </div>
            <div class="flex justify-between py-1">
                <span class="text-gray-700">Kupon</span>
                <span class="text-green-700">-{{ Number::currency($coupon ?? 0, in: 'HUF', locale: 'hu') }}</span>
            </div> --}}
                <div class="my-3 border-t"></div>
                <div class="flex items-center justify-between py-2">
                    <span class="text-lg font-bold">Végösszeg</span>
                    <span
                        class="text-2xl font-bold text-green-700">{{ Number::currency($total, in: 'HUF', locale: 'hu') }}</span>
                </div>
                <button type="button" wire:click="checkout"
                    class="w-full py-3 mt-4 text-lg font-bold text-white transition bg-orange-500 rounded-lg hover:bg-orange-600">Tovább
                    a fizetéshez</button>
            </div>
            <!-- Extra információk, garanciák -->
            {{--  <div class="space-y-2">
            <div class="flex items-center gap-2 p-3 bg-white rounded-lg shadow">
                <span class="text-blue-600">🍏</span>
                <span class="font-medium">Ízgarancia</span>
            </div>
            <div class="flex items-center gap-2 p-3 bg-white rounded-lg shadow">
                <span class="text-blue-600">🔄</span>
                <span class="font-medium">100% rugalmas előfizetés</span>
            </div>
            <div class="flex items-center gap-2 p-3 bg-white rounded-lg shadow">
                <span class="text-blue-600">✅</span>
                <span class="font-medium">Tiszta címke minősítés</span>
            </div>
            <div class="flex items-center gap-2 p-3 bg-white rounded-lg shadow">
                <span class="text-blue-600">⭐</span>
                <span class="font-medium">Smart Rewards</span>
            </div>
        </div> --}}
        </div>
        {{ $this->form }}

    </form>
    <x-filament-actions::modals />

</div>
