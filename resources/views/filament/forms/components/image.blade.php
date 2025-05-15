@use('Illuminate\Support\Facades\Storage')
@php
    $image = match ($getState()) {
        'short' => 'website_previews/short_preview.png',
        'medium' => 'website_previews/medium_preview.png',
        'large' => 'website_previews/large_preview.png',
        default => 'website_previews/medium_preview.png',
    };
@endphp
<div class="flex flex-row flex-wrap">
    <div class="flex flex-col w-full">
        @if ($getState() == 'short')
            <p>
                Ideális választás a lényegre törő, gyorsan áttekinthető aloldalakhoz, mint például egy szolgáltatás
                rövid
                bemutatása vagy egy kapcsolati oldal. Maximum 2 szakaszt tartalmaz, melyekben 1-1 szövegdoboz és 1-1 kép
                helyezhető el.
            </p>
        @elseif ($getState() == 'large')
            <p>
                A legátfogóbb választás, tökéletes részletes termékoldalakhoz, szolgáltatásbemutatókhoz, amelyek alapos
                tájékoztatást nyújtanak. Akár 10 kép és 10 szövegdoboz, 5 banner, valamint olyan elemek, mint
                „előnyeink”
                szekció, egyedi kép-szöveg kompozíciók, visszaszámláló, "rólunk mondták" idézetek, értékelések, valamint
                termék-
                és szolgáltatáskategóriák behúzása is beilleszthető.
            </p>
        @else
            <p>
                Ez az opció lehetőséget biztosít részletesebb információk megjelenítésére, elegendő térrel egy termék
                vagy
                szolgáltatás komplexebb leírásához. Tartalmazhat maximum 5 képet, 5 szövegdobozt és 2 bannert,
                biztosítva az
                optimális egyensúlyt a szöveg és a vizuális elemek között.
            </p>

            </p>
        @endif
    </div>
    @if ($show_image)
        <!-- Modal -->
        <div id="imageModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50"
            onclick="this.classList.add('hidden')">
            <div class="relative bg-transparent max-w-full max-h-[90vh] rounded"
                onclick="event.stopPropagation(); event.preventDefault();">
                <button onclick="document.getElementById('imageModal').classList.add('hidden')"
                    class="absolute text-xl text-white bg-black top-2 right-2">&times;</button>
                <img src="{{ Storage::url($image) }}" class="max-w-full max-h-[90vh] rounded" />
            </div>
        </div>

        <div class="flex content-center justify-center w-full text-center">
            <img src='{{ Storage::url($image) }}' class="w-1/2 rounded cursor-pointer"
                onclick="document.getElementById('imageModal').classList.remove('hidden')" />
        </div>
    @endif
</div>
