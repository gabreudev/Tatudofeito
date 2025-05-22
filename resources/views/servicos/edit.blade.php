<h1>Alterar Serviço</h1>

@include('components.alerta-erros')

<a href="{{ url()->previous() }}" style="display: inline-block; margin-bottom: 15px; color: blue; text-decoration: underline;">&larr; Voltar</a>

<form action="{{ route('servicos.update', $servico->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="hidden" name="client_id" value="{{ $servico->clientId }}">
    <input type="hidden" name="worker_id" value="{{ $servico->workerId }}">

    <label for="status">Status:</label>
    <select name="status" required>
        <option value="pendente" {{ old('status', $servico->status) == 'pendente' ? 'selected' : '' }}>Pendente</option>
        <option value="em andamento" {{ old('status', $servico->status) == 'em andamento' ? 'selected' : '' }}>Em andamento</option>
        <option value="finalizado" {{ old('status', $servico->status) == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
    </select>

    <label for="description">Descrição:</label>
    <textarea name="description" rows="4" required>{{ old('description', $servico->description) }}</textarea>

    <button type="submit">Salvar</button>
</form>

<form action="{{ route('servicos.destroy', $servico->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este serviço?');">
    @csrf
    @method('DELETE')
    <button type="submit" style="color: red;">Excluir Serviço</button>
</form>