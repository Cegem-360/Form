<div class="relative w-full max-w-6xl mx-auto my-8">
    <!-- Szélesebb felső sáv a gombokkal és logóval -->
    <div class="w-full p-4 bg-white">
        <div class="flex items-center justify-between">
            <!-- Bal oldali üres elem a flex helykitöltéshez -->
            <div class="w-1/3"></div>

            <!-- Középre igazított logó -->
            <div class="flex items-center justify-center w-1/3">
                <img src="{{ Vite::asset('resources/images/cegem360-logo.webp') }}" alt="Cégem 360 Logó" class="h-16">
            </div>

            <!-- Jobb oldalra igazított gombok -->
            <div class="flex justify-end w-1/3">
                @auth
                    <a href="{{ route('filament.dashboard.pages.dashboard') }}"
                        class="px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Vissza a dashboardra
                    </a>
                @else
                    <div class="flex gap-2">
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Belépés
                        </a>
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Regisztráció
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Keskenyebb tartalom rész középre igazítva -->
    <div class="max-w-3xl p-8 mx-auto bg-white rounded-b-lg shadow">

        <h1 class="mb-4 text-2xl font-bold text-center">Üdvözöljük az automatikus weboldal-ajánlatkérő rendszerben!</h1>
        <p class="mb-4">Pár perc alatt hivatalos árajánlatot kaphat weboldal, webshop vagy landing page fejlesztésre –
            magánszemélyeknek és cégeknek egyaránt.</p>
        <ul class="mb-4 space-y-1 list-disc list-inside">
            <li>Gyors és <strong>átlátható folyamat</strong> – néhány kérdés megválaszolása után azonnal látja az
                ajánlatot.
            </li>
            <li><strong>Automatikus árajánlatkérés</strong> és <strong>egyszerű rendelésleadás</strong> egy helyen.</li>
            <li><strong>Platformok:</strong> WordPress, egyedi Laravel, Shopify.</li>
            <li><strong>Saját fiók:</strong> ajánlatok nyomon követése, új megrendelés, előlegfizetés, dokumentumok
                letöltése.</li>
            <li>Ügyfélszolgálatunk végig segíti a folyamatot, kérdés esetén gyorsan válaszolunk.</li>
        </ul>
        <div class="mb-4 text-center">
            <span class="text-lg font-semibold text-blue-700">1. Töltse ki az űrlapot &rarr; 2. Tekintse meg
                ajánlatunkat
                &rarr; 3. Rendelje meg online!</span>
        </div>
        <div class="mt-4 text-center text-gray-600">
            <span>Bízza ránk webes projektjét – egyszerűen, gyorsan, biztonságosan!</span>
        </div>
    </div>
</div>
