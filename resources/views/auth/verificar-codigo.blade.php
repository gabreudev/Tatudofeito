@include('components.alerta-erros')

@if (session('status'))
    <div style="color: green;">
        {{ session('status') }}
    </div>
@endif


<form action="{{ route('password.verificar-codigo') }}" method="POST">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">
    <input type="text" name="code" required placeholder="Digite o código">
    <button type="submit">Verificar código</button>
</form>
