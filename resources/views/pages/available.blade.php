@extends('layouts.app')

@section('title', 'Usuarios Disponiveis')

@section('css')
    @vite(['resources/css/available.css'])
@endsection

@section('content')
    <main class="main-content">
        <div class="content-container">
            <div class="filter-section">
                <div class="filter-bar">
                    <input type="text" class="search-input" placeholder="Search...">
                    <button class="search-button">
                        <svg width="29" height="30" viewBox="0 0 29 30" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14.4643 28.4642C18.0352 28.4642 21.4599 27.0457 23.985 24.5206C26.51 21.9956 27.9286 18.5709 27.9286 14.9999C27.9286 11.429 26.51 8.00429 23.985 5.47924C21.4599 2.9542 18.0352 1.53564 14.4643 1.53564C10.8933 1.53564 7.46864 2.9542 4.9436 5.47924C2.41855 8.00429 1 11.429 1 14.9999C1 18.5709 2.41855 21.9956 4.9436 24.5206C7.46864 27.0457 10.8933 28.4642 14.4643 28.4642Z"
                                stroke="#EFEFEF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M20.6786 21.2142L17.095 17.6306M13.4286 19.1428C14.802 19.1428 16.1192 18.5972 17.0904 17.626C18.0615 16.6548 18.6071 15.3377 18.6071 13.9642C18.6071 12.5908 18.0615 11.2736 17.0904 10.3024C16.1192 9.33124 14.802 8.78564 13.4286 8.78564C12.0551 8.78564 10.7379 9.33124 9.76677 10.3024C8.7956 11.2736 8.25 12.5908 8.25 13.9642C8.25 15.3377 8.7956 16.6548 9.76677 17.626C10.7379 18.5972 12.0551 19.1428 13.4286 19.1428Z"
                                stroke="#EFEFEF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <div class="filter-buttons">
                    <button class="filter-btn">mais contratado</button>
                    <button class="filter-btn">melhor avaliado</button>
                    <button class="filter-btn">localização</button>
                </div>
            </div>

            @foreach ($usuarios->where('role', 'worker') as $usuario)
                <div class="filter-person">
                    <div class="person">
                        <div class="profile-card">
                            <a href="{{ route('usuarios.show', $usuario->id) }}" class="profile-avatar">
                                <div class="custom-icon">
                                    <svg class="icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 58 58"
                                        fill="none">
                                        <path
                                            d="M1 50C1 46.287 2.475 42.726 5.1005 40.1005C7.72601 37.475 11.287 36 15 36H43C46.713 36 50.274 37.475 52.8995 40.1005C55.525 42.726 57 46.287 57 50C57 51.8565 56.2625 53.637 54.9497 54.9497C53.637 56.2625 51.8565 57 50 57H8C6.14348 57 4.36301 56.2625 3.05025 54.9497C1.7375 53.637 1 51.8565 1 50Z"
                                            class="icon-path" />
                                        <path
                                            d="M29 22C34.799 22 39.5 17.299 39.5 11.5C39.5 5.70101 34.799 1 29 1C23.201 1 18.5 5.70101 18.5 11.5C18.5 17.299 23.201 22 29 22Z"
                                            class="icon-path-circle" />
                                    </svg>
                                </div>
                            </a>
                            <div class="profile-info">
                                <h2>{{ $usuario->name }}</h2>
                                <!-- <p>{{ $usuario->city ?? 'Cidade não informada' }}</p> -->
                                <!-- <p>Nível de experiência - {{ $usuario->experience_level ?? '0' }}</p> -->
                                <div class="rating">
                                    <span class="stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= round($usuario->average_rating))
                                                ★
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                    </span>
                                    <span class="score">{{ number_format($usuario->average_rating, 1) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
    </main>
@endsection
