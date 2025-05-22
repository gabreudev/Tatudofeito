@if ($errors->any())
    <div class="alert alert-danger" style="color: red;">
        <strong>Erros encontrados:</strong>
        <ul>
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
@endif