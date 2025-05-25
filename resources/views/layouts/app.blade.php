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

    @include('components.header')

    <main>
        @yield('content')
    </main>

    @include('components.footer')

    @stack('scripts')

</body>

</html>
