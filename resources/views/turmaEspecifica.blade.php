<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __($turmas->nome) }}
            </h2>
    <link rel="stylesheet" href="stylefooter.css">

            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
            @vite(['resources/css/app.css', 'resources/js/app.js'])

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
                        <a class="dropdown-item" href="/turma">Gerenciar Salas</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/alterarInformacao">Alterar Informações</a>
                    </div>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="sidebar-widget">
            <h3 class="widget-title">Informações da Turma</h3>
            <ul class="widget-list">
                <p class="text-lg font-semibold">Professor: {{ $user->name ?? 'Não disponível' }}</p>
                <!-- Outras informações da turma -->
            </ul>
        </div>

        <div class="turma-container">
            <div class="turma-header">
                <h2 class="turma-title">{{ __($turmas->nome) }}</h2>
                <p class="turma-description">{{ __($turmas->descricao) }}</p>
            </div>

            <div class="turma-content">
                <!-- Conteúdo da Turma -->
                <div class="turma-posts">
                    Outros posts podem seguir aqui
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Regras CSS específicas */
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

        .turma-container {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }

        .turma-header {
            margin-bottom: 10px;
        }

        .turma-title {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .turma-description {
            color: #666;
        }

        .turma-content {
            display: flex;
            flex-wrap: wrap;
        }

        .turma-posts {
            flex: 2;
            margin-right: 20px;
        }

        .turma-sidebar {
            flex: 1;
        }

        .sidebar-widget {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .widget-title {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .widget-list {
            list-style-type: none;
            padding: 0;
        }

        .widget-list li {
            margin-bottom: 5px;
        }
        </style>

    @include('layouts._rodape')
</x-app-layout>
