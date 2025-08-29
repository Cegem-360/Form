@php
    $record = $getRecord();
    $requestQuote = $record?->requestQuote;
    $websites = $requestQuote?->websites;
@endphp

<div>
    @if (!$requestQuote)
        <p class="text-gray-500 dark:text-gray-400">Nincs árajánlat kapcsolva ehhez a projekthez.</p>
    @elseif (!is_array($websites) || count($websites) === 0)
        <p class="text-gray-500 dark:text-gray-400">Nincsenek weboldal oldalak megadva.</p>
    @else
        <div class="overflow-x-auto">
            <table
                class="w-full border border-gray-200 divide-y divide-gray-200 rounded-lg dark:divide-gray-700 dark:border-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th
                            class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                            Oldal neve
                        </th>
                        <th
                            class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                            Tartalom hossza
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                    @foreach ($websites as $website)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">
                                {{ $website['name'] ?? '-' }}
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400">
                                @php
                                    $length = $website['length'] ?? null;
                                    $lengthLabel = match ($length) {
                                        'short' => 'Rövid',
                                        'medium' => 'Közepes',
                                        'long' => 'Hosszú',
                                        default => $length ?? '-',
                                    };
                                    $lengthClass = match ($length) {
                                        'short' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                        'medium'
                                            => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                        'long' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                        default => 'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-200',
                                    };
                                @endphp
                                @if ($length)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $lengthClass }}">
                                        {{ $lengthLabel }}
                                    </span>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
