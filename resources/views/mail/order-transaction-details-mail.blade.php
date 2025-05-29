<x-mail::message>
    # Rendelés visszaigazolása
    Köszönjük a rendelését! Az alábbiakban találja a banki átutalás adatait:
    <x-mail::panel>
        **Átutalási adatok:**
        - **Cégnév:** Cegem360 Kft.
        - **Bankszámlaszám:** 126000161712942518957306
        - **Bank:** Wise
        - **Közlemény:** Rendelésszám: {{ $order->id }}
    </x-mail::panel>
    Köszönettel,<br>
    {{ config('app.name') }}
</x-mail::message>
