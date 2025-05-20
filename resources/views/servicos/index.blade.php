<h1>Lista de Serviços</h1>

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

<a href="{{ route('servicos.create') }}">Novo Serviço</a>

@if(session('success'))
<p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Prestador</th>
            <th>Status</th>
            <th>Descrição</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($servicos as $servico)
        <tr>
            <td>{{ $servico->id }}</td>
            <td>{{ $servico->client->name ?? 'N/A' }}</td>
            <td>{{ $servico->worker->name ?? 'N/A' }}</td>
            <td>{{ $servico->status }}</td>
            <td>{{ $servico->description }}</td>
            <td>
                <a href="{{ route('servicos.edit', $servico->id) }}">Editar</a>
                <form action="{{ route('requests.store') }}" method="POST" style="margin-top: 5px;">
                    @csrf
                    <input type="number" name="worker_id" placeholder="ID do prestador" required>
                    <input type="hidden" name="status" value="pendente">
                    <input type="hidden" name="service_id" value="{{ $servico->id }}">

                    <button type="submit">Solicitar Serviço</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">Nenhum serviço encontrado.</td>
        </tr>
        @endforelse
    </tbody>
</table>