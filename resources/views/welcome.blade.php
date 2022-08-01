<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="ngaspari">

        <title>Demo contacts app</title>
        
        <link href="{{ asset('css/app.css') }}" media="screen" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="main">
            <h1>Demo contacts app</h1>
            <a href="{{ url('/contacts/list/') }}">List of contacts</a>            

            <div class="version">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>
    </body>
</html>
