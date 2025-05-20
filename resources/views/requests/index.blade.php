<div class="container">
    <h1>Minhas Solicitações de Serviço</h1>

    @if ($requests->isEmpty())
        <p>Você não possui nenhuma solicitação no momento.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Prestador</th>
                    <th>Status</th>
                    <th>Enviada em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>{{ $request->client->name }}</td>
                        <td>{{ $request->worker->name }}</td>
                        <td>{{ ucfirst($request->status) }}</td>
                        <td>{{ $request->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @if (auth()->id() === $request->worker_id && $request->status === 'pendente')
                            <form action="{{ route('requests.accept', $request->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Aceitar</button>
                            </form>

                            <form action="{{ route('requests.reject', $request->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Recusar</button>
                            </form>
                            @elseif (auth()->id() === $request->client_id && $request->status === 'pendente')
                            <form action="{{ route('requests.destroy', $request->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Tem certeza que deseja cancelar esta solicitação?')">Cancelar</button>
                            </form>
                            @else
                                <em>Sem ações disponíveis</em>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
