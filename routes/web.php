<?php

use App\Http\Controllers\{ServicoController, UsuarioController, ReviewController};
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

Route::get('/servicos/{id}/reviews', [ReviewController::class, 'create'])->name('reviews.create');

Route::resource('reviews', ReviewController::class)->except(['create']);

Route::resource('servicos', ServicoController::class);
Route::resource('usuarios', UsuarioController::class);
