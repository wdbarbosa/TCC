<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <link rel="stylesheet" href="stylefooter.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Atribuição de professores') }}
        </h2>
    </x-slot>

    <!DOCTYPE html>
    <html lang="pt-br">
        <body>
            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                @if($atribuicoes->isEmpty())
                                    <p>Não há atribuições de professores</p>
                                @endif
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Professor</th>
                                            <th>Disciplina</th>
                                            <th>Turma(s)</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($atribuicoes->groupBy('fk_disciplina_id') as $disciplinaId => $atribuicoesPorDisciplina)
                                        @foreach ($atribuicoesPorDisciplina->unique('fk_professor_users_id') as $atribuicao)
                                            <tr>
                                                <td>{{ $atribuicao->professor->user->name }}</td>
                                                <td>{{ $atribuicao->disciplina->nome_disciplina }}</td>
                                                <td>
                                                    @foreach ($atribuicoesPorDisciplina as $item)
                                                        @if ($item->professor->user->name === $atribuicao->professor->user->name)
                                                            {{ $item->turma->nome }}{{ !$loop->last ? ', ' : '' }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <a href="{{ route('atribuicaoprofessor.editar', $atribuicao->id) }}">Editar</a>
                                                    <a href="{{ route('atribuicaoprofessor.deletar', $atribuicao->id) }}">Deletar</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach

                                    </tbody>
                                </table>
                                <a href="{{ route('atribuicaoprofessor.adicionar') }}" class="">Adicionar Atribuição</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('layouts._rodape')
        </body>
    </html>
</x-app-layout>
