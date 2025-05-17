<x-guest-layout>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-white">
            <!-- Todos os campos do formulário vêm aqui -->

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nome')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- CPF -->
            <div class="mt-4">
                <x-input-label for="cpf" :value="__('CPF')" />
                <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')" required />
                <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
            </div>

            <!-- Telefone -->
            <div class="mt-4">
                <x-input-label for="phone" :value="__('Telefone')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Senha -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Senha')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirmar Senha -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Tipo (Role) -->
            <div class="mt-4 text-center">
                <x-input-label for="role" :value="__('Tipo (Role)')" class="text-white" />

                <div class="flex justify-center gap-6 mt-2 text-white">
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="role" value="client" {{ old('role') === 'client' ? 'checked' : '' }} required>
                        <span>Cliente</span>
                    </label>

                    <label class="flex items-center space-x-2">
                        <input type="radio" name="role" value="worker" {{ old('role') === 'worker' ? 'checked' : '' }} required>
                        <span>Prestador</span>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <!-- Campos exclusivos para Prestador -->
            <div id="worker-fields" class="mt-4 hidden">
                <!-- Especialidades -->
                <div>
                    <x-input-label for="specialties" :value="__('Especialidades')" />
                    <x-text-input id="specialties" class="block mt-1 w-full" type="text" name="specialties" :value="old('specialties')" />
                    <x-input-error :messages="$errors->get('specialties')" class="mt-2" />
                </div>

                <!-- Formas de pagamento -->
                <div class="mt-4">
                    <x-input-label for="payment_methods" :value="__('Formas de pagamento')" />
                    <x-text-input id="payment_methods" class="block mt-1 w-full" type="text" name="payment_methods" :value="old('payment_methods')" />
                    <x-input-error :messages="$errors->get('payment_methods')" class="mt-2" />
                </div>

                <!-- Valor diário -->
                <div class="mt-4">
                    <x-input-label for="daily_value" :value="__('Valor diário (R$)')" />
                    <x-text-input id="daily_value" class="block mt-1 w-full" type="number" name="daily_value" step="0.01" min="0" :value="old('daily_value')" />
                    <x-input-error :messages="$errors->get('daily_value')" class="mt-2" />
                </div>

                <!-- Descrição -->
                <div class="mt-4">
                    <x-input-label for="description" :value="__('Descrição')" />
                    <textarea
                        id="description"
                        name="description"
                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-black">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            </div>

            <!-- Botão + link -->
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-300 hover:text-white" href="{{ route('login') }}">
                    {{ __('Já registrado?') }}
                </a>

                <x-primary-button class="ml-4">
                    {{ __('Registrar') }}
                </x-primary-button>
            </div>
        </div>
    </form>

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

</x-guest-layout>