<div class="header">
    <a href="{{ url('/home') }}" class="home-container">
        <img src="{{ asset('images/Tatu.svg') }}" alt="Descrição da imagem" width="145" height="100">
    </a>
    <div class="menu-container">
        <a href="{{ url('/about') }}" class="header-button sobre-nos">Sobre nós</a>
        <a href="{{ url('/servicos') }}" class="header-button">Serviços</a>

        @guest
            <a href="{{ url('/login') }}" class="header-button">Login</a>
        @endguest

        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="header-button">
                    Logout
                </button>

            </form>
        @endauth
    </div>
</div>
