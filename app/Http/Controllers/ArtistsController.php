<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ArtistsController extends Controller
{
    public function index()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ZGV2ZWxvcGVyOlpHVjJaV3h2Y0dWeQ=='
        ])->get('https://europe-west1-madesimplegroup-151616.cloudfunctions.net/artists-api-controller');

        if ($response->successful()) {
            $artists = collect($response->json()['json'])->flatten(1);
            return view('artists.index', ['artists' => $artists]);
        } else {
            return response()->json(['error' => 'Failed to fetch artists'], 500);
        }
    }
}
