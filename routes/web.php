<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

// Route Login HRIS
Route::post('/loginHris', [App\Http\Controllers\Auth\HrisController::class, 'store'])->name('loginHris');


Route::get('/liga', [App\Http\Controllers\LigaController::class, 'index'])->name('liga');
Route::get('/liga/{id}', [App\Http\Controllers\LigaController::class, 'detail'])->name('detail');
Route::get('/players/{team_id}', [App\Http\Controllers\LigaController::class, 'players'])->name('players');
