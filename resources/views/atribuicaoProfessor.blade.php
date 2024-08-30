<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <link rel="stylesheet" href="stylefooter.css">
        <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edição da atribuição de Professores') }}
            </h2>

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Atribuição de professores') }}
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

    <!DOCTYPE html>
    <html lang="pt-br">
        <body>
            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                @if($atribuicoes->isEmpty())
                                    <p>Não há atribuições de professores.</p>
                                @else
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Professor</th>
                                                <th>Disciplina</th>
                                                <th>Turma(s)</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($atribuicoes as $atribuicao)
                                                <tr>
                                                    <td>{{ $atribuicao->professor->user->name }}</td>
                                                    <td>{{ $atribuicao->disciplina->nome_disciplina }}</td>
                                                    <td>
                                                        {{ $atribuicao->turmas->pluck('nome')->join(', ') }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('atribuicaoprofessor.editar', $atribuicao->id) }}">Editar</a>
                                                        <a href="{{ route('atribuicaoprofessor.deletar', $atribuicao->id) }}">Deletar</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                                <a href="{{ route('atribuicaoprofessor.adicionar') }}">Adicionar Atribuição</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('layouts._rodape')
        </body>
    </html>
    <style>
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
        table th, table td {
            text-align: left;
            padding: 8px;
        }
    </style>
</x-app-layout>
