<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalendariController;
use App\Http\Controllers\TemesController;
use App\Http\Controllers\ComunitatController;
use App\Http\Controllers\PerfilController;

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
    if(session()->has('user'))
    {
        return redirect('/home');
    }
    return redirect('/comunitat');
});



//Socialite Group
Route::controller(GoogleController::class)->group(function() {
    Route::get('/google-auth/redirect', 'googleRedirect');
    Route::get('/google-auth/callback', 'googleCallback');
});
//Socialite Group


    Route::controller(HomeController::class)->group(function() {
        Route::get('/comunitat', 'comunitat')->name('comunitat');
    });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware("checkSession")->name('dashboard');

Route::middleware('checkSession')->group(function () {
    
    Route::controller(HomeController::class)->group(function() {
        Route::get('/home', 'home')->name('home');

        Route::get('/calendari', 'calendari')->name('calendari');
        Route::get('/temes', 'temes')->name('temes');
        Route::get('/perfil', 'perfil')->name('perfil.show');
        Route::get('/perfil/edit', 'perfilEdit')->name('perfil.edit');
        Route::put('/perfil', 'perfilSave')->name('perfil.save');
        Route::get('/banda/{key}', 'bandaEdit')->name('banda.edit');
        Route::put('/banda/{key}', 'bandaSave')->name('banda.save');
    });

    Route::controller(GoogleController::class)->group(function() {
        Route::get('/logout', 'logout')->name('logout');
    });

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//require __DIR__.'/auth.php';