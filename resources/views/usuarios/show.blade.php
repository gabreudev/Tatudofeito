@include('components.alerta-erros')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Detalhes do Usuário</h4>
                    <span
                        class="badge 
                        @if ($user->role === 'admin') bg-danger
                        @elseif($user->role === 'worker') bg-success
                        @else bg-primary @endif">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
                <div class="card-body">
                    <!-- Informações Básicas -->
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-primary mb-3">Informações Pessoais</h5>

                            <div class="mb-3">
                                <span class="fw-bold">Nome:</span> {{ $user->name }}
                            </div>

                            <div class="mb-3">
                                <span class="fw-bold">CPF:</span> {{ $user->cpf }}
                            </div>

                            <div class="mb-3">
                                <span class="fw-bold">Telefone:</span> {{ $user->phone }}
                            </div>

                            <div class="mb-3">
                                <span class="fw-bold">E-mail:</span> {{ $user->email }}
                            </div>

                            <div class="mb-3">
                                <span class="fw-bold">Status:</span>
                                @if ($user->is_banned)
                                    <span class="badge bg-danger">Banido</span>
                                @else
                                    <span class="badge bg-success">Ativo</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h5 class="text-primary mb-3">Informações do Sistema</h5>

                            <div class="mb-3">
                                <span class="fw-bold">Tipo de Usuário:</span>
                                @switch($user->role)
                                    @case('admin')
                                        <span class="badge bg-danger">Administrador</span>
                                    @break

                                    @case('worker')
                                        <span class="badge bg-success">Trabalhador</span>
                                    @break

                                    @case('client')
                                        <span class="badge bg-primary">Cliente</span>
                                    @break
                                @endswitch
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informações Específicas do Trabalhador -->
                @if ($user->role === 'worker')
                    <hr class="my-4">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="text-success mb-3">Informações Profissionais</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            @if ($user->specialties)
                                <div class="row mb-3">
                                    <label class="col-sm-4 fw-bold">Especialidades:</label>
                                    <div class="col-sm-8">{{ $user->specialties }}</div>
                                </div>
                            @endif
                            @if ($user->categories)
                                <div class="row mb-3">
                                    <label class="col-sm-4 fw-bold">Categorias:</label>
                                    <div class="col-sm-8">
                                        @php
                                            $categories = is_string($user->categories)
                                                ? json_decode($user->categories, true)
                                                : $user->categories;
                                        @endphp
                                        @if (is_array($categories))
                                            @foreach ($categories as $category)
                                                <span class="badge bg-info me-1">{{ $category }}</span>
                                            @endforeach
                                        @else
                                            {{ $user->categories }}
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if ($user->average_rating > 0)
                                <div class="row mb-3">
                                    <label class="col-sm-4 fw-bold">Avaliação Média:</label>
                                    <div class="col-sm-8">
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">{{ number_format($user->average_rating, 1) }}</span>
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $user->average_rating)
                                                    <i class="fas fa-star text-warning"></i>
                                                @elseif($i - 0.5 <= $user->average_rating)
                                                    <i class="fas fa-star-half-alt text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-warning"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            @if ($user->daily_value)
                                <div class="row mb-3">
                                    <label class="col-sm-4 fw-bold">Valor Diário:</label>
                                    <div class="col-sm-8">R$ {{ number_format($user->daily_value, 2, ',', '.') }}</div>
                                </div>
                            @endif

                            @if ($user->payment_methods)
                                <div class="row mb-3">
                                    <label class="col-sm-4 fw-bold">Métodos de Pagamento:</label>
                                    <div class="col-sm-8">{{ $user->payment_methods }}</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($user->description)
                        <div class="row mb-3">
                            <label class="col-sm-2 fw-bold">Descrição:</label>
                            <div class="col-sm-10">
                                <div class="border p-3 rounded bg-light">
                                    {{ $user->description }}
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                <!-- Botões de Ação -->
                <div class="mt-4 d-flex justify-content-between">
                    <div>
                        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Voltar
                        </a>
                    </div>
                    <div>
                        @if (!$user->is_banned)
                            <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-primary me-2">
                                <i class="fas fa-edit me-1"></i>Editar
                            </a>
                        @endif

                        @can('admin')
                            @if ($user->is_banned)
                                <form method="POST" action="{{ route('usuarios.unban', $user->id) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success"
                                        onclick="return confirm('Deseja realmente desbanir este usuário?')">
                                        <i class="fas fa-user-check me-1"></i>Desbanir
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('usuarios.ban', $user->id) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-warning"
                                        onclick="return confirm('Deseja realmente banir este usuário?')">
                                        <i class="fas fa-user-times me-1"></i>Banir
                                    </button>
                                </form>
                            @endif
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
