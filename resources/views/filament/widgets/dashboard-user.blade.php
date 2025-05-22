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

        <div class="col-span-full">
            <h3 class="text-base font-semibold leading-6 text-gray-950 dark:text-white">
                {{ __('Welcome to the application!') }}
            </h3>
            <p class="overflow-hidden text-sm text-gray-500 break-words dark:text-gray-400">
                {{ __('We are glad to have you here. Please take a moment to explore the features and functionalities of our application. If you have any questions, feel free to reach out to our support team.') }}
            </p>
            <p class="overflow-hidden text-sm text-gray-500 break-words dark:text-gray-400">
                {{ __('We hope you enjoy your experience!') }}
            </p>
            <p class="overflow-hidden text-sm text-gray-500 break-words dark:text-gray-400">
                {{ __('Best regards,') }}
            </p>
            <p class="overflow-hidden text-sm text-gray-500 break-words dark:text-gray-400">
                {{ __('The Team') }}
            </p>

        </div>
</x-filament-widgets::widget>
