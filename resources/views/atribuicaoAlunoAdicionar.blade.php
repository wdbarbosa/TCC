<x-app-layout>
    @section('title', 'Atribuição de alunos')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Atribuição de alunos') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2>Nova Atribuição</h2>
                    <form action="{{ route('atribuicaoaluno.salvar') }}" method="POST">
                        {{ csrf_field() }}
                        <table>
                            @foreach($alunos as $aluno)
                                <tr>
                                    <td>{{ $aluno->user->name }}</td>
                                    <td>
                                        <select name="turma[{{ $aluno->fk_pessoa_id_pessoa }}]" required>
                                            <option value="" disabled>Selecione uma turma</option>
                                            @foreach($turmas as $turma)
                                                <option value="{{ $turma->id }}">{{ $turma->nome }}</option>
                                            @endforeach
                                        </select>
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
</x-app-layout>
