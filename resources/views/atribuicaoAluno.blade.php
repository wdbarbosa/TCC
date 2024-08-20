<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
<link rel="stylesheet" href="stylefooter.css">
<link rel="stylesheet" href="stylealuno.css">
<x-slot name="header">
    <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Atribuição de Turmas e Alunos') }}
    </h1>
</x-slot>
<main>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($turmas->isEmpty())
                        <p>Não há turmas cadastradas</p>
                    @else
                        @foreach($turmas as $turma)
                            <h3 class="font-semibold text-lg mb-4">{{ $turma->nome }}</h3>
                            @if($turma->alunos->isEmpty())
                                <p>Não há alunos atribuídos a esta turma</p>
                            @else
                                <table class="w-full mb-12"> <!-- Aumenta o espaçamento entre tabelas -->
                                    <thead>
                                        <tr>
                                            <th class="col-nome">Nome do Aluno</th>
                                            <th class="col-matricula">Matrícula</th>
                                            <th class="col-acoes">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($turma->alunos as $aluno)
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
                            @endif
                        @endforeach
                    @endif
                    <div class="button-container">
                        <a class="button" href="{{ route('dashboard') }}">Voltar</a>
                        <a class="button" href="{{ route('atribuicaoaluno.adicionar') }}">Adicionar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('layouts._rodape')
</x-app-layout>
