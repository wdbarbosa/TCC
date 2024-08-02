<x-app-layout>
<x-slot name="header">
        <link rel="stylesheet" href="stylefooter.css">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Resumos') }}
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
                                <h2>Atribuição de professor à disciplina</h2>
                                @foreach($professores as $professor)
                                    <p>{{ $professor->user->name ?? 'Erro ao carregar o nome do professor' }}</p>
                                @endforeach
                                @foreach($disciplinas as $disciplina)
                                    <p>{{ $disciplina->disciplina_descricao }}</p>
                                @endforeach
                                @foreach($turmas as $turma)
                                    <p>{{ $turma->nome }}</p>
                                @endforeach
                                @foreach($atribuicoes as $atribuicao)
                                    <p>{{ $atribuicao->professor->user->name }}     {{ $atribuicao->disciplina->disciplina_descricao }}  {{ $atribuicao->turma->nome }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('layouts._rodape')
        </body>
    </html>
</x-app-layout>
