@extends('layouts.app')

@section('title', 'Login')

@section('css')
    @vite(['resources/css/login.css'])
@endsection

@section('content')
    <div class="form-wrapper">
        <h1>Bem-vindo(a)!</h1>
        <h2>Sentimos sua falta.</h2>
        <img src="{{ asset('images/Tatu.svg') }}" alt="Descrição da imagem" width="300" height="125">

        {{-- Exibe status de sessão --}}
        @if (session('status'))
            <div class="session-status">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-field">
                <input type="email" id="email" name="email" placeholder="Usuário" value="{{ old('email') }}"
                    required autofocus>
            </div>

            <div class="form-field">
                <input type="password" id="password" name="password" placeholder="Senha" required>
            </div>

            <div class="forgot-password">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
                @endif
            </div>

            <button type="submit" class="login-button">Login</button>

        </form>

        <div class="signup-link">
            Não tem uma conta? <a href="{{ route('register') }}">Cadastre-se</a>
        </div>

    </div>
@endsection
