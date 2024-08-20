<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
<link rel="stylesheet" href="stylefooter.css">
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Atribuição de Turmas e Alunos') }}
    </h2>

    <link rel="stylesheet" href="stylealuno.css">

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
                            <div class="mb-4">
                                <b><h3>{{ $turma->nome }}</h3></b>
                                @if($turma->alunos->isEmpty())
                                    <p>Não há alunos atribuídos a esta turma</p>
                                @else
                                    <ul class="list-disc pl-5">
                                        @foreach($turma->alunos as $aluno)
                                            <li class="mb-2">
                                                {{ $aluno->user->name }} (Matrícula: {{ $aluno->matricula }})
                                                <a href="{{ route('atribuicaoaluno.editar', $aluno->fk_aluno_users_id) }}" class="btn btn-edit">Editar</a>
                                                <a href="{{ route('atribuicaoaluno.deletar', $aluno->fk_aluno_users_id) }}" class="btn btn-delete">Deletar</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    @endif
                    <a href="{{ route('atribuicaoaluno.adicionar') }}" class="btn btn-add">Adicionar Atribuição</a>
                </div>
            </div>
        </div>
    </div>
</main>
@include('layouts._rodape')
</x-app-layout>
