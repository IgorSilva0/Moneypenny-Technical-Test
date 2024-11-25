<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ArtistController extends Controller
{
    public function index()
    {
        // Check if data is already in the session
        if (session()->has('artists')) {
            $artists = session('artists');
        } else {
            // Fetch artists from the API
            $response = Http::withHeaders([
                'Authorization' => config('services.api.bearer_token'),
            ])->get('https://europe-west1-madesimplegroup-151616.cloudfunctions.net/artists-api-controller');

            // If successful, store the data in the session
            if ($response->successful()) {
                $artists = collect($response->json()['json'])->flatten(1);
                session(['artists' => $artists]); // Save to session
            } else {
                return back()->withErrors(['error' => 'Failed to fetch artists']);
            }
        }

        // Pass the artists data to the view
        return view('artists.index', ['artists' => $artists]);
    }
}
