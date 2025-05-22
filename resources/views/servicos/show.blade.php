<h1>Detalhes do Serviço #{{ $servico->id }}</h1>

@include('components.alerta-erros')

<p><strong>Cliente:</strong> {{ $servico->client->name ?? 'N/A' }}</p>
<p><strong>Prestador:</strong> {{ $servico->worker->name ?? 'N/A' }}</p>
<p><strong>Status:</strong> {{ $servico->status }}</p>
<p><strong>Descrição:</strong> {{ $servico->description }}</p>

<a href="{{ route('servicos.index') }}">Voltar para a lista</a> |
<a href="{{ route('servicos.edit', $servico->id) }}">Editar Serviço</a>