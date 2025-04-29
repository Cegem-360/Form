<div class="container p-6 mx-auto">
    <h1 class="mb-4 text-2xl font-bold">Kosarad</h1>

    <!-- Oldalak szekció -->
    <div class="mt-8">
        <h2 class="mb-4 text-xl font-bold">Oldalak</h2>
        <ul class="bg-white divide-y divide-gray-200 rounded-lg shadow-md">
            @foreach ($this->requestQuote->websites ?? [] as $page)
                @if ($page['required'])
                    <li class="p-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="font-medium">
                                <span class="block text-gray-600">Oldal megnevezése:</span>
                                <b>{{ $page['name'] }}</b>
                            </div>
                            <div class="text-right text-gray-500">
                                <span class="block text-gray-600">Hossz:</span>
                                <b>{{ $page['length'] }}</b> |
                                <span class="block text-gray-600">Ár:</span>
                                <b>
                                    {{ match ($page['length']) {
                                        'short' => Number::currency(20000, in: 'HUF', locale: 'hu'),
                                        'medium' => Number::currency(40000, in: 'HUF', locale: 'hu'),
                                        'long' => Number::currency(70000, in: 'HUF', locale: 'hu'),
                                    } }}
                                </b>
                            </div>
                        </div>
                        <div class="mt-2 text-gray-500">
                            <span class="block text-gray-600">Oldal leírása:</span>
                            <b>{!! $page['description'] ?? 'Nincs leírás' !!}</b>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

    <!-- Funkciók szekció -->
    <div class="mt-8">
        <h2 class="mb-4 text-xl font-bold">Kért funkciók</h2>
        <table class="min-w-full bg-white rounded-lg shadow-md">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600">Funkció neve</th>
                    <th class="px-4 py-2 text-left text-gray-600">Leírás</th>
                    <th class="px-4 py-2 text-left text-gray-600">Ár</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($this->requestQuote->requestQuoteFunctionalities as $function)
                    <tr>
                        <td class="px-4 py-2 font-medium">{{ $function['name'] }}</td>
                        <td class="px-4 py-2 text-gray-500">{{ $function['description'] ?? 'Nincs leírás' }}</td>
                        <td class="px-4 py-2 text-gray-500">
                            {{ Number::currency($function['price'], in: 'HUF', locale: 'hu') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Megrendelő űrlap szekció -->
    <form method="POST" wire:submit="checkout" class="mt-6">
        {{ $this->form }}
    </form>
    <x-filament-actions::modals />

    <div class="flex items-center justify-between mt-4">
        <span class="text-lg font-bold">Összesen: {{ Number::currency($total, in: 'HUF', locale: 'hu') }}</span>
        {{ $this->submitAction }}
    </div>
</div>
