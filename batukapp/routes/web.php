<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;

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



//Socialite Group
Route::controller(GoogleController::class)->group(function() {
    Route::get('/google-auth/redirect', 'googleRedirect');
    Route::get('/google-auth/callback', 'googleCallback');
});
//Socialite Group



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware("checkSession")->name('dashboard');

Route::middleware('checkSession')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';