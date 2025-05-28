@extends('layouts.app')

@section('title', 'Sobre Nós')

@section('css')
    @vite(['resources/css/about.css'])
@endsection

@section('content')
        <div class="content-wrapper">
            <div class="main-title">Facilitando conexões, melhorando rotinas</div>

            <div class="main-text">
                Vivemos em uma sociedade cada vez mais especializada, onde o ritmo acelerado
                da vida moderna e a crescente urbanização torna a realização de todas as tarefas
                do dia a dia uma tarefa desafiadora. Muitas vezes, falta tempo ou habilidade para
                executar certas funções essenciais, como manutenção de residências, reparos de
                eletrônicos ou cuidados com itens pessoais.
            </div>
            <div class="main-text">
                Nosso objetivo é conectar pessoas a profissionais capacitados, garantindo serviços
                seguros e de qualidade. Com uma plataforma inovadora, facilitamos essa conexão
                de forma simples e eficiente. Encontrar o profissional certo para a tarefa certa
                é essencial para tornar a rotina mais prática e tranquila.<br>

            </div>
            <div class="main-text">
                Estamos construindo mais do que um sistema, estamos criando uma ponte entre pessoas e serviços, com
                tecnologia confiável, intuitiva e segura.<br>
            </div>
        </div>
@endsection
