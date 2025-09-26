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
                        {{ __('Back to dashboard') }}
                    </a>
                @else
                    <div class="flex gap-2">
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            {{ __('Login') }}
                        </a>
                        <a href="{{ route('filament.dashboard.auth.register') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            {{ __('Register') }}
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Keskenyebb tartalom rész középre igazítva -->
    <div class="max-w-3xl p-8 mx-auto bg-white rounded-b-lg shadow">

        <h1 class="mb-4 text-2xl font-bold text-center">
            {{ __('Welcome to the automatic website quote request system!') }}
        </h1>
        <p class="mb-4">
            {{ __('In just a few minutes, you can receive an official quote for website, webshop, or landing page development for both individuals and companies.') }}
        </p>
        <ul class="mb-4 space-y-1 list-disc list-inside">
            <li>
                {{ __('Fast and') }} <strong>{{ __('transparent process') }}</strong>
                – {{ __('after answering a few questions, you will immediately see the quote') }}.
            </li>
            <li><strong>{{ __('Automatic quote request') }}</strong> {{ __('and') }} <strong>{{ __('simple order placement') }}</strong> {{ __('in one place') }}.</li>
            <li><strong>{{ __('Platforms') }}:</strong> {{ __('Exclusively Laravel and PHP') }}.</li>
            <li><strong>{{ __('Own account') }}:</strong> {{ __('track quotes, new order, advance payment, download documents') }}.</li>
            <li>{{ __('Our customer service assists throughout the process, we respond quickly to any questions') }}.</li>
        </ul>
        <div class="mb-4 text-center">
            <span class="text-lg font-semibold text-blue-700">{{ __('1. Fill out the form') }} &rarr; {{ __('2. Review our quote') }} &rarr; {{ __('3. Order online!') }}</span>
        </div>
        <div class="mt-4 text-center text-gray-600">
            <span>{{ __('Trust us with your web project - simply, quickly, safely!') }}</span>
        </div>
    </div>
</div>
