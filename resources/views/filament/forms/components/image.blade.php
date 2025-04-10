@use('Illuminate\Support\Facades\Storage')
@php
    $image = match ($getState()) {
        'short' => 'website_previews/short_preview.png',
        'medium' => 'website_previews/medium_preview.png',
        'large' => 'website_previews/large_preview.png',
        default => 'website_previews/medium_preview.png',
    };
@endphp

@if ($getState() == 'website_previews/short_preview.png')
    <p>
        Csak szöveget tartalmaz egyszerü szerkezetben. Elrendezés és formázaást tartalmaz de képeket vizuális anyagokat
        nélkül.
    </p>
@elseif ($getState() == 'website_previews/medium_preview.png')
    <p>
        Már tartalmaz képeket és formázott szöveget, de mennyiségben korlátozott.
        Ez a fájl mérete kisebb, és gyorsabban betöltődik, mint a teljes képernyős előnézet.
        <br />
        <strong>Megjegyzés:</strong> Ez a fájl mérete kisebb, és gyorsabban betöltődik, mint a teljes képernyős
        előnézet.
    </p>
@else
    <p>
        Teljes képernyős előnézet, amely tartalmazza az összes szöveget és képet, amely a weboldalon megjelenik.
        Ez a legjobb választás, ha a weboldal teljes megjelenését szeretné bemutatni.
        <br />
        <strong>Megjegyzés:</strong> Ez a fájl mérete nagyobb lehet, és hosszabb időt vehet igénybe a betöltéshez.

    </p>
@endif
@if ($show_image)
    <!-- Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50"
        onclick="this.classList.add('hidden')">
        <div class="relative bg-transparent" onclick="event.stopPropagation(); event.preventDefault();">
            <button onclick="document.getElementById('imageModal').classList.add('hidden')"
                class="absolute text-xl text-white bg-black top-2 right-2">&times;</button>
            <img src="{{ Storage::url($image) }}" class="max-w-full max-h-[90vh] rounded" />
        </div>
    </div>

    <div class="flex justify-center">
        <img src='{{ Storage::url($image) }}' class="w-auto h-[200px] max-h-[200px] rounded cursor-pointer"
            onclick="document.getElementById('imageModal').classList.remove('hidden')" />
    </div>
@endif
