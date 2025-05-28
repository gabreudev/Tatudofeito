@extends('layouts.app')

@section('title', 'Home')

@section('css')
    @vite(['resources/css/home.css'])
@endsection

@section('content')
    <div class="container">
        <div class="carousel-container">
            <div class="carousel" id="carousel">
                <div class="carousel-item">
                    <img src="{{ asset('images/Home.svg') }}" alt="Serviços Domésticos">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/Home2.svg') }}" alt="Reformas e Construção">

                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/Home3.svg') }}" alt="Tecnologia e Informática">
                </div>
            </div>

            <div class="carousel-controls">
                <button onclick="changeSlide(-1)">&#10094;</button>
                <button onclick="changeSlide(1)">&#10095;</button>
            </div>
        </div>
    </div>

    <script>
        let currentSlide = 0;
        const carousel = document.getElementById('carousel');
        const slides = document.querySelectorAll('.carousel-item');

        function changeSlide(direction) {
            currentSlide += direction;

            if (currentSlide >= slides.length) {
                currentSlide = 0;
            }
            if (currentSlide < 0) {
                currentSlide = slides.length - 1;
            }

            carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
        }

        // Autoplay functionality
        setInterval(() => {
            changeSlide(1);
        }, 5000);
    </script>
@endsection
