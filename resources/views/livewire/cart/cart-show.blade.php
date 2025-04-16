<div class="container p-6 mx-auto">
    <h1 class="mb-4 text-2xl font-bold">Your Cart</h1>

    <!-- Pages Section -->
    <div class="mt-8">
        <h2 class="mb-4 text-xl font-bold">Pages</h2>
        <ul class="bg-white divide-y divide-gray-200 rounded-lg shadow-md">
            @foreach ($this->requestQuote->websites ?? [] as $page)
                @if ($page['required'])
                    <li class="p-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="font-medium">
                                Oldal megnevezése: <b>{{ $page['name'] }} </b>
                            </div>
                            <div class="text-right text-gray-500">
                                Length:<b> {{ $page['length'] }} </b> |
                                Price:<b>
                                    {{ match ($page['length']) {
                                        'short' => Number::currency(20000, in: 'HUF', locale: 'hu'),
                                        'medium' => Number::currency(40000, in: 'HUF', locale: 'hu'),
                                        'long' => Number::currency(70000, in: 'HUF', locale: 'hu'),
                                    } }}
                                </b>
                            </div>
                        </div>
                        <div class="mt-2 text-gray-500">
                            Details of Page: <b>{!! $page['description'] ?? 'No description available' !!}</b>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

    <!-- Request Quote Functions Table -->
    <div class="mt-8">
        <h2 class="mb-4 text-xl font-bold">Request Quote Functions</h2>
        <table class="min-w-full bg-white rounded-lg shadow-md">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600">Function Name</th>
                    <th class="px-4 py-2 text-left text-gray-600">Description</th>
                    <th class="px-4 py-2 text-left text-gray-600">Price</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($this->requestQuote->requestQuoteFunctionalities as $function)
                    <tr>
                        <td class="px-4 py-2 font-medium">{{ $function['name'] }}</td>
                        <td class="px-4 py-2 text-gray-500">{{ $function['description'] ?? 'No description available' }}
                        </td>
                        <td class="px-4 py-2 text-gray-500">
                            {{ Number::currency($function['price'], in: 'HUF', locale: 'hu') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Keep the form section -->
    <form method="POST" wire:submit="checkout" class="mt-6">

        {{ $this->form }}

    </form>
    <x-filament-actions::modals />

    <div class="flex items-center justify-between mt-4">
        <span class="text-lg font-bold">Total: {{ Number::currency($total, in: 'HUF', locale: 'hu') }}</span>
        {{ $this->submitAction }}
    </div>
</div>
