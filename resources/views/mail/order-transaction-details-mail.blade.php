<x-mail::message>

    <h1>Rendelés visszaigazolása</h1>
    Köszönjük a rendelését! Az alábbiakban találja a banki átutalás adatait:
    <x-mail::panel>
        <p>Átutalási adatok:</p>
        <ul>
            <li>Cégnév: Cegem360 Kft.</li>
            <li>Bankszámlaszám: 126000161712942518957306</li>
            <li>Bank: Wise</li>
            <li>Közlemény: Rendelésszám: {{ $order->id }}</li>
        </ul>
    </x-mail::panel>
    Köszönettel,
    {{ config('app.name') }}
</x-mail::message>
