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

                                    <div>
                                        <div class="text-lg font-bold">{{ $page['name'] }}</div>
                                        <div class="text-sm text-gray-500">{{ $page['length'] }} oldal</div>
                                        <div class="mt-1 text-xs text-blue-700">{!! $page['description'] ?? 'Nincs leírás' !!}</div>
                                    </div>
                                </div>
                                <div class="text-right min-w-[140px]">

                                    <div>
                                        <div class="text-lg font-bold text-green-700">
                                            {{ match ($page['length']) {
                                                'short' => Number::currency(20000, in: 'HUF', locale: 'hu', precision: 0),
                                                'medium' => Number::currency(40000, in: 'HUF', locale: 'hu', precision: 0),
                                                'large' => Number::currency(70000, in: 'HUF', locale: 'hu', precision: 0),
                                            } }}
                                            <span class="font-normal text-gray-700">+ Áfa</span>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            (Bruttó:
                                            {{ match ($page['length']) {
                                                'short' => Number::currency(20000 * 1.27, in: 'HUF', locale: 'hu', precision: 0),
                                                'medium' => Number::currency(40000 * 1.27, in: 'HUF', locale: 'hu', precision: 0),
                                                'large' => Number::currency(70000 * 1.27, in: 'HUF', locale: 'hu', precision: 0),
                                            } }})
                                        </div>
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
                    @forelse ($this->requestQuote->requestQuoteFunctionalities ?? [] as $function)
                        <li class="flex items-center justify-between p-4">
                            <div>
                                <div class="font-medium">{{ $function->name }}</div>
                                <div class="text-xs text-gray-500">{{ $function->description ?? 'Nincs leírás' }}</div>
                            </div>
                            <div class=" min-w-[140px]">
                                <div class="font-bold text-green-700">
                                    {{ Number::currency($function['price'], in: 'HUF', locale: 'hu', precision: 0) }}
                                    <span class="font-normal text-gray-700">+ Áfa</span>
                                </div>
                                <div class="text-sm text-gray-500">
                                    (Bruttó:
                                    {{ Number::currency($function['price'] * 1.27, in: 'HUF', locale: 'hu', precision: 0) }})
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="p-4 text-center text-gray-500">Nincs kiválasztott funkció.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Jobb oldal: Összegző kártya -->
        <div class="w-full lg:w-[380px]">
            <div class="p-6 mb-6 shadow-lg bg-gray-50 rounded-xl">
                <h2 class="mb-4 text-lg font-bold tracking-wide text-center">ÖSSZESÍTÉS</h2>
                <div class="flex justify-between py-1">
                    <span class="text-gray-700">Tételek összesen</span>
                    <div class="text-right">
                        <div class="font-semibold text-green-700">
                            {{ Number::currency($total, in: 'HUF', locale: 'hu', precision: 0) }}
                            <span class="font-normal text-gray-700">+ Áfa</span>
                        </div>
                        <div class="text-sm text-gray-500">
                            (Bruttó:
                            {{ Number::currency($total * 1.27, in: 'HUF', locale: 'hu', precision: 0) }})
                        </div>
                    </div>
                </div>

                <div class="my-3 border-t"></div>
                <div class="flex items-center justify-between py-2">
                    <span class="text-lg font-bold">Előleg összeg</span>
                    <div class="text-right">
                        <div class="text-2xl font-bold text-green-700">
                            {{ Number::currency($total / 2, in: 'HUF', locale: 'hu', precision: 0) }}
                            <span class="font-normal text-gray-700">+ Áfa</span>
                        </div>
                        <div class="text-sm text-gray-500">
                            (Bruttó:
                            {{ Number::currency(($total / 2) * 1.27, in: 'HUF', locale: 'hu', precision: 0) }})
                        </div>
                    </div>
                </div>
                <button type="button" wire:click="checkout"
                    class="w-full py-3 mt-4 text-lg font-bold text-white transition !bg-[#2563eb] rounded-lg hover:bg-orange-600">Tovább
                    a fizetéshez</button>
            </div>

        </div>
        {{ $this->form }}

    </form>
    <x-filament-actions::modals />

</div>
