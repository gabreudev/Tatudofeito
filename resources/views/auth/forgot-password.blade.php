@extends('layouts.app')

@section('title', 'Recuperação de Senha')

@section('css')
    @vite(['resources/css/forms.css', 'resources/css/style.css'])
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="content">
                <div class="titulo">
                    <h1>Esqueceu sua senha?</h1>
                    <h2>Vamos te ajudar!</h2>
                </div>

                <div class="image-container">
                    <img src="{{ asset('images/Tatu.svg') }}" alt="Descrição da imagem" width="300" height="125">
                </div>

                {{-- Exibe status de sessão --}}
                @if (session('status'))
                    <div class="session-status">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-section">

                        <x-input-field type="email" name="email" placeholder="Email cadastrado" required
                            autofocus></x-input-field>

                        <div class="buttons">
                            <button type="submit" class="btn-send">Enviar código</button>
                            <a href="{{ route('login') }}">
                                <button type="button" class="btn-back">Voltar</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
