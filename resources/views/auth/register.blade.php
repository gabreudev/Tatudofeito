@extends('layouts.app')

@section('title', 'Registro')

@section('css')
    @vite(['resources/css/forms.css', 'resources/css/register.css'])
@endsection

@section('content')
    <x-auth-container title="Ficamos felizes" subtitle="em ter você por aqui." routeName="usuarios.store" submitLabel="Cadastrar">
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

            <div>
                <label for="categories" class="block mb-2 text-white">Categorias de Serviço</label>
                <div class="categories-grid" data-worker-required>
                    @foreach (\App\Enums\ServicoEnum::cases() as $categoria)
                        <label for="categoria_{{ $categoria->value }}" class="category-cell">
                            <input type="checkbox" id="categoria_{{ $categoria->value }}" name="categories[]"
                                value="{{ $categoria->value }}"
                                {{ is_array(old('categories')) && in_array($categoria->value, old('categories')) ? 'checked' : '' }}>
                            {{ ucfirst($categoria->label()) }}
                        </label>
                    @endforeach
                </div>
            </div>

            <x-input-field name="specialties" placeholder="Especialidades" class="worker-required" />

            <x-input-field name="payment_methods" placeholder="Formas de pagamento" class="worker-required" />

            <x-input-field type="number" name="daily_value" placeholder="Valor diário (R$)" step="0.01" min="0"
                class="worker-required" />

            <x-input-field type="textarea" name="description" placeholder="Descrição" class="worker-required" />
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

        <script>
            function updateRequiredFields() {
                const role = document.querySelector('input[name="role"]:checked')?.value;
                const workerFields = document.querySelectorAll('.worker-required');
                const categoryGroup = document.querySelector('[data-worker-required]');
                const categoryCheckboxes = categoryGroup.querySelectorAll('input[type="checkbox"]');

                if (role === 'worker') {
                    workerFields.forEach(field => field.setAttribute('required', 'required'));

                    // Adiciona verificação custom para categorias no submit
                    categoryGroup.setAttribute('data-require-at-least-one', 'true');
                } else {
                    workerFields.forEach(field => field.removeAttribute('required'));
                    categoryGroup.removeAttribute('data-require-at-least-one');
                }
            }

            // Validação ao enviar o formulário
            document.addEventListener('DOMContentLoaded', function() {
                updateRequiredFields();

                document.querySelector('form').addEventListener('submit', function(event) {
                    const role = document.querySelector('input[name="role"]:checked')?.value;
                    const categoryGroup = document.querySelector('[data-worker-required]');
                    const categoryCheckboxes = categoryGroup.querySelectorAll('input[type="checkbox"]');

                    if (role === 'worker') {
                        const atLeastOneChecked = Array.from(categoryCheckboxes).some(cb => cb.checked);
                        if (!atLeastOneChecked) {
                            event.preventDefault();
                            alert('Por favor, selecione ao menos uma categoria de serviço.');
                        }
                    }
                });

                document.querySelectorAll('input[name="role"]').forEach(function(radio) {
                    radio.addEventListener('change', updateRequiredFields);
                });
            });
        </script>
    </x-auth-container>
@endsection
