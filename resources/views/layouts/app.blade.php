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
        
    </head>
    <body class='bg-gradient-to-r from-gray-100 to-gray-200'>
        <div class="main">
            @yield('content')
        </div>
	</body>
</html>
