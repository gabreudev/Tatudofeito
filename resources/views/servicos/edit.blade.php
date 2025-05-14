<h1>Alterar Serviço</h1>

@if ($errors->any())
<div>
    <strong>Erros encontrados:</strong>
    <ul>
        @foreach ($errors->all() as $erro)
        <li>{{ $erro }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('servicos.update', $service->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="hidden" name="client_id" value="{{ $clientId }}">
    <input type="hidden" name="worker_id" value="{{ $workerId }}">

    <label for="status">Status:</label>
    <select name="status" required>
        <option value="pendente" {{ old('status', $service->status) == 'pendente' ? 'selected' : '' }}>Pendente</option>
        <option value="em andamento" {{ old('status', $service->status) == 'em andamento' ? 'selected' : '' }}>Em andamento</option>
        <option value="finalizado" {{ old('status', $service->status) == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
    </select>

    <label for="description">Descrição:</label>
    <textarea name="description" rows="4" required>{{ old('description', $service->description) }}</textarea>

    <button type="submit">Salvar</button>
</form>

<form action="{{ route('servicos.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este serviço?');">
    @csrf
    @method('DELETE')
    <button type="submit" style="color: red;">Excluir Serviço</button>
</form>