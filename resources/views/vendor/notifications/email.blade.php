<x-mail::message>
    {{-- Köszöntés --}}
    @if (!empty($greeting))
        {{ $greeting }}
    @else
        @if ($level === 'error')
            @lang('Whoops!')
        @else
            @lang('Hello!')
        @endif
    @endif
    @foreach ($introLines as $line)
        {{ $line }}
    @endforeach
    @isset($actionText)
        <?php
        $color = match ($level) {
            'success', 'error' => $level,
            default => 'primary',
        };
        ?>
        <x-mail::button :url="$actionUrl" :color="$color">
            {{ $actionText }}
        </x-mail::button>
    @endisset
    @foreach ($outroLines as $line)
        {{ $line }}
    @endforeach
    @if (!empty($salutation))
        {{ $salutation }}
    @else
        @lang('Regards,')<br>
        {{ config('app.name') }}
    @endif
    @isset($actionText)
        <x-slot:subcopy>
            @lang("If you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n" . 'into your web browser:', [
                'actionText' => __($actionText),
            ]) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
        </x-slot:subcopy>
    @endisset
</x-mail::message>
