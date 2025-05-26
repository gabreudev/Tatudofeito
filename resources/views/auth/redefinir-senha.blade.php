@extends('layouts.app')

@section('title', 'Verificação de Código')

@section('css')
    @vite(['resources/css/forms.css', 'resources/css/style3.css'])
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="content">
                <div class="titulo">
                    <h1>Digite uma nova senha</h1>
                </div>

                <div class="image-container">
                    <img src="../../images/Tatu.svg" alt="Descrição da imagem" width="300" height="125">
                </div>

                {{-- Exibe status de sessão --}}
                @if (session('status'))
                    <div class="session-status">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('password.redefinir') }}">
                    @csrf

                    <div class="form-section">
                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="code" value="{{ $code }}">

                        <div class="password-fields">
                            <x-input-field type="password" name="password" placeholder="Nova senha" required />

                            <x-input-field type="password" name="password_confirmation" placeholder="Confirmar senha"
                                required />
                        </div>

                        <div class="buttons">
                            <a href="{{ route('login') }}">
                                <button type="submit" class="btn-back">Salvar nova senha</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
