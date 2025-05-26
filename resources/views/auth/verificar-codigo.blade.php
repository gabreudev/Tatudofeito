@extends('layouts.app')

@section('title', 'Verificação de Código')

@section('css')
    @vite(['resources/css/forms.css', 'resources/css/style2.css'])
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="content">
                <div class="titulo">
                    <h1>Digite o código que você</h1>
                    <h2>recebeu no seu E-mail</h2>
                </div>

                <div class="image-container">
                    <img src="../../images/Tatu.svg" alt="Descrição da imagem" width="300" height="125">
                </div>

                {{-- Exibe status de sessão --}}
                @if (session('status'))
                    <div class="session-status">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('password.verificar-codigo') }}">
                    @csrf

                    <div class="form-section">
                        <x-input-field type="hidden" name="email" :value="$email" />
                        <x-input-field name="code" placeholder="Digite o código" required />

                        <div class="buttons">
                            <button type="submit" class="btn-send">Verificar código</button>

                            <a href="{{ route('password.request') }}">
                                <button type="button" class="btn-back">Voltar</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
