@extends('layouts.app')

@section('title', 'Verificação de Código')

@section('css')
    @vite(['resources/css/forms.css'])
@endsection

@section('content')
    <x-auth-container title="Digite o código que você" subtitle="recebeu no seu E-mail" routeName="password.verificar-codigo"
        submitLabel="Verificar código">
        <x-input-field type="hidden" name="email" :value="$email" />
        <x-input-field name="code" placeholder="Digite o código" required />


        <x-slot name="afterButton">
            <a href="{{ route('password.request') }}">
                <x-default-button type="button">Voltar</x-default-button>
            </a>
        </x-slot>
    </x-auth-container>
@endsection
