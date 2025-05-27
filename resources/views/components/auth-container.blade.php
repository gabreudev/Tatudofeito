<x-auth-card>
    <h1>{{ $title ?? 'Bem-vindo(a)!' }}</h1>
    @isset($subtitle)
        <h2>{{ $subtitle }}</h2>
    @endisset

    <x-logo :width="$logoWidth ?? null" :height="$logoHeight ?? null" />

    <x-session-status />

    <form method="{{ $method ?? 'POST' }}" action="{{ route($routeName) }}">
        @csrf

        {{ $slot }}

        @isset($submitLabel)
            <x-default-button>{{ $submitLabel }}</x-default-button>
        @endisset

        {{ $afterButton ?? '' }}
    </form>
</x-auth-card>
