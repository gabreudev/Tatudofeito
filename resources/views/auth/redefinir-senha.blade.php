@extends('layouts.app')

@section('title', 'Verificação de Código')

@section('css')
    @vite(['resources/css/forms.css'])
@endsection

@section('content')
    <x-auth-container title="Digite uma nova senha" routeName="password.redefinir">
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="code" value="{{ $code }}">

        <x-input-field type="password" name="password" placeholder="Nova senha" required />

        <x-input-field type="password" name="password_confirmation" placeholder="Confirmar senha" required />

        <a href="{{ route('login') }}">
            <button type="submit" class="default-button">Salvar nova senha</button>
        </a>
    </x-auth-container>
@endsection
