<div class="container">
    <h1>Lista de Comentários</h1>

    @include('components.alerta-erros')

    @if (session('success'))
    <div class="alert alert-success" style="color: green; margin-bottom: 10px;">
        {{ session('success') }}
    </div>
    @endif

    @if ($reviews->isEmpty())
    <p>Nenhum comentário encontrado.</p>
    @else
    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nota</th>
                <th>Comentário</th>
                <th>Imagem</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
            <tr>
                <td>{{ $review->id }}</td>
                <td>
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <=$review->stars)
                        <span class="star filled">★</span>
                        @else
                        <span class="star empty">☆</span>
                        @endif
                        @endfor
                </td>
                <td>{{ $review->comment }}</td>
                <td>
                    @if ($review->url_image)
                    <img src="{{ $review->url_image }}" alt="Imagem do comentário" width="100">
                    @else
                    Sem imagem
                    @endif
                </td>
                <td>{{ $review->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

<style>
    .star.filled {
        color: gold;
    }

    .star.empty {
        color: #ccc;
    }
</style>