<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <link rel="stylesheet" href="stylefooter.css">
        <link rel="stylesheet" href="styleatribuicaoprofdisci.css">
        <link rel="stylesheet" href="stylefuncaoadmin.css">
        <div class="flex justify-between items-center">

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <a href="{{ route('atribuicaoprofessor.index') }}" class="mr-4" alt="Voltar">
                    <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
                </a>
            {{ __('Atribuição de Professores e Disciplinas') }}
        </h2>
        @include('layouts._funcaoadmin')
        </div>
    </x-slot>

    <!DOCTYPE html>
    <html lang="pt-br">
        <body>
            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                            {{ __('Atribuição de Professores e Disciplinas') }}
                                        </h3>
                                    <table class="w-full mb-12">
                                        <thead>
                                            <tr>
                                                <th class="col-nome">Professor</th>
                                                <th class="col-disciplina">Disciplina(s)</th>
                                                <th class="col-acoes">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($atribuicoes->sortBy('professor.user.nome') as $atribuicao)
                                                <tr>
                                                    <td class="text-center">{{ $atribuicao->professor->user->name }}</td>
                                                    <td class="text-center">
                                                        {{ $atribuicao->disciplinas->pluck('nome_disciplina')->join(', ') }}
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="button" href="{{ route('atribuicaoprofessordisciplina.editar', $atribuicao->id) }}">Editar</a>
                                                        <a class="button" href="{{ route('atribuicaoprofessordisciplina.deletar', $atribuicao->id) }}">Deletar</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                
                                <div class="button-container">
                                    <a class="button" href="{{ route('atribuicaoprofessordisciplina.adicionar') }}">Adicionar Atribuição</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('layouts._rodape')
        </body>
    </html>
</x-app-layout>
