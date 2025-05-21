<h1>Atualizar Usuário</h1>

@include('components.alerta-erros')

<form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" class="user-form">
    @csrf
    @method('PUT')

    <div class="form-section">
        <h2>Informações Básicas</h2>

        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $usuario->name) }}" required>
        </div>

        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" value="{{ old('cpf', $usuario->cpf) }}"
                required maxlength="14">
            <small>Formato: 000.000.000-00</small>
        </div>

        <div class="form-group">
            <label for="phone">Telefone:</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $usuario->phone) }}"
                required maxlength="15">
            <small>Formato: (00) 00000-0000</small>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
        </div>
    </div>

    <div class="form-section">
        <h2>Segurança</h2>

        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password">
            <small>Deixe em branco para manter a senha atual</small>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Senha:</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>
    </div>

    <div class="form-section">
        <h2>Tipo de Usuário</h2>

        <div class="form-group">
            <label for="role">Tipo (role):</label>
            <select id="role" name="role" required onchange="toggleWorkerFields()">
                <option value="">-- Selecione --</option>
                <option value="client" {{ old('role', $usuario->role) == 'client' ? 'selected' : '' }}>Cliente</option>
                <option value="worker" {{ old('role', $usuario->role) == 'worker' ? 'selected' : '' }}>Prestador</option>
                <option value="admin" {{ old('role', $usuario->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
    </div>

    <div id="worker-fields" class="form-section" style="display: {{ old('role', $usuario->role) == 'worker' ? 'block' : 'none' }}">
        <h2>Informações do Prestador</h2>

        <div class="form-group">
            <label for="specialties">Especialidades:</label>
            <input type="text" id="specialties" name="specialties"
                value="{{ old('specialties', $usuario->specialties) }}">
            <small>Separe as especialidades por vírgula</small>
        </div>

        <div class="form-group">
            <label for="payment_methods">Formas de pagamento:</label>
            <input type="text" id="payment_methods" name="payment_methods"
                value="{{ old('payment_methods', $usuario->payment_methods) }}">
            <small>Separe as formas de pagamento por vírgula</small>
        </div>

        <div class="form-group">
            <label for="daily_value">Valor diário (R$):</label>
            <input type="number" id="daily_value" name="daily_value" step="0.01" min="0"
                value="{{ old('daily_value', $usuario->daily_value) }}">
        </div>

        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea id="description" name="description" rows="4">{{ old('description', $usuario->description) }}</textarea>
        </div>

        @if($usuario->role == 'worker')
        <div class="form-group">
            <label>Nota média:</label>
            <p>{{ number_format($usuario->average_rating, 1) }}</p>
            <input type="hidden" name="average_rating" value="{{ $usuario->average_rating }}">
            <small>A nota média é calculada automaticamente com base nas avaliações dos clientes</small>
        </div>
        @endif
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">Atualizar</button>
        <a href="{{ route('usuarios.index') }}" class="btn-secondary">Cancelar</a>
    </div>
</form>

<script>
    function toggleWorkerFields() {
        const role = document.getElementById('role').value;
        const workerFields = document.getElementById('worker-fields');

        if (role === 'worker') {
            workerFields.style.display = 'block';
        } else {
            workerFields.style.display = 'none';
        }
    }
</script>

<style>
    .user-form {
        max-width: 800px;
        margin: 0 auto;
    }

    .form-section {
        margin-bottom: 30px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .form-group small {
        display: block;
        margin-top: 5px;
        color: #666;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }

    .alert-danger {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    .form-actions {
        margin-top: 20px;
        text-align: right;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        display: inline-block;
        margin-left: 10px;
    }
</style>