<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
<x-slot name="header">
    <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Disciplinas') }}
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
        </div>
    </x-slot>
    <link rel="stylesheet" href="{{ asset('stylefooter.css')}}">
    <link rel="stylesheet" href="styleturmas.css"> 
    <!DOCTYPE html>
    <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="styleturmas.css">
                <title>Disciplinas</title>
                <style>
                        .descricao {
                            word-wrap: break-word;
                            overflow-wrap: break-word;
                        }
                        body {
                            overflow-x: hidden;
                        }
                        .descricao {
                            word-wrap: break-word;
                            overflow-wrap: break-word;
                        }
                        body {
                            overflow-x: hidden;
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
            </style>
        </head>
            <body>
                <h2>Cadastros de Disciplinas</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($disciplinas as $disciplina): ?>
                            <tr>
                                <td><?php echo $disciplina->nome_disciplina; ?></td>
                                <td class="descricao"><?php echo $disciplina->disciplina_descricao; ?></td>
                                <td>
                                    <a class="button" href="/editar-disciplina/<?php echo $disciplina->id; ?>">Editar</a>
                                    <a class="button" href="/excluir-disciplina/<?php echo $disciplina->id; ?>">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
            </table>
            <a class="button" href="/dashboard">Voltar</a>
            <a class="button" href="/adicionarDisciplina">Adicionar</a>
            @include('layouts._rodape')
        </body>
    </html>
</x-app-layout>

