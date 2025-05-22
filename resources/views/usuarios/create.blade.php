<h1>Cadastrar Usuário</h1>

@include('components.alerta-erros')

<form action="{{ route('usuarios.store') }}" method="POST">
    @csrf

    <label>Nome:</label>
    <input type="text" name="name" required><br>

    <label>CPF:</label>
    <input type="text" name="cpf" required><br>

    <label>Telefone:</label>
    <input type="text" name="phone" required><br>

    <label>Email:</label>
    <input type="email" name="email" required><br>

    <label>Senha:</label>
    <input type="password" name="password" required><br>

    <label>Confirmar Senha:</label>
    <input type="password" name="password_confirmation" required><br>

    <label>Tipo (role):</label>
    <select name="role" required>
        <option value="">-- Selecione --</option>
        <option value="client">Cliente</option>
        <option value="worker">Prestador</option>
        <option value="admin">Admin</option>
    </select><br>

    <label>Especialidades:</label>
    <input type="text" name="specialties"><br>

    <label>Nota média:</label>
    <input type="number" name="average_rating" step="0.1" min="0" max="5"><br>

    <label>Formas de pagamento:</label>
    <input type="text" name="payment_methods"><br>

    <label>Valor diário (R$):</label>
    <input type="number" name="daily_value" step="0.01" min="0"><br>

    <label>Descrição:</label>
    <textarea name="description"></textarea><br>


    <button type="submit">Cadastrar</button>

</form>