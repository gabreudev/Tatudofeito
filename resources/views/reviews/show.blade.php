<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Avaliação</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Detalhes da Avaliação</h1>

        <div class="card">
            <div class="card-header">
                <h5>Avaliação #{{ $review->id }}</h5>
            </div>
            <div class="card-body">
                <p><strong>Usuário ID:</strong> {{ $review->user_id ?? 'Não informado' }}</p>
                <p><strong>Nota:</strong> {{ $review->rating ?? 'Não avaliado' }}</p>
                <p><strong>Comentário:</strong> {{ $review->comment ?? 'Sem comentário' }}</p>
                <p><strong>Data de Criação:</strong> {{ $review->created_at ? $review->created_at->format('d/m/Y H:i') : 'Não disponível' }}</p>
                <p><strong>Última Atualização:</strong> {{ $review->updated_at ? $review->updated_at->format('d/m/Y H:i') : 'Não disponível' }}</p>
            </div>
            <div class="card-footer">
                <a href="{{ route('reviews.index') }}" class="btn btn-primary">Voltar para a lista</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, para interatividade) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>