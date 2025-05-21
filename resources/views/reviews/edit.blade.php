<h1>Editar Avaliação</h1>

@include('components.alerta-erros')

<form action="{{ route('reviews.update', $review->id) }}" method="POST" class="review-form">
    @csrf
    @method('PUT')
    
    <div class="form-section">
        <h2>Detalhes da Avaliação</h2>

        <div class="form-group">
            <label for="comment">Comentário:</label>
            <textarea id="comment" name="comment" rows="5" required>{{ old('comment', $review->comment) }}</textarea>
            <small>Máximo de 1500 caracteres</small>
        </div>

        <div class="form-group">
            <label for="stars">Nota (1 a 5):</label>
            <select id="stars" name="stars" required>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old('stars', $review->stars) == $i ? 'selected' : '' }}>
                        {{ $i }} estrela{{ $i > 1 ? 's' : '' }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="form-group">
            <label for="url_image">URL da imagem (opcional):</label>
            <input type="url" id="url_image" name="url_image" 
                   value="{{ old('url_image', $review->url_image) }}" maxlength="255">
            <small>Se desejar adicionar uma imagem à avaliação, insira a URL aqui.</small>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-primary">Atualizar Avaliação</button>
        <a href="{{ route('reviews.index') }}" class="btn-secondary">Cancelar</a>
    </div>
</form>


<style>
.review-form {
    max-width: 700px;
    margin: 0 auto;
}

.form-section {
    margin-bottom: 30px;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.form-group small {
    display: block;
    margin-top: 5px;
    color: #666;
}

.alert {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.alert-danger {
    background-color: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

.form-actions {
    margin-top: 20px;
    text-align: right;
}

.btn-primary {
    background-color: #28a745;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    display: inline-block;
    margin-left: 10px;
}
</style>