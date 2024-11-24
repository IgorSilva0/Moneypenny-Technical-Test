<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Album</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-5xl mx-auto text-center">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-8">Create Album</h1>
    
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4">Artist Details</h2>
            <p class="text-gray-600 mb-4">Fill in the details below to add a new album.</p>
        
            <!-- Validation Errors -->
            @if($errors->any())
                <div class="mb-4 text-red-600">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        
            <!-- Form -->
            <form method="post" action="{{ route('albums.store') }}" id="create-album-form">
                @csrf

                <!-- Artist Dropdown (Names) -->
                <div class="mb-4">
                    <label for="artist_name" class="block text-gray-700">Artist Name</label>
                    <select name="artist_name" id="artist_name" class="border rounded w-full p-2">
                        <option value="">Select Artist</option>
                        @foreach($artists as $artist)
                            <option value="{{ $artist['name'] }}" data-artist-id="{{ $artist['id'] }}" data-artist-twitter="{{ $artist['twitter'] }}">
                                {{ $artist['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Artist Twitter -->
                <div class="mb-4">
                    <label for="artist_twitter" class="block text-gray-700">Artist Twitter</label>
                    <input type="text" name="artist_twitter" id="artist_twitter" class="border rounded w-full p-2" placeholder="@artist_twitter" readonly>
                </div>

                <!-- Artist ID -->
                <div class="mb-4">
                    <label for="artist_id" class="block text-gray-700">Artist ID</label>
                    <input type="number" name="artist_id" id="artist_id" class="border rounded w-full p-2" placeholder="Artist ID" readonly>
                </div>

                <h2 class="text-xl font-bold mb-4">Album Details</h2>
                
                <!-- Album Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Album Name</label>
                    <input type="text" name="name" id="name" class="border rounded w-full p-2" placeholder="Enter Album Name">
                </div>
                
                <div class="flex justify-center gap-4">
                    <a href="{{ route('albums.index') }}" class="bg-slate-500 hover:bg-slate-600 text-white py-[9px] px-4 rounded">Back</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">Create</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Listen for changes on the artist dropdown
        document.getElementById('artist_name').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];

            // Get artist ID and Twitter from the selected option
            var artistId = selectedOption.getAttribute('data-artist-id');
            var artistTwitter = selectedOption.getAttribute('data-artist-twitter');

            // Update the Twitter and ID fields based on the selected artist
            document.getElementById('artist_twitter').value = artistTwitter;
            document.getElementById('artist_id').value = artistId;
        });
    </script>
</body>
</html>
