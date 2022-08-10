<div>
    <table class='{{ $class }}'>
    
        @if($headers)
        <thead>
            <tr>
            @foreach($headers as $headTxt)
                <th>{{ $headTxt }}</th>
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