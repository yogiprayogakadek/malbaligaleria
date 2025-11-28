@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            <img src="{{ asset('assets/images/logo.png') }}" class="logo" alt="Mal Bali Galeria Logo">
            {{-- @if (trim($slot) === 'Laravel')
            @else
                {!! $slot !!}
            @endif --}}
        </a>
    </td>
</tr>
