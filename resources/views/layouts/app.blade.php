<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="ngaspari">
        
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ $pageTitle ?? 'Laravel app' }}</title>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <link href="{{ asset('css/contacts.css') }}" media="screen" rel="stylesheet" type="text/css">
        
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/redmond/jquery-ui.min.css">
        
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.13.2/css/ui.jqgrid.min.css">
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.13.2/js/jquery.jqgrid.src.js"></script>
        
        <script src="{{ asset('js/bindWithDelay.js') }}"></script>

        <script>
        $(document).ready(function() {
        	var csrfHeader = $('meta[name="csrf-token"]').attr('content');
        	$.ajaxSetup({
        	    headers : {
        	        'X-CSRF-Token' : csrfHeader
        	    }
        	});
        });
        </script>
        
        @yield('head')

    </head>
    <body class='bg-gradient-to-r from-gray-100 to-gray-200'>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                        <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div>
                          {{ $error }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="main">
            @yield('content')
        </div>
	</body>
</html>
