@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="{{ Vite::asset('resources/images/cegem360-logo.webp') }}" class="logo" alt="Cegem360 Logo"
                    style="width: 180px; max-width: 100%;">
            @else
                {!! $slot !!}
            @endif
        </a>
    </td>
</tr>
