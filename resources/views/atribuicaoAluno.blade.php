<x-app-layout>
@section('title', 'Atribuições de Turmas e Alunos')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Atribuição de Turmas e Alunos') }}
    </h2>
</x-slot>

<main>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2>Atribuições de Turmas e Alunos</h2>
                    @foreach($turmas as $turma)
                        <div>
                            <h3>{{ $turma->nome }}</h3>
                            <p>{{ $turma->descricao }}</p>

                            @if($turma->alunos->isEmpty())
                                <p>Não há alunos atribuídos a esta turma</p>
                            @else
                                <ul>
                                    @foreach($turma->alunos as $aluno)
                                        <li>
                                            {{ $aluno->user->name }} (Matrícula: {{ $aluno->matricula }})
                                            <!-- Botões para editar e apagar -->
                                            <a href="{{ route('atribuicaoaluno.editar', $aluno->fk_aluno_users_id) }}">Editar</a>
                                            <a href="{{ route('atribuicaoaluno.deletar', $aluno->fk_aluno_users_id) }}">Deletar</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                    <a href="{{ route('atribuicaoaluno.adicionar') }}">Adicionar Atribuição</a>
                </div>
            </div>
        </div>
    </div>
</main>

@include('layouts._rodape')
</x-app-layout>
