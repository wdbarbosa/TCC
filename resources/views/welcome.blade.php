<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="stylewelcome.css">
    <link rel="stylesheet" href="stylefooter.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <x-slot name="header">
        <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Informações') }}
        </h2>

        @if(auth()->user()->nivel_acesso === 'admin')
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ação do Administrador
                    </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="/professor">Gerenciar Professores</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/aluno">Gerenciar Alunos</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/turma">Gerenciar Turmas</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/disciplina">Gerenciar Disciplinas</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/alterarInformacao">Alterar Informações</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('atribuicaoprofessor.index') }}">Atribuir Professores</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('atribuicaoaluno.index') }}">Atribuir Alunos</a>
                        </div>
                </div>
            @endif
    </x-slot>

    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

            <main>
                <!--article Logo-->
                    <article class="gridLogo">
                        <fieldset>
                            <h3 class="titulo">Nossa Logo</h3>
                            @foreach ($informacao as $info)
                            <img class="imgLogo" src="./img/primeirodemaio.png">

                            <!--{{ $info->imagem }}-->
                            @endforeach
                        </fieldset>
                    </article>


                    <!--article Informações (sobre o cursinho)-->


                <article class="gridInfos">
                    <fieldset>
                        <h3 class="titulo">Informações</h3>
                        @foreach ($informacao as $info)
                            <p>Sobre nós: {{ $info->infogeral }}</p>
                            <p>Endereço: {{ $info->endereco }}</p>
                            <p>Horário para atendimento: {{ $info->horario }}</p>
                            @endforeach
                        </fieldset>
                    </article>


                <!--article Inscricao-->
                <article class="gridInscricao">
                    <fieldset>
                        <h3 class="titulo">Inscrições</h3>
                        @foreach ($informacao as $info)
                                    <p>Período de inscrição: {{\Carbon\Carbon::parse($info->inicio_inscricao)->format('d/m/Y')}} a {{ \Carbon\Carbon::parse($info->fim_inscricao)->format('d/m/Y') }}</p>
                        @endforeach
                    </fieldset>
                </article>
            </main>
        <style>
            
            .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
            z-index: 1000;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu .dropdown-item {
            font-size: 14px;
            padding: 0.5rem 1rem;
            margin: 0.25rem 0;
        }

        .dropdown-menu .dropdown-item:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease-in-out;
        }

        .dropdown-divider {
            border-top: 1px solid #e5e7eb;
            margin: 0.5rem 0;
        }
        </style>
    </html>
</x-app-layout>