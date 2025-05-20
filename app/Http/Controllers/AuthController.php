<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    
public function sendResetCode(Request $request)
{
    $request->validate(['email' => 'required|email']);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Nenhum usuário encontrado com este e-mail.']);
    }

    $code = rand(100000, 999999);

    // Salva ou atualiza o token na tabela
    DB::table('password_reset_tokens')->updateOrInsert(
        ['email' => $request->email],
        [
            'token' => $code,
            'created_at' => Carbon::now()
        ]
    );

    // Envia o código por e-mail
    Mail::raw("Seu código de recuperação é: $code", function ($message) use ($request) {
        $message->to($request->email)
                ->subject('Recuperação de senha');
    });

    return redirect()->route('password.code-form')->with('status', 'Código enviado para o seu e-mail.');
}

public function verifyCode(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'code' => 'required'
    ]);

    $reset = DB::table('password_reset_tokens')
        ->where('email', $request->email)
        ->where('token', $request->code)
        ->first();

    if (!$reset || Carbon::parse($reset->created_at)->addMinutes(30)->isPast()) {
        return back()->withErrors(['code' => 'Código inválido ou expirado.']);
    }

    // Código está ok, redireciona para a tela de redefinir senha
    return redirect()->route('password.reset-form', [
        'email' => $request->email,
        'code' => $request->code
    ]);
}

public function showResetForm(Request $request)
{
    return view('auth.redefinir-senha', [
        'email' => $request->email,
        'code' => $request->code
    ]);
}


public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'code' => 'required',
        'password' => 'required|confirmed|min:6',
    ]);

    $reset = DB::table('password_reset_tokens')
        ->where('email', $request->email)
        ->where('token', $request->code)
        ->first();

    if (!$reset || Carbon::parse($reset->created_at)->addMinutes(30)->isPast()) {
        return back()->withErrors(['code' => 'Código inválido ou expirado.']);
    }

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Usuário não encontrado.']);
    }

    $user->password = Hash::make($request->password);
    $user->save();

    DB::table('password_reset_tokens')->where('email', $request->email)->delete();

    return back()->with('status', 'Senha redefinida com sucesso!');
}

}