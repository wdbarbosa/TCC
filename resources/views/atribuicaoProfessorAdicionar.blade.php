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
                    <form action="{{ route('atribuicaoprofessor.salvar') }}" method="POST">
                        @csrf
                        <table>
                            @foreach($disciplinas as $disciplina)
                                <tr>
                                    <td>{{ $disciplina->disciplina_descricao }}</td>
                                    <td>
                                        <select name="disciplinas[{{ $disciplina->id }}]">
                                            @foreach($professores as $professor)
                                                <option value="{{ $professor->fk_pessoa_id_pessoa }}">{{ $professor->user->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        @foreach($turmas as $turma)
                                            <label>
                                                <input type="checkbox" name="turmas[{{ $disciplina->id_disciplina }}][]" value="{{ $turma->id }}">
                                                {{ $turma->nome }}
                                            </label>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <button type="submit">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts._rodape')
</x-app-layout>
