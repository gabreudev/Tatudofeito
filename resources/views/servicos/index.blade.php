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

<a href="{{ route('services.create') }}">Novo Serviço</a>

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
        @forelse ($services as $service)
        <tr>
            <td>{{ $service->id }}</td>
            <td>{{ $service->client->name ?? 'N/A' }}</td>
            <td>{{ $service->worker->name ?? 'N/A' }}</td>
            <td>{{ $service->status }}</td>
            <td>{{ $service->description }}</td>
            <td>
                <a href="{{ route('services.edit', $service->id) }}">Editar</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">Nenhum serviço encontrado.</td>
        </tr>
        @endforelse
    </tbody>
</table>