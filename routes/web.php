<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Albums Routes
Route::resource('/albums', AlbumController::class)->except(['show']);

// Artists Routes
Route::get('/artists', [ArtistController::class, 'index'])->name('artists.index');
