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
            <a href="{{ route('usuarios.available') }}" class="service-item">
                <img src="{{ asset('images/image1.png') }}" alt="Culinária">
                <div class="service-label">Culinária</div>
            </a>
            <a href="{{ route('usuarios.available') }}" class="service-item">
                <img src="{{ asset('images/image2.png') }}" alt="Reparos">
                <div class="service-label">Reparos</div>
            </a>
            <a href="{{ route('usuarios.available') }}" class="service-item">
                <img src="{{ asset('images/image3.png') }}" alt="Pintura">
                <div class="service-label">Pintura</div>
            </a>
            <a href="{{ route('usuarios.available') }}" class="service-item">
                <img src="{{ asset('images/image4.png') }}" alt="Limpeza">
                <div class="service-label">Limpeza</div>
            </a>
            <a href="{{ route('usuarios.available') }}" class="service-item">
                <img src="{{ asset('images/image5.png') }}" alt="Mudanças">
                <div class="service-label">Mudanças</div>
            </a>
            <a href="{{ route('usuarios.available') }}" class="service-item">
                <img src="{{ asset('images/image6.png') }}" alt="Limpeza de Piscina">
                <div class="service-label">Piscina</div>
            </a>
        </div>

    </div>
@endsection
