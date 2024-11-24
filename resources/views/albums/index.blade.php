<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Albums</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-5xl mx-auto text-center">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-8">My Albums</h1>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 bg-green-100 text-green-800 px-4 py-3 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

        <!-- Album & Artist btn -->
        <div class="mb-8 flex justify-center gap-4">
            <a href="{{ route('albums.create') }}" 
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-5 rounded-lg shadow">
                Add Album
            </a>
            <a href="{{ route('artists.index') }}" 
               class="inline-block bg-violet-700 hover:bg-violet-800 text-white font-medium py-2 px-5 rounded-lg shadow">
                Artists List
            </a>
        </div>

        <!-- Albums Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($albums as $album)
                <div class="bg-white rounded-lg shadow-md p-6 text-left relative">
                    <!-- YT -->
                    <a href="https://www.youtube.com/results?search_query={{$album->artist_name}}" target="_blank" rel="noreferrer">
                        <svg class=" absolute right-6" height="40px" width="40px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 490 490" xml:space="preserve" fill="#000000" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path style="fill:#EA4640;" d="M480,180v130c0,55.195-44.805,100-100,100H110c-55.195,0-100-44.805-100-100V180 c0-55.199,44.805-100,100-100h270C435.195,80,480,124.801,480,180z"></path> </g> <g id="XMLID_21_"> <g> <polygon style="fill:#FFFFFF;" points="320,245 200,295 200,195 "></polygon> </g> <g> <path style="fill:#231F20;" d="M380,70H110C49.346,70,0,119.346,0,180v130c0,60.654,49.346,110,110,110h270 c60.654,0,110-49.346,110-110V180C490,119.346,440.654,70,380,70z M470,310c0,49.626-40.374,90-90,90H110 c-49.626,0-90-40.374-90-90V180c0-49.626,40.374-90,90-90h270c49.626,0,90,40.374,90,90V310z"></path> <path style="fill:#231F20;" d="M323.846,235.769l-120-50c-3.085-1.286-6.611-0.945-9.393,0.911 c-2.782,1.854-4.453,4.977-4.453,8.32v100c0,3.344,1.671,6.466,4.453,8.32c1.667,1.112,3.601,1.68,5.548,1.68 c1.301,0,2.608-0.254,3.845-0.769l120-50c3.727-1.553,6.154-5.194,6.154-9.231S327.572,237.322,323.846,235.769z M210,280v-70 l84,35L210,280z"></path> </g> </g> </g> </g></svg>
                    </a>
                    <!-- Album Details -->
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Album Name: {{ $album->name }}</h2>
                    <p class="text-gray-600"><strong>Album Id:</strong> {{ $album->id }}</p>
                    <p class="text-gray-600"><strong>Artist Id:</strong> {{ $album->artist_id }}</p>
                    <p class="text-gray-600"><strong>Artist Name:</strong> {{ $album->artist_name }}</p>
                    <p class="text-gray-600"><strong>Artist Twitter:</strong> {{ $album->artist_twitter }}</p>
                    <p class="text-gray-600"><strong>Year:</strong> {{ $album->created_at->year }}</p>
                    <p class="text-gray-600"><strong>Created:</strong> {{ $album->created_at->diffForHumans() }}</p>
                    <p class="text-gray-600"><strong>Updated:</strong> {{ $album->updated_at->diffForHumans() }}</p>

                    <!-- Actions -->
                    <div class="mt-4 flex justify-between">
                        <a href="{{ route('albums.edit', ['album' => $album->id]) }}" 
                           class="text-blue-600 hover:underline font-medium">
                            Edit
                        </a>
                        <form method="post" action="{{ route('albums.destroy', ['album' => $album->id]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" 
                                    class="text-red-600 hover:underline font-medium"
                                    onclick="return confirm('Are you sure you want to delete this album?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
