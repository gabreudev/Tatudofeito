<h1>Deixe um comentário sobre o serviço</h1>

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

<form action="{{ route('reviews.store') }}" method="POST">
    @csrf

    <input type="hidden" name="service_id" value="{{ $serviceId }}">

    <label for="rating">Nota (1 a 5):</label>
    <select name="rating" required>
        <option value="">Selecione uma nota</option>
        @for ($i = 1; $i <= 5; $i++)
            <option value="{{ $i }}">{{ $i }} estrela{{ $i > 1 ? 's' : '' }}</option>
        @endfor
    </select>

    <label for="comment">Comentário:</label>
    <textarea name="comment" rows="4" required placeholder="Escreva aqui sua opinião sobre o serviço..."></textarea>

    <button type="submit">Enviar Comentário</button>
</form>
