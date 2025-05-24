<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Título Padrão')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@275;600&family=Aboreto&display=swap"
        rel="stylesheet">
    @vite(['resources/css/global.css'])
    @yield('css')
</head>

<body>
    @include('components.alerta-erros')
    <div class="container">
        @include('components.header')

        @yield('content')

        @include('components.footer')
    </div>

    @stack('scripts')

</body>

</html>
