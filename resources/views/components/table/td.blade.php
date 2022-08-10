@props(['align' => 'left'])

@php
    // lookup table
    $textAlignClass = [
        'left'  => 'text-left',
        'right' => 'text-right',
        'center'=> 'text-center',
    ][$align] ?? 'text-left';
@endphp

<td class='{{  $textAlignClass }}'>
    {{ $slot }}
</td>