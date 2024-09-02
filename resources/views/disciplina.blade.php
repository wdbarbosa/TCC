<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')

<x-slot name="header">
    <link rel="stylesheet" href="stylefooter.css">
    <link rel="stylesheet" href="stylealunosblade.css">
    <div class="flex justify-between items-center">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Disciplinas') }}
        </h1>
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
    </div>
</x-slot>

<main>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mb-4">Cadastros de Disciplinas</h2>
                    <table class="w-full rounded-lg shadow-lg">
                        <thead>
                            <tr>
<<<<<<< Updated upstream
                                <th class="text-left w-1/3">Nome</th>
                                <th class="text-left w-1/3">Descrição</th>
                                <th class="text-center w-1/6">Ações</th>
=======
                                <td><?php echo $disciplina->nome_disciplina; ?></td>
                                <td class="descricao"><?php echo $disciplina->disciplina_descricao; ?></td>
                                <td>
                                <a class="button" href="/editar-disciplina/<?php echo $disciplina->id; ?>">Editar</a>
                                <a class="button" href="/excluir-disciplina/<?php echo $disciplina->id; ?>">Excluir</a>
                                </td>
>>>>>>> Stashed changes
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($disciplinas as $disciplina)
                                <tr>
                                    <td class="text-left">{{ $disciplina->nome_disciplina }}</td>
                                    <td class="text-left descricao">{{ $disciplina->disciplina_descricao }}</td>
                                    <td class="text-center">
                                        <a class="button mr-2" href="/editar-disciplina/{{ $disciplina->id }}">Editar</a>
                                        <a class="button" href="/excluir-disciplina/{{ $disciplina->id }}">Excluir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="button-container">
                        <a class="button mr-2" href="/dashboard">Voltar</a>
                        <a class="button" href="/adicionarDisciplina">Adicionar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    .descricao {
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

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

    table {
        border-collapse: collapse;
        width: 100%;
        margin: 0 auto;
        border-radius: 0.375rem; /* Arredondamento das bordas da tabela */
    }

    table th, table td {
        padding: 1rem;
        border: 1px solid #e5e7eb;
    }

    table th {
        text-align: left;
    }

    table td.text-left {
        text-align: left;
    }

    table td.text-center {
        text-align: center;
    }

    .shadow-lg {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .button-container {
        display: flex;
        gap: 0.5rem;
        margin-top: 1rem;
        justify-content: start;
    }

    .button {
        padding: 0.5rem 1rem;
        border: 1px solid #ccc;
        border-radius: 0.375rem;
        background-color: #f9fafb;
        color: #000;
        text-decoration: none;
        text-align: center;
        display: inline-block;
        transition: transform 0.3s;
    }

    .button:hover {
        background-color: #e5e7eb;
        transform: scale(1.05);
    }

    .button:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.2);
    }
</style>

@include('layouts._rodape')
</x-app-layout>
