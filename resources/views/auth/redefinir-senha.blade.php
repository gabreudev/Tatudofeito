@include('components.alerta-erros')

@if (session('status'))
    <div style="color: green;">
        {{ session('status') }}
    </div>
@endif


<form action="{{ route('password.redefinir') }}" method="POST">
    @csrf
    <input type="hidden" name="email" value="{{ $email }}">
    <input type="hidden" name="code" value="{{ $code }}">

    <input type="password" name="password" placeholder="Nova senha">
    <input type="password" name="password_confirmation" placeholder="Confirme a nova senha">
    <button type="submit">Salvar nova senha</button>
</form>
