@extends('layouts.app')

@section('title', 'Registro')

@section('css')
    @vite(['resources/css/forms.css', 'resources/css/register.css'])
@endsection

@section('content')
    <x-auth-container title="Ficamos felizes" subtitle="em ter você por aqui." routeName="register" submitLabel="Cadastrar">
        <x-input-field name="name" placeholder="Nome" required autofocus />

        <x-input-field name="cpf" placeholder="CPF" required />

        <x-input-field type="tel" name="phone" placeholder="(12) 34567-8910" pattern="\(\d{2}\)\s?\d{4,5}-\d{4}"
            required />

        <x-input-field type="email" name="email" placeholder="Email" required />

        <x-input-field type="password" name="password" placeholder="Senha" required />

        <x-input-field type="password" name="password_confirmation" placeholder="Confirmar senha" required />

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
            <x-input-field name="specialties" placeholder="Especialidades" />

            <x-input-field name="payment_methods" placeholder="Formas de pagamento" />

            <x-input-field type="number" name="daily_value" placeholder="Valor diário (R$)" step="0.01"
                min="0" />

            <x-input-field type="textarea" name="description" placeholder="Descrição" />
        </div>

        <x-slot name="afterButton">
            <div class="signup-link">
                Já tem uma conta? <a href="{{ route('login') }}">Fazer login</a>
            </div>
        </x-slot>

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
    </x-auth-container>
@endsection
