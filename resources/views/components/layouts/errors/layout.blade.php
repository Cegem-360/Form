<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Hiba')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body
        class="flex items-center justify-center min-h-screen antialiased bg-gradient-to-br from-gray-50 to-gray-200 dark:from-gray-900 dark:to-gray-800">
        <div
            class="w-full max-w-md p-10 text-center border border-gray-200 shadow-2xl bg-white/80 dark:bg-gray-900/80 rounded-2xl dark:border-gray-800">
            <div class="flex flex-col items-center gap-4">
                <div class="p-4 mb-2 bg-red-100 rounded-full shadow-lg dark:bg-red-900 animate-pulse">
                    <!-- Példa ikon (Heroicons X) -->
                    <svg class="w-12 h-12 text-red-500 dark:text-red-400" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <h1 class="mb-2 text-6xl font-extrabold text-gray-800 dark:text-gray-100">@yield('code', 'Hiba')</h1>
                <h2 class="mb-4 text-xl font-semibold text-gray-600 dark:text-gray-300">@yield('message', 'Valami hiba történt')
                </h2>
                <a href="{{ url('/') }}"
                    class="inline-block px-6 py-2 mt-4 text-white transition bg-blue-600 rounded-lg shadow hover:bg-blue-700">Vissza
                    a főoldalra</a>
            </div>
        </div>
    </body>

</html>
