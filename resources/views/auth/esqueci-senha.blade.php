@extends('layouts.app')

@section('title', 'Recuperação de Senha')

@section('css')
    @vite(['resources/css/forms.css'])
@endsection

@section('content')
    <x-auth-container title="Esqueceu sua senha?" subtitle="Vamos te ajudar!" routeName="password.send-code"
        submitLabel="Enviar código">
        <x-input-field type="email" name="email" placeholder="Email cadastrado" required autofocus />

        <x-slot name="afterButton">
            <a href="{{ route('login') }}">
                <x-default-button type="button">Voltar</x-default-button>
            </a>
        </x-slot>
    </x-auth-container>
@endsection
