<div>
    <table class='{{ $class }}'>
    
        @if($headers)
        <thead>
            <tr>
            @foreach($headers as $header)
                <th class='{{ $header['class'] }}'>
                    <div class='inline-flex space-x-4 w-full {{ $header['class'] }}'>
                        @if($header['link'])        
                            <a href='{{ $header['link'] }}'>{{ $header['name'] }}</a>
                        @else
                            {{ $header['name'] }}
                        @endif
                        
                        @isset($header['sord'])
                            @if($header['sord'] == 'asc')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                            @elseif($header['sord'] == 'desc')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        @endisset
                    </div>
                 </th>
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