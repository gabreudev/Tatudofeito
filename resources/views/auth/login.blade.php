@extends('layouts.app')

@section('title', 'Login')

@section('css')
    @vite(['resources/css/forms.css'])
@endsection

@section('content')
    <x-auth-container title="Bem-vindo(a)!" subtitle="Sentimos sua falta." routeName="login" submitLabel="Login">
        <x-input-field type="email" name="email" placeholder="Email" required autofocus />

        <x-input-field type="password" name="password" placeholder="Senha" required />

        <div class="forgot-password">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
            @endif
        </div>

        <x-slot name="afterButton">
            <div class="signup-link">
                Não tem uma conta? <a href="{{ route('register') }}">Cadastre-se</a>
            </div>
        </x-slot>
    </x-auth-container>
@endsection
