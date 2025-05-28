<?php

use App\Http\Controllers\{ServicoController, UsuarioController, ProfileController, AuthController, RequestController, ReviewController};
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
    return view('pages.home');
});

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/services', function () {
    return view('pages.services');
});


Route::get('/usuarios/available', [\App\Http\Controllers\UsuarioController::class, 'available'])->name('usuarios.available');

Route::get('/servicos/{id}/reviews', [ReviewController::class, 'create'])->name('reviews.create');

Route::resource('reviews', ReviewController::class)->except(['create']);

Route::resource('usuarios', UsuarioController::class);

Route::resource('servicos', ServicoController::class)->middleware('auth');

Route::resource('requests', RequestController::class)->middleware('auth');
Route::post('/requests/{id}/accept', [RequestController::class, 'accept'])->name('requests.accept')->middleware('auth');
Route::post('/requests/{id}/reject', [RequestController::class, 'reject'])->name('requests.reject')->middleware('auth');
Route::delete('/requests/{id}/delete', [RequestController::class, 'destroy'])->name('requests.destroy')->middleware('auth');



//recuperar senha
Route::post('/verificar-codigo', [AuthController::class, 'verifyCode'])->name('password.verificar-codigo');

Route::get('/redefinir-senha', [AuthController::class, 'showResetForm'])->name('password.reset-form');

Route::post('/redefinir-senha', [AuthController::class, 'resetPassword'])->name('password.redefinir');



Route::post('/enviar-codigo', [AuthController::class, 'sendResetCode'])->name('password.send-code');

Route::get('/esqueci-senha', function () {
    return view('auth.esqueci-senha');
})->name('password.request');

Route::get('/verificar-codigo', function (Request $request) {
    $email = $request->query('email');
    return view('auth.verificar-codigo', compact('email'));
})->name('password.code-form');

//

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
