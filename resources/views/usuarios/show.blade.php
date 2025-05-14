<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Detalhes do Usuário</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-3 fw-bold">Nome:</label>
                        <div class="col-sm-9">{{ $user->name }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 fw-bold">E-mail:</label>
                        <div class="col-sm-9">{{ $user->email }}</div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 fw-bold">Criado em:</label>
                        <div class="col-sm-9">{{ $user->created_at->format('d/m/Y H:i') }}</div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Voltar</a>
                        <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-primary">Editar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>