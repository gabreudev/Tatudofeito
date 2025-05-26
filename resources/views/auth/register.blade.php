@extends('layouts.app')

@section('title', 'Registro')

@section('css')
    @vite(['resources/css/forms.css', 'resources/css/register.css'])
@endsection

@section('content')
    <div class="container">
        <div class="form-wrapper">
            <h1>Ficamos felizes</h1>
            <h2>em ter você por aqui.</h2>
            <img src="{{ asset('images/Tatu.svg') }}" alt="Descrição da imagem" width="300" height="125">

            {{-- Exibe status de sessão --}}
            @if (session('status'))
                <div class="session-status">{{ session('status') }}</div>
            @endif


            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-field">
                    <input type="text" id="name" name="name" placeholder="Nome" value="{{ old('name') }}"
                        required autofocus>
                </div>

                <div class="form-field">
                    <input type="text" id="cpf" name="cpf" placeholder="CPF" value="{{ old('cpf') }}"
                        required>
                </div>

                <div class="form-field">
                    <input type="tel" pattern="\(\d{2}\)\s?\d{4,5}-\d{4}" id="phone" name="phone"
                        placeholder="(12) 34567-8910" value="{{ old('phone') }}" required>
                </div>

                <div class="form-field">
                    <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}"
                        required>
                </div>

                <div class="form-field">
                    <input type="password" id="password" name="password" placeholder="Senha" required>
                </div>

                <div class="form-field">
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Confirmar senha" required>
                </div>


                <div class="form-field checkbox-group flex justify-center gap-6">
                    <div class="checkbox-option">
                        <input type="radio" id="prestador" name="role" value="worker"
                            {{ old('role') === 'worker' ? 'checked' : '' }} required>
                        <label for="prestador" class="text-white">Prestador</label>
                    </div>
                    <div class="checkbox-option">
                        <input type="radio" id="cliente" name="role" value="client"
                            {{ old('role') === 'client' ? 'checked' : '' }} required>
                        <label for="cliente" class="text-white">Cliente</label>
                    </div>
                </div>


                {{-- Campos exclusivos para Prestador --}}
                <div id="worker-fields" class="{{ old('role') === 'worker' ? '' : 'hidden' }}">
                    <div class="form-field">
                        <input type="text" id="specialties" name="specialties" placeholder="Especialidades"
                            value="{{ old('specialties') }}">
                    </div>

                    <div class="form-field">
                        <input type="text" id="payment_methods" name="payment_methods" placeholder="Formas de pagamento"
                            value="{{ old('payment_methods') }}">
                    </div>

                    <div class="form-field">
                        <input type="number" step="0.01" min="0" id="daily_value" name="daily_value"
                            placeholder="Valor diário (R$)" value="{{ old('daily_value') }}">
                    </div>

                    <div class="form-field">
                        <textarea id="description" name="description" placeholder="Descrição">{{ old('description') }}</textarea>
                    </div>
                </div>

                <button type="submit" class="login-button">Cadastrar</button>
            </form>

            <div class="signup-link">
                Já tem uma conta? <a href="{{ route('login') }}">Fazer login</a>
            </div>


            <!-- Script para exibir campos de Prestador -->
            <script>
                document.querySelectorAll('input[name="role"]').forEach(function(radio) {
                    radio.addEventListener('change', function() {
                        const workerFields = document.getElementById('worker-fields');
                        if (this.value === 'worker') {
                            workerFields.classList.remove('hidden');
                        } else {
                            workerFields.classList.add('hidden');
                        }
                    });
                });

                // Executa ao carregar a página (caso o valor já esteja preenchido com old())
                window.addEventListener('DOMContentLoaded', function() {
                    const checkedRole = document.querySelector('input[name="role"]:checked');
                    const workerFields = document.getElementById('worker-fields');
                    if (checkedRole && checkedRole.value === 'worker') {
                        workerFields.classList.remove('hidden');
                    } else {
                        workerFields.classList.add('hidden');
                    }
                });
            </script>
        </div>
    </div>
@endsection
