@use('App\Models\WebsiteLanguage')

@php
    $record = $getRecord();
    $requestQuote = $record?->requestQuote;
    $languageIds = $requestQuote?->languages;
    $languages = $languageIds ? WebsiteLanguage::whereIn('id', $languageIds)->get() : collect();
@endphp

<div>
    @if (!$requestQuote)
        <p class="text-gray-500 dark:text-gray-400">Nincs árajánlat kapcsolva ehhez a projekthez.</p>
    @elseif (!$requestQuote->is_multilangual)
        <p class="text-gray-500 dark:text-gray-400">Ez nem egy többnyelvű weboldal.</p>
    @elseif (!$languageIds || !is_array($languageIds) || count($languageIds) === 0)
        <p class="text-gray-500 dark:text-gray-400">Nincsenek nyelvek megadva.</p>
    @else
        <div class="overflow-x-auto">
            <table
                class="w-full border border-gray-200 divide-y divide-gray-200 rounded-lg dark:divide-gray-700 dark:border-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th
                            class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                            Nyelv
                        </th>
                        <th
                            class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                            Alapértelmezett
                        </th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                    @foreach ($languages as $language)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="px-4 py-2 text-sm text-gray-900 dark:text-gray-100">
                                @php
                                    $flags = [
                                        'hu' => '🇭🇺',
                                        'en' => '🇬🇧',
                                        'de' => '🇩🇪',
                                        'fr' => '🇫🇷',
                                        'es' => '🇪🇸',
                                        'it' => '🇮🇹',
                                        'ro' => '🇷🇴',
                                        'sk' => '🇸🇰',
                                        'hr' => '🇭🇷',
                                        'sr' => '🇷🇸',
                                        'cs' => '🇨🇿',
                                        'pl' => '🇵🇱',
                                        'ru' => '🇷🇺',
                                        'zh' => '🇨🇳',
                                        'ja' => '🇯🇵',
                                        'ko' => '🇰🇷',
                                        'pt' => '🇵🇹',
                                        'nl' => '🇳🇱',
                                        'sv' => '🇸🇪',
                                        'da' => '🇩🇰',
                                        'no' => '🇳🇴',
                                        'fi' => '🇫🇮',
                                        'el' => '🇬🇷',
                                        'tr' => '🇹🇷',
                                        'ar' => '🇸🇦',
                                        'he' => '🇮🇱',
                                        'hi' => '🇮🇳',
                                    ];
                                    $langCode = strtolower(substr($language->name ?? '', 0, 2));
                                    $flag = $flags[$langCode] ?? '🌐';
                                @endphp
                                <span class="mr-2">{{ $flag }}</span>
                                {{ $language->name ?? '-' }}
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400">
                                @if ($requestQuote->default_language == $language->id)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        Alapértelmezett
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-200">
                                        Fordítás
                                    </span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($requestQuote->default_language)
            @php
                $defaultLanguage = WebsiteLanguage::find($requestQuote->default_language);
            @endphp
            <div class="p-3 mt-4 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                <p class="text-sm text-blue-800 dark:text-blue-200">
                    <strong>Alapértelmezett nyelv:</strong>
                    {{ $defaultLanguage->name ?? $requestQuote->default_language }}
                </p>
            </div>
        @endif
    @endif
</div>
