@use('Illuminate\Support\Facades\Storage')

@if ($getState() == 'website_previews/short_preview.png')
    <p>
        Csak szöveget tartalmaz egyszerü szerkezetben. Elrendezés és formázaást tartalmaz de képeket vizuális anyagokat
        nélkül.
    </p>
@elseif ($getState() == 'website_previews/medium_preview.jpg')
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

<img src='{{ Storage::url($getState()) }}' size="w-16 h-16" class="rounded" />
