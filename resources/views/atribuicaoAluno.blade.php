<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
<link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
<link rel="stylesheet" href="stylealuno.css">
<x-slot name="header">
    <div class="flex justify-between items-center">
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Atribuição de Turmas e Alunos') }}
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
                @if($turmas->isEmpty())
                        <p>Não há turmas cadastradas</p>
                    @else
                        @php $turmasComAlunos = $turmas->filter(function($turma) { return $turma->alunos->isNotEmpty(); }); @endphp

                        @if($turmasComAlunos->isEmpty())
                            <p>Não há turmas com alunos cadastrados</p>
                        @else
                            @foreach($turmasComAlunos->sortBy('nome') as $turma)           
                                <h3 class="font-semibold text-lg mb-4">{{ $turma->nome }}</h3>
                                <table class="w-full mb-12"> 
                                    <thead>
                                        <tr>
                                            <th class="col-nome">Nome do Aluno</th>
                                            <th class="col-matricula">Matrícula</th>
                                            <th class="col-acoes">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($turma->alunos->sortBy(function($aluno){
                                        return $aluno->user->name;
                                    }) as $aluno)
                                            <tr>
                                                <td>{{ $aluno->user->name }}</td>
                                                <td class="text-center">{{ $aluno->matricula }}</td>
                                                <td class="text-center">
                                                    <a class="button" href="{{ route('atribuicaoaluno.editar', $aluno->fk_aluno_users_id) }}">Editar</a>
                                                    <a class="button" href="{{ route('atribuicaoaluno.deletar', $aluno->fk_aluno_users_id) }}">Excluir</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        @endif
                @endif

                    <div class="button-container">
                        <a class="button" href="{{ route('dashboard') }}">Voltar</a>
                        @if($alunos->isEmpty())
                        <script>
                                function mostrarAlerta() {
                                    alert("Nenhuma atribuiçao para fazer");
                                }
                                window.onload = mostrarAlerta;
                        </script>
                        @else
                        <a class="button" href="{{ route('atribuicaoaluno.adicionar') }}">Adicionar</a>
                        @endif
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
@include('layouts._rodape')
</x-app-layout>
