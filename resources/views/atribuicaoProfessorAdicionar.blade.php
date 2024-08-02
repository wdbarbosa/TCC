<x-app-layout>
    @section('title', 'Atribuição de professores')

    <x-slot name="header">
        <link rel="stylesheet" href="stylefooter.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Atribuição de professores') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2>Nova Atribuição</h2>
                    <a href="{{ route('atribuicaoprofessor.index') }}">Voltar</a>
                    <form action="{{ route('atribuicaoprofessor.salvar') }}" method="POST">
                        {{ csrf_field() }}
                        @foreach($disciplinas as $disciplina)
                            <p>{{ $disciplina->disciplina_descricao }}</p>
                            <p>{{ $disciplina->id_disciplina }}</p>
                            <br>
                        @endforeach
                        @foreach($professores as $professor)
                            <p>{{ $professor->user->name }}</p>
                            <p>{{ $professor->fk_pessoa_id_pessoa }}</p>
                            <br>
                        @endforeach
                        @foreach($turmas as $turma)
                            <p>{{ $turma->nome }}</p>
                            <p>{{ $turma->id }}</p>
                            <br>
                        @endforeach
                        <button type="submit">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts._rodape')
</x-app-layout>
