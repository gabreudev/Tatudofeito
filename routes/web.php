<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\UsuarioController;
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


Route::resource('servicos', ServicoController::class);
Route::resource('usuarios', UsuarioController::class);


Route::post('/verificar-codigo', [AuthController::class, 'verifyCode'])->name('password.verificar-codigo');

Route::get('/redefinir-senha', [AuthController::class, 'showResetForm'])->name('password.reset-form');

Route::post('/redefinir-senha', [AuthController::class, 'resetPassword'])->name('password.redefinir');

Route::post('/enviar-codigo', [AuthController::class, 'sendResetCode'])->name('password.send-code');

Route::get('/esqueci-senha', function () {
    return view('auth.esqueci-senha');
})->name('password.request');

Route::get('/verificar-codigo', function () {
    return view('auth.verificar-codigo');
})->name('password.code-form');