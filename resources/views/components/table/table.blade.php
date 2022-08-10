<div>
    <table class='{{ $class }}'>
    
        @if($headers)
        <thead>
            <tr>
            @foreach($headers as $header)
                <th class='{{ $header['class'] }}'>{{ $header['name'] }}</th>
            @endforeach
            </tr>
        </thead>
        @endif
        
        <tbody>
            {{ $slot }}
        </tbody>
        
        
        @if($footers)
        <tfoot>
        </tfoot>
        @endif
    </table>
</div>