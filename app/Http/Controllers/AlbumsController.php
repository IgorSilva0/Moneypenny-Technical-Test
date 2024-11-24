<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Albums;
use Illuminate\Support\Facades\Http;

class AlbumsController extends Controller
{
    public function index()
    {
        $albums = Albums::all();
        return view('albums.index', ['albums' => $albums]);
    }

    public function create()
    {
        // Fetch artists from the session or API
        $artists = $this->getArtists();
        return view('albums.create', ['artists' => $artists]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'artist_id' => 'required|integer',
            'artist_twitter' => 'required|string|max:255|regex:/^@(\w){1,15}$/',
            'artist_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        Albums::create($data);

        return redirect()->route('albums.index')->with('success', 'Album created successfully!');
    }

    public function edit(Albums $album)
    {
        // Fetch artists from the session or API
        $artists = $this->getArtists();

        return view('albums.edit', [
            'album' => $album,
            'artists' => $artists
        ]);
    }

    public function update(Albums $album, Request $request)
    {
        $data = $request->validate([
            'artist_id' => 'required',
            'artist_twitter' => 'required',
            'artist_name' => 'required',
            'name' => 'required',
        ]);

        $album->update($data);

        return redirect()->route('albums.index')->with('success', 'Album updated successfully!');
    }

    public function destroy(Albums $album)
    {
        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Album deleted successfully!');
    }

    // Fetch artists from the session or API.
    private function getArtists()
    {
        // Check if artists are in the session and valid
        if (session()->has('artists') && session('artists_last_fetched') > now()->subHours(1)) {
            return session('artists');
        }

        // Fetch artists from the API
        $response = Http::withHeaders([
            'Authorization' => config('services.api.bearer_token')
        ])->get('https://europe-west1-madesimplegroup-151616.cloudfunctions.net/artists-api-controller');

        if ($response->successful()) {
            $artists = collect($response->json()['json'])->flatten(1);

            // Cache the artists in the session
            session([
                'artists' => $artists,
                'artists_last_fetched' => now(),
            ]);

            return $artists;
        }

        // Handle API failure
        return collect(); // Return an empty collection if the API call fails
    }
}
