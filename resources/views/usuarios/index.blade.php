<div class="container">
    <h1>Lista de Usuários</h1>

    <div class="botton">
        <div class="mb-3">
            <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Cadastrar novo usuário</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Tipo</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->cpf }}</td>
                                <td>{{ $usuario->phone }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ ucfirst($usuario->role) }}</td>
                                <td>
                                    <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-sm btn-info">Ver</a>
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Nenhum usuário encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos gerais */
:root {
  --primary-color: #3490dc;
  --primary-hover: #2779bd;
  --danger-color: #e3342f;
  --danger-hover: #cc1f1a;
  --info-color: #38c172;
  --info-hover: #2d995b;
  --light-gray: #f8f9fa;
  --border-color: #e2e8f0;
  --text-color: #2d3748;
  --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  --radius: 0.5rem;
}

body {
  font-family: 'Nunito', sans-serif;
  background-color: #f5f7fa;
  color: var(--text-color);
}

.container {
  max-width: 1200px;
  margin: 2rem auto;
  padding: 0 1rem;
}

/* Cabeçalho */
h1 {
  color: var(--text-color);
  margin-bottom: 1.5rem;
  font-weight: 700;
  font-size: 1.8rem;
  border-left: 5px solid var(--primary-color);
  padding-left: 1rem;
}

/* Card principal */
.card {
  background: white;
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  margin-bottom: 2rem;
  overflow: hidden;
  border: none;
}

.card-body {
  padding: 1.5rem;
}

/* Botões */
.botton {
  display: flex;
  justify-content: space-between;
  margin-bottom: 1.5rem;
  align-items: center;
}

.btn {
  border-radius: 0.375rem;
  font-weight: 600;
  transition: all 0.2s ease;
  cursor: pointer;
}

.btn-primary {
  background-color: var(--primary-color);
  border-color: var(--primary-color);
  padding: 0.5rem 1rem;
}

.btn-primary:hover {
  background-color: var(--primary-hover);
  border-color: var(--primary-hover);
  transform: translateY(-2px);
}

.btn-danger {
  background-color: var(--danger-color);
  border-color: var(--danger-color);
}

.btn-danger:hover {
  background-color: var(--danger-hover);
  border-color: var(--danger-hover);
}

.btn-info {
  background-color: var(--info-color);
  border-color: var(--info-color);
  color: white;
}

.btn-info:hover {
  background-color: var(--info-hover);
  border-color: var(--info-hover);
  color: white;
}

.btn-sm {
  padding: 0.25rem 0.5rem;
  font-size: 0.85rem;
  margin-right: 0.25rem;
}

/* Tabela */
.table-responsive {
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}

.table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
}

.table th {
  background-color: #f8fafc;
  font-weight: 600;
  text-transform: uppercase;
  font-size: 0.8rem;
  letter-spacing: 0.5px;
  color: #64748b;
  padding: 1rem;
  border-bottom: 2px solid var(--border-color);
  text-align: left;
}

.table td {
  padding: 1rem;
  vertical-align: middle;
  border-bottom: 1px solid var(--border-color);
  font-size: 0.95rem;
}

.table tr:last-child td {
  border-bottom: none;
}

.table-striped tbody tr:nth-of-type(odd) {
  background-color: rgba(0, 0, 0, 0.02);
}

.table tbody tr:hover {
  background-color: rgba(52, 144, 220, 0.05);
}

/* Ações na tabela */
td form {
  display: inline-block;
}

/* Mensagem quando não há dados */
.text-center {
  text-align: center;
}

/* Responsividade */
@media (max-width: 768px) {
  .table thead {
    display: none;
  }
  
  .table tbody tr {
    display: block;
    margin-bottom: 1rem;
    border: 1px solid var(--border-color);
    border-radius: var(--radius);
  }
  
  .table tbody td {
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-align: right;
    border-bottom: 1px solid var(--border-color);
  }
  
  .table tbody td:before {
    content: attr(data-label);
    font-weight: 600;
    text-align: left;
  }
  
  .table tbody td:last-child {
    border-bottom: none;
  }
  
  .btn-sm {
    margin-bottom: 0.25rem;
  }
}
</style>