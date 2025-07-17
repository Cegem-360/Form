<x-mail::message>
    {{-- Köszöntés --}}
    @if (!empty($greeting))
        <p style="font-size: 1.25rem; font-weight: bold; margin-bottom: 1rem; color: #4F46E5;">{{ $greeting }}</p>
    @else
        @if ($level === 'error')
            <p style="font-size: 1.25rem; font-weight: bold; margin-bottom: 1rem; color: #DC2626;">@lang('Whoops!')</p>
        @else
            <p style="font-size: 1.25rem; font-weight: bold; margin-bottom: 1rem; color: #4F46E5;">@lang('Hello!')</p>
        @endif
    @endif
    <div style="margin-bottom: 1.5rem;">
        @foreach ($introLines as $line)
            <p style="margin: 0 0 0.5rem 0; color: #374151;">{{ $line }}</p>
        @endforeach
    </div>
    @isset($actionText)
        <?php
        $color = match ($level) {
            'success' => '#16A34A',
            'error' => '#DC2626',
            default => '#4F46E5',
        };
        ?>
        <div style="text-align: center; margin: 2rem 0;">
            <a href="{{ $actionUrl }}"
                style="display: inline-block; padding: 0.75rem 2rem; font-size: 1rem; font-weight: bold; color: #fff; background: {{ $color }}; border-radius: 0.5rem; text-decoration: none;">
                {{ $actionText }}
            </a>
        </div>
    @endisset
    <div style="margin-bottom: 1.5rem;">
        @foreach ($outroLines as $line)
            <p style="margin: 0 0 0.5rem 0; color: #374151;">{{ $line }}</p>
        @endforeach
    </div>
    @if (!empty($salutation))
        <p style="margin-top: 2rem; color: #4F46E5; font-weight: bold;">{{ $salutation }}</p>
    @else
        <p style="margin-top: 2rem; color: #4F46E5; font-weight: bold;">@lang('Regards,')<br>{{ config('app.name') }}
        </p>
    @endif
    @isset($actionText)
        <x-slot:subcopy>
            <p style="font-size: 0.95rem; color: #6B7280; margin-top: 2rem;">
                @lang("If you're having trouble clicking the \":actionText\" button, copy and paste the URL below into your web browser:", [
                    'actionText' => __($actionText),
                ])<br>
                <span style="word-break: break-all; color: #4F46E5;">{{ $displayableActionUrl }}</span>
            </p>
        </x-slot:subcopy>
    @endisset
</x-mail::message>
