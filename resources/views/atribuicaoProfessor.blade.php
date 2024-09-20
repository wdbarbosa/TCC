<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <link rel="stylesheet" href="stylefooter.css">
        <link rel="stylesheet" href="styleatribuicaoprof.css">
        <div class="flex justify-between items-center">

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Atribuição de Professores') }}
        </h2>
        @if(auth()->user()->nivel_acesso === 'admin')
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ação do Administrador
                        </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('professores.index') }}">Gerenciar Professores</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('alunos.index') }}">Gerenciar Alunos</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('turma.index') }}">Gerenciar Turmas</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('disciplina.index') }}">Gerenciar Disciplinas</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('alterarInformacao') }}">Alterar Informações</a>
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
                            <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                            {{ __('Atribuição de Professores') }}
                                        </h3>
                                    <table class="w-full mb-12">
                                        <thead>
                                        
                                            <tr>
                                                <th class="col-nome">Professor</th>
                                                <th class="col-disciplina">Disciplina</th>
                                                <th class="col-turma">Turma(s)</th>
                                                <th class="col-acoes">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($atribuicoes as $atribuicao)
                                                <tr>
                                                    <td class="text-center">{{ $atribuicao->professor->user->name }}</td>
                                                    <td class="text-center">{{ $atribuicao->disciplina->nome_disciplina }}</td>
                                                    <td class="text-center">
                                                        {{ $atribuicao->turmas->pluck('nome')->join(', ') }}
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="button" href="{{ route('atribuicaoprofessor.editar', $atribuicao->id) }}">Editar</a>
                                                        <a class="button" href="{{ route('atribuicaoprofessor.deletar', $atribuicao->id) }}">Deletar</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                
                                <div class="button-container">
                                @if($disciplinas->isEmpty())
                                    <script>
                                    function mostrarAlerta() {
                                        alert("Nenhuma atribuição para fazer");
                                    }
                                    window.onload = mostrarAlerta;
                                    </script>
                                @else
                                    <a class="button" href="{{ route('atribuicaoprofessor.adicionar') }}">Adicionar Atribuição</a>
                                </div>
                                @endif
                                
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
    </style>
</x-app-layout>
