<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::controller(UserController::class)->group(function() {
    Route::get('/users', 'index');
    Route::get('/users/create', 'create');
    Route::post('/users', 'store');
    Route::get('/users/{id}', 'show');
    Route::get('/users/edit/{id}', 'edit');
    Route::put('/users/{id}', 'update');
    Route::delete('/users/{id}', 'delete');
});

Route::controller(BandController::class)->group(function() {
    Route::get('/bands', 'index');
    Route::get('/bands/create', 'create');
    Route::post('/bands', 'store');
    Route::get('/bands/{id}', 'show');
    Route::get('/bands/edit/{id}', 'edit');
    Route::put('/bands/{id}', 'update');
    Route::delete('/bands/{id}', 'delete');
});

Route::controller(EventController::class)->group(function() {
    Route::get('/events', 'index');
    Route::get('/events/create', 'create');
    Route::post('/events', 'store');
    Route::get('/events/{id}', 'show');
    Route::get('/events/edit/{id}', 'edit');
    Route::put('/events/{id}', 'update');
    Route::delete('/events/{id}', 'delete');
});

Route::controller(InstrumentController::class)->group(function() {
    Route::get('/instruments', 'index');
    Route::get('/instruments/create', 'create');
    Route::post('/instruments', 'store');
    Route::get('/instruments/{id}', 'show');
    Route::get('/instruments/edit/{id}', 'edit');
    Route::put('/instruments/{id}', 'update');
    Route::delete('/instruments/{id}', 'delete');
});

// Route::controller(SongController::class)->group(function() {
//     Route::get('/songs', 'index');
//     Route::get('/songs/create', 'create');
//     Route::post('/songs', 'store');
//     Route::get('/songs/{id}', 'show');
//     Route::get('/songs/edit/{id}', 'edit');
//     Route::put('/songs/{id}', 'update');
//     Route::delete('/songs/{id}', 'delete');
// });

// Route::controller(TrackController::class)->group(function() {
//     Route::get('/tracks', 'index');
//     Route::get('/tracks/create', 'create');
//     Route::post('/tracks', 'store');
//     Route::get('/tracks/{id}', 'show');
//     Route::get('/tracks/edit/{id}', 'edit');
//     Route::put('/tracks/{id}', 'update');
//     Route::delete('/tracks/{id}', 'delete');
// });