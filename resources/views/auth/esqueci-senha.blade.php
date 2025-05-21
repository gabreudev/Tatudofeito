<!-- resources/views/auth/esqueci-senha.blade.php -->
@include('components.alerta-erros')

@if (session('status'))
<div style="color: green;">
    {{ session('status') }}
</div>
@endif



<h2>Recuperar senha</h2>

@if(session('status'))
<p style="color: green;">{{ session('status') }}</p>
@endif

<form action="{{ route('password.send-code') }}" method="POST">
    @csrf
    <label for="email">Digite seu e-mail:</label>
    <input type="email" name="email" required>
    <button type="submit">Enviar código</button>
</form>