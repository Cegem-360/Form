<x-mail::message>
    <h2>Tárgy: Az Ön weboldal fejlesztési árajánlata megérkezett!</h2>
    <p>
        Kedves <strong>{{ $requestQuote->name }}</strong>!
    </p>
    <p>
        Köszönjük, hogy igénybe vette automatikus árajánlatkérő rendszerünket weboldal fejlesztési projektjéhez!<br>
        Örömmel értesítjük, hogy az Ön által megadott igények alapján összeállított hivatalos árajánlat elkészült.<br>
        Kérjük, tekintse meg a csatolmányt, amelyben PDF formátumban találja részletes ajánlatunkat.
    </p>
    <h3>Mi a következő lépés?</h3>
    <ul>
        <li>
            <strong>Ajánlat elfogadása és megrendelés:</strong> Amennyiben ajánlatunk elnyerte tetszését, fiókjába
            bejelentkezve könnyedén elfogadhatja azt, és leadhatja megrendelését.
        </li>
        <li>
            <strong>Fiókja:</strong> Saját fiókjában bármikor hozzáférhet korábbi ajánlataihoz, nyomon követheti
            megrendelései állapotát, és az előleg kifizetését is intézheti.
        </li>
    </ul>
    <p>
        Bízunk benne, hogy ajánlatunk megfelel az elvárásainak, és hamarosan Önt is elégedett ügyfeleink között
        üdvözölhetjük!
    </p>
    <p>
        Ha bármilyen további kérdése merülne fel, vagy módosítani szeretné az igényeit, kérjük, forduljon hozzánk
        bizalommal az <strong>info@cegem360.hu</strong> címen, vagy hívjon minket a <strong>[Telefonszám]</strong>
        számon.
    </p>
    <p>
        Üdvözlettel,<br>
        A <strong> Cégem360 Kft.</strong> Csapata<br>
        <a href="https://cegem360.hu" target="_blank">Weboldalunk</a>
    </p>
    <x-mail::button :url="''">
        Ajánlat megtekintése
    </x-mail::button>
    <p>
        Köszönettel,<br>
        Cégem360 Kft.
    </p>
</x-mail::message>
