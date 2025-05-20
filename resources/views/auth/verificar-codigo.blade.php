@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('status'))
    <div style="color: green;">
        {{ session('status') }}
    </div>
@endif


<form action="{{ route('password.verificar-codigo') }}" method="POST">
    @csrf
    <input type="email" name="email" required placeholder="Digite o email">
    <input type="text" name="code" required placeholder="Digite o código">
    <button type="submit">Verificar código</button>
</form>
