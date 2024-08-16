<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
<link rel="stylesheet" href="stylefooter.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Atribuição de Turmas e Alunos') }}
        </h2>
    </x-slot>
    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2>Edição de atribuição</h2>
                        <p>Aluno: {{ $aluno->user->name }} (Matrícula: {{ $aluno->matricula }})</p>
                        <form action="{{ route('atribuicaoaluno.atualizar', $aluno->fk_aluno_users_id) }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
                            <div>
                                <label for="turma">Turma</label>
                                <select name="turma" required>
                                    <option value="" disabled>Selecione uma turma</option>
                                    @foreach($turmas as $turma)
                                    <option value="{{ $turma->id }}" {{ $aluno->fk_turma_id == $turma->id ? 'selected' : '' }}>
                                        {{ $turma->nome }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@include('layouts._rodape')
</x-app-layout>