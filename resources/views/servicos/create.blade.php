<h1>Novo Serviço</h1>

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

<form action="{{ route('services.store') }}" method="POST">
    @csrf

    <input type="hidden" name="client_id" value="{{ $clientId }}">
    <input type="hidden" name="worker_id" value="{{ $workerId }}">

    <!-- TODO alterar o status da solicitação de serviço para pendente automaticamente no futuro -->
    <label for="status">Status:</label>
    <select name="status" required>
        <option value="pendente">Pendente</option>
        <option value="em andamento">Em andamento</option>
        <option value="finalizado">Finalizado</option>
    </select>

    <label for="description">Descrição:</label>
    <textarea name="description" rows="4" required></textarea>

    <button type="submit">Salvar</button>
</form>
