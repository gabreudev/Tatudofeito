@php
    use App\Enums\ServicoEnum;

    $categories = [
        ServicoEnum::CULINARIA->value,
        ServicoEnum::REPAROS->value,
        ServicoEnum::PINTURA->value,
        ServicoEnum::OUTROS->value,
        ServicoEnum::LIMPEZA->value,
        ServicoEnum::MUDANCA->value,
        ServicoEnum::PISCINA->value,
    ];
@endphp

@extends('layouts.app')

@section('title', 'Serviços')

@section('css')
    @vite(['resources/css/services.css'])
@endsection

@section('content')
    <div class="container">

        <div class="section-title">
            Qual serviço você está precisando?
        </div>

        <div class="services">
            @foreach ($categories as $categoria)
                <a href="{{ route('usuarios.available', ['category' => $categoria]) }}" class="service-item">
                    <img src="{{ asset("images/{$categoria}.png") }}" alt="{{ $categoria }}">
                    <div class="service-label">{{ ucfirst($categoria) }}</div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
