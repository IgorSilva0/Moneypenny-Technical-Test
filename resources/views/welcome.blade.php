<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Moneypenny - Technical Test</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-100 flex items-center justify-center min-h-screen">
       <a href="{{ route('albums.index') }}" class=" transition-all bg-green-500 hover:bg-pink-600 text-white py-2 px-4 rounded">Start</a>
    </body>
</html>
