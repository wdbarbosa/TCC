<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
<link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
<link rel="stylesheet" href="stylealuno.css">
<link rel="stylesheet" href="stylefuncaoadmin.css">
<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            <a href="{{ route('dashboard') }}" class="mr-4" alt="Voltar">
                <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
            </a>
            {{ __('Atribuição de Turmas e Alunos') }}
        </h2>
        @include('layouts._funcaoadmin')
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
                    
                    @if($alunos->isEmpty())
                    
                        <script>
                            function mostrarAlerta() {
                                alert("Nenhuma atribuição para fazer");
                            }
                            window.onload = mostrarAlerta;
                        </script>
                    @else
                    <hr>
                        <div class="button-container mt-4">
                            <a class="button" href="{{ route('atribuicaoaluno.adicionar') }}">Adicionar</a>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</main>
@include('layouts._rodape')
</x-app-layout>
