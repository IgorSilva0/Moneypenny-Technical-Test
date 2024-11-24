<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\ArtistsController;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Albums Routes
Route::resource('/albums', AlbumsController::class)->except(['show']);

// Artists Routes
Route::get('/artists', [ArtistsController::class, 'index'])->name('artists.index');
