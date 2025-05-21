<x-filament-panels::page>
    <x-slot name="title">
        {{ __('Settings') }}
    </x-slot>

    <x-slot name="header">
        {{ __('Settings') }}
    </x-slot>

    <div class="p-4">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ __('Settings') }}</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">{{ __('Manage your application settings here.') }}</p>
    </div>

    <div class="p-4">

    </div>
    <div class="p-4">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ __('General Settings') }}</h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400">{{ __('Configure general application settings.') }}</p>
    </div>
    <div class="p-4">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ __('User Management') }}</h2>
        <p class="mt-2 text-gray-600 dark:text-gray-400">{{ __('Manage user roles and permissions.') }}</p>
    </div>
</x-filament-panels::page>
