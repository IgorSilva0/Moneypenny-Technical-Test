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
        // Fetch artists
        $response = Http::withHeaders([
            'Authorization' => config('services.api.bearer_token')
        ])->get('https://europe-west1-madesimplegroup-151616.cloudfunctions.net/artists-api-controller');

        // If successful
        if ($response->successful()) {
            $artists = collect($response->json()['json'])->flatten(1);

            return view('albums.create', ['artists' => $artists]);
        } else {
            return back()->withErrors(['error' => 'Failed to fetch artists']);
        }
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
        // Fetch artists
        $response = Http::withHeaders([
            'Authorization' => config('services.api.bearer_token')
        ])->get('https://europe-west1-madesimplegroup-151616.cloudfunctions.net/artists-api-controller');

        // If successful
        if ($response->successful()) {
            $artists = collect($response->json()['json'])->flatten(1);

            return view('albums.edit', [
                'album' => $album,
                'artists' => $artists
            ]);
        } else {
            return back()->withErrors(['error' => 'Failed to fetch artists']);
        }
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
}
