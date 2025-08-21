<div>
    <x-filament::page>
        <div class="max-w-2xl mx-auto">
            <x-filament::card class="border border-gray-200 shadow-lg">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-3xl font-extrabold text-gray-900">{{ $record->project->name ?? '-' }}</h2>
                        <span
                            class="inline-block px-3 py-1 mt-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full">{{ $record->project->status ?? '-' }}</span>
                    </div>
                    <div class="text-right">
                        <span class="text-sm text-gray-400">#{{ $record->id }}</span>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="mb-2 text-lg font-semibold text-gray-700">Alapadatok</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <div class="text-xs text-gray-500">Cégnév</div>
                            <div class="font-medium">{{ $record->company_name ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Kapcsolattartó</div>
                            <div class="font-medium">{{ $record->contact_name ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Email</div>
                            <div class="font-medium">{{ $record->contact_email ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Telefon</div>
                            <div class="font-medium">{{ $record->contact_phone ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Pozíció</div>
                            <div class="font-medium">{{ $record->contact_positsion ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Token</div>
                            <div class="font-mono text-xs">{{ $record->token ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Felhasználó</div>
                            <div class="font-medium">{{ $record->user->name ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Domain</div>
                            <div class="font-medium">{{ $record->domain->name ?? '-' }}</div>
                        </div>
                        <div class="md:col-span-2">
                            <div class="text-xs text-gray-500">Tevékenységek</div>
                            <div class="font-medium">
                                @if (is_array($record->activities))
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach ($record->activities as $activity)
                                            <li class="px-2 py-1 text-xs bg-gray-100 rounded">{{ $activity }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="mb-2 text-lg font-semibold text-gray-700">Téma / Design</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <div class="text-xs text-gray-500">Meglévő weboldal</div>
                            <div class="flex items-center gap-2 font-medium">
                                @if ($record->have_exist_website)
                                    <span class="inline-block w-3 h-3 bg-green-400 rounded-full"></span> Igen
                                @else
                                    <span class="inline-block w-3 h-3 bg-gray-300 rounded-full"></span> Nem
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Weboldal URL</div>
                            <div class="font-medium">{{ $record->exist_website_url ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Határidő pontos?</div>
                            <div class="font-medium">{{ $record->is_exact_deadline ? 'Igen' : 'Nem' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Határidő</div>
                            <div class="font-medium">{{ $record->deadline?->format('Y-m-d') ?? '-' }}</div>
                        </div>
                        <div class="md:col-span-2">
                            <div class="text-xs text-gray-500">Design fájlok</div>
                            <div class="font-medium">
                                @if (is_array($record->design_files))
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach ($record->design_files as $file)
                                            <li class="px-2 py-1 text-xs bg-gray-100 rounded">{{ $file }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Elsődleges szín</div>
                            <div class="font-medium">{{ $record->primary_color ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Másodlagos szín</div>
                            <div class="font-medium">{{ $record->secondary_color ?? '-' }}</div>
                        </div>
                        <div class="md:col-span-2">
                            <div class="text-xs text-gray-500">További színek</div>
                            <div class="font-medium">
                                @if (is_array($record->additional_colors))
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach ($record->additional_colors as $color)
                                            <li class="px-2 py-1 text-xs bg-gray-100 rounded">{{ $color }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <div class="text-xs text-gray-500">Preferált betűtípusok</div>
                            <div class="font-medium">
                                @if (is_array($record->prefered_font_types))
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach ($record->prefered_font_types as $font)
                                            <li class="px-2 py-1 text-xs bg-gray-100 rounded">{{ $font }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <div class="text-xs text-gray-500">Tiltott elemek</div>
                            <div class="font-medium">
                                @if (is_array($record->banned_elements))
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach ($record->banned_elements as $el)
                                            <li class="px-2 py-1 text-xs bg-gray-100 rounded">{{ $el }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="mb-2 text-lg font-semibold text-gray-700">Tartalom / Oldalak</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <div class="text-xs text-gray-500">Saját képek</div>
                            <div class="font-medium">
                                @if (is_array($record->own_company_images) && count($record->own_company_images))
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach ($record->own_company_images as $img)
                                            <li class="px-2 py-1 text-xs bg-gray-100 rounded">
                                                {{ is_scalar($img) ? $img : json_encode($img) }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Saját videók</div>
                            <div class="font-medium">
                                @if (is_array($record->own_company_videos) && count($record->own_company_videos))
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach ($record->own_company_videos as $vid)
                                            <li class="px-2 py-1 text-xs bg-gray-100 rounded">
                                                {{ is_scalar($vid) ? $vid : json_encode($vid) }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Főoldalak</div>
                            <div class="font-medium">
                                @if (is_array($record->main_pages) && count($record->main_pages))
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach ($record->main_pages as $page)
                                            <li class="px-2 py-1 text-xs bg-gray-100 rounded">
                                                {{ is_scalar($page) ? $page : json_encode($page) }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Termékkatalógus</div>
                            <div class="font-medium">
                                @if (is_array($record->product_catalog) && count($record->product_catalog))
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach ($record->product_catalog as $item)
                                            <li class="px-2 py-1 text-xs bg-gray-100 rounded">
                                                {{ is_scalar($item) ? $item : json_encode($item) }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Többnyelvűség</div>
                            <div class="font-medium">{{ $record->need_multi_language ? 'Igen' : 'Nem' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Nyelvek</div>
                            <div class="font-medium">{{ $record->languages_for_website ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Call to actions</div>
                            <div class="font-medium">
                                @if (is_array($record->call_to_actions) && count($record->call_to_actions))
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach ($record->call_to_actions as $cta)
                                            <li class="px-2 py-1 text-xs bg-gray-100 rounded">
                                                {{ is_scalar($cta) ? $cta : json_encode($cta) }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Blog</div>
                            <div class="font-medium">{{ $record->have_blog ? 'Igen' : 'Nem' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Blog bejegyzések száma</div>
                            <div class="font-medium">{{ $record->exist_blog_count ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">SEO fontossága</div>
                            <div class="font-medium">{{ $record->importance_of_seo ? 'Igen' : 'Nem' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Fizetett hirdetés</div>
                            <div class="font-medium">{{ $record->have_payed_advertising ? 'Igen' : 'Nem' }}</div>
                        </div>
                        <div class="md:col-span-2">
                            <div class="text-xs text-gray-500">Egyéb elvárás, kérés</div>
                            <div class="font-medium">{{ $record->other_expectation_or_request ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="mb-2 text-lg font-semibold text-gray-700">Webshop</h3>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <div class="text-xs text-gray-500">CSV fájlok</div>
                            <div class="font-medium">
                                @if (is_array($record->products_csv_file) && count($record->products_csv_file))
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach ($record->products_csv_file as $csv)
                                            <li class="px-2 py-1 text-xs bg-gray-100 rounded">
                                                {{ is_scalar($csv) ? $csv : json_encode($csv) }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Kiemelt kategóriák</div>
                            <div class="font-medium">
                                @if (is_array($record->highlighted_categories) && count($record->highlighted_categories))
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach ($record->highlighted_categories as $cat)
                                            <li class="px-2 py-1 text-xs bg-gray-100 rounded">
                                                {{ is_scalar($cat) ? $cat : json_encode($cat) }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Bruttó/Netto</div>
                            <div class="font-medium">{{ $record->bruto_netto ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Üzlet címe</div>
                            <div class="font-medium">{{ $record->store_address ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Szállítási cím</div>
                            <div class="font-medium">{{ $record->shipping_address ?? '-' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Csomagpontok</div>
                            <div class="font-medium">
                                @if (is_array($record->parcel_points) && count($record->parcel_points))
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach ($record->parcel_points as $point)
                                            <li class="px-2 py-1 text-xs bg-gray-100 rounded">
                                                {{ is_scalar($point) ? $point : json_encode($point) }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Könyvelő szerződött?</div>
                            <div class="font-medium">{{ $record->have_contracted_accountant ? 'Igen' : 'Nem' }}</div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Könyvelők</div>
                            <div class="font-medium">
                                @if (is_array($record->contracted_accountants) && count($record->contracted_accountants))
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach ($record->contracted_accountants as $acc)
                                            <li class="px-2 py-1 text-xs bg-gray-100 rounded">
                                                {{ is_scalar($acc) ? $acc : json_encode($acc) }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Fizetési módok</div>
                            <div class="font-medium">
                                @if (is_array($record->payment_methods) && count($record->payment_methods))
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach ($record->payment_methods as $pay)
                                            <li class="px-2 py-1 text-xs bg-gray-100 rounded">
                                                {{ is_scalar($pay) ? $pay : json_encode($pay) }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Online bankkártyás fizetés</div>
                            <div class="font-medium">
                                {{ $record->have_contracted_online_bank_card_payment ? 'Igen' : 'Nem' }}</div>
                        </div>
                        <div class="md:col-span-2">
                            <div class="text-xs text-gray-500">Online bankkártyás opciók</div>
                            <div class="font-medium">
                                @if (is_array($record->online_bank_card_payment_options) && count($record->online_bank_card_payment_options))
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach ($record->online_bank_card_payment_options as $opt)
                                            <li class="px-2 py-1 text-xs bg-gray-100 rounded">
                                                {{ is_scalar($opt) ? $opt : json_encode($opt) }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="mb-2 text-lg font-semibold text-gray-700">Válaszok</h3>
                    @if (!empty($record->responses))
                        <ul class="divide-y divide-gray-100">
                            @foreach ($record->responses as $response)
                                <li class="flex items-center justify-between py-2">
                                    <span>{{ $response->content }}</span>
                                    <span
                                        class="text-xs text-gray-400">{{ $response->created_at?->format('Y-m-d H:i') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="italic text-gray-400">Nincs válasz.</div>
                    @endif
                </div>

                <div class="mb-6">
                    <h3 class="mb-2 text-lg font-semibold text-gray-700">Kapcsolódó űrlapok</h3>
                    @if (!empty($record->forms))
                        <ul class="flex flex-wrap gap-2">
                            @foreach ($record->forms as $form)
                                <li>
                                    <a href="{{ route('filament.dashboard.resources.form-questions.view', $form) }}"
                                        class="px-3 py-1 text-blue-700 transition rounded bg-blue-50 hover:bg-blue-100">
                                        {{ $form->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="italic text-gray-400">Nincs kapcsolódó űrlap.</div>
                    @endif
                </div>

                <div class="mb-6">
                    <h3 class="mb-2 text-lg font-semibold text-gray-700">Kapcsolódó kérdések</h3>
                    @if (!empty($record->relatedQuestions))
                        <ul class="flex flex-col gap-1">
                            @foreach ($record->relatedQuestions as $relatedQuestion)
                                <li>
                                    <a href="{{ route('filament.dashboard.resources.form-questions.view', $relatedQuestion) }}"
                                        class="text-blue-600 hover:underline">
                                        {{ $relatedQuestion->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="italic text-gray-400">Nincs kapcsolódó kérdés.</div>
                    @endif
                </div>

                <div class="pt-4 mb-4 border-t">
                    <div class="flex flex-col text-sm text-gray-500 md:flex-row md:justify-between">
                        <div>Létrehozva: <span
                                class="font-medium text-gray-700">{{ $record->created_at?->format('Y-m-d H:i') }}</span>
                        </div>
                        <div>Módosítva: <span
                                class="font-medium text-gray-700">{{ $record->updated_at?->format('Y-m-d H:i') }}</span>
                        </div>
                    </div>
                </div>
            </x-filament::card>
            <div class="pt-4 mt-6 text-center border-t border-gray-200">
                <x-filament::button icon="heroicon-o-arrow-left" color="secondary" :url="route('filament.dashboard.resources.form-questions.index')">
                    Vissza a kérdésekhez
                </x-filament::button>
            </div>
        </div>
    </x-filament::page>
</div>
