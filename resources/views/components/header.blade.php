<div class="header">
    <a href="{{ url('/') }}" class="home-container">
        <x-logo width="145" height="100" />
    </a>
    <div class="menu-container">
        <a href="{{ url('/about') }}" class="header-button sobre-nos">Sobre nós</a>
        <a href="{{ url('/services') }}" class="header-button">Serviços</a>

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
