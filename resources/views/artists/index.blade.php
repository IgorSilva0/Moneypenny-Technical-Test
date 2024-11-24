<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Artists List</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-5xl mx-auto text-center">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-8">Artists List</h1>
        
        <a href="{{ route('albums.index') }}" class="bg-slate-500 hover:bg-slate-600 text-white py-[9px] px-4 rounded">Back</a>
        
        <!-- Artists Cards -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6 my-5">
            @foreach($artists as $artist)
                <div class="bg-white rounded-lg shadow-md p-6 text-left">
                    <!-- Artist Details -->
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Artist Name: {{ $artist['name'] }}</h2>
                    <p class="text-gray-600"><strong>Artist ID:</strong> {{ $artist['id'] }}</p>
                    <p class="text-gray-600"><strong>Twitter:</strong> 
                        {{ $artist['twitter'] }}
                    </p>
                </div>
            @endforeach
        </div>
        <a href="{{ route('albums.index') }}" class="bg-slate-500 hover:bg-slate-600 text-white py-[9px] px-4 rounded">Back</a>
    </div>
</body>
</html>
