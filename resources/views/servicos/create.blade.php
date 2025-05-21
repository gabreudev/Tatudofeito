<h1>Novo Serviço</h1>

@include('components.alerta-erros')

<form action="{{ route('servicos.store') }}" method="POST">
    @csrf

    <label for="description">Descrição:</label>
    <textarea name="description" rows="4" required></textarea>

    <button type="submit">Salvar</button>
</form>