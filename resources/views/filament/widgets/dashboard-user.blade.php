@php
    $columns = $this->getColumns();
    $heading = $this->getHeading();
    $description = $this->getDescription();
    $hasHeading = filled($heading);
    $hasDescription = filled($description);
@endphp

<x-filament-widgets::widget class="grid fi-wi-stats-overview gap-y-4">
    @if ($hasHeading || $hasDescription)
        <div class="grid fi-wi-stats-overview-header gap-y-1">
            @if ($hasHeading)
                <h3
                    class="text-base font-semibold leading-6 fi-wi-stats-overview-header-heading col-span-full text-gray-950 dark:text-white">
                    {{ $heading }}
                </h3>
            @endif

            @if ($hasDescription)
                <p
                    class="overflow-hidden text-sm text-gray-500 break-words fi-wi-stats-overview-header-description dark:text-gray-400">
                    {{ $description }}
                </p>
            @endif
        </div>
    @endif

    <div @if ($pollingInterval = $this->getPollingInterval()) wire:poll.{{ $pollingInterval }} @endif @class([
        'fi-wi-stats-overview-stats-ctn grid gap-6',
        'md:grid-cols-1' => $columns === 1,
        'md:grid-cols-2' => $columns === 2,
        'md:grid-cols-3' => $columns === 3,
        'md:grid-cols-2 xl:grid-cols-4' => $columns === 4,
    ])>
        {{-- Köszöntő szöveg a User-nek a program használatához --}}

        <div class="max-w-4xl p-6 mx-auto bg-white rounded-lg shadow dark:bg-gray-900">
            <h1 class="mb-4 text-2xl font-bold text-gray-900 dark:text-white">
                {{ __('Welcome to the Cégem 360 Quote Request Portal!') }}
            </h1>
            <p class="mb-6 text-gray-700 dark:text-gray-300">{{ __('Easily manage your quotes and projects here:') }}
            </p>

            <ul class="space-y-4">
                <li class="flex items-start">
                    <span class="mr-2 font-semibold text-primary-600 dark:text-primary-400">•</span>
                    <p class="text-gray-800 dark:text-gray-200">
                        <strong>{{ __('Quote Overview:') }}</strong>
                        {{ __('Browse all your previous quote requests.') }}
                    </p>
                </li>
                <li class="flex items-start">
                    <span class="mr-2 font-semibold text-primary-600 dark:text-primary-400">•</span>
                    <p class="text-gray-800 dark:text-gray-200">
                        <strong>{{ __('New Quote Request:') }}</strong>
                        {{ __('Submit a new quote quickly and easily.') }}
                    </p>
                </li>
                <li class="flex items-start">
                    <span class="mr-2 font-semibold text-primary-600 dark:text-primary-400">•</span>
                    <p class="text-gray-800 dark:text-gray-200">
                        <strong>{{ __('Order and Payment:') }}</strong>
                        {{ __('Order directly from your quotes and pay online by card or bank transfer.') }}
                    </p>
                </li>
                <li class="flex items-start">
                    <span class="mr-2 font-semibold text-primary-600 dark:text-primary-400">•</span>
                    <p class="text-gray-800 dark:text-gray-200">
                        <strong>{{ __('Invoices:') }}</strong>
                        {{ __('Download advance and final invoices after payment.') }}
                    </p>
                </li>
                <li class="flex items-start">
                    <span class="mr-2 font-semibold text-primary-600 dark:text-primary-400">•</span>
                    <p class="text-gray-800 dark:text-gray-200">
                        <strong>{{ __('Project Tracking:') }}</strong>
                        {{ __('Monitor the status of all your ordered projects and view related materials.') }}
                    </p>
                </li>
            </ul>

            <p class="mt-6 text-gray-600 dark:text-gray-400">
                {{ __('We hope this platform makes your work easier and more efficient!') }}
            </p>
        </div>
    </div>

</x-filament-widgets::widget>
