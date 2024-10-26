<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
        <link rel="stylesheet" href="{{ asset('styleatribuicaoturmadisci.css') }}">
        <link rel="stylesheet" href="{{ asset('stylefuncaoadmin.css') }}">
        <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <a href="{{ route('atribuicaoprofessor.index') }}" class="mr-4" alt="Voltar">
                    <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
                </a>
            {{ __('Atribuição de Turmas e Disciplinas') }}
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
                                            {{ __('Atribuição de Turmas e Disciplinas') }}
                                        </h3>
                                        <table class="w-full mb-12">
                                            <thead>
                                                <tr>
                                                    <th class="col-nome">Turma</th>
                                                    <th class="col-disciplina">Disciplina(s)</th>
                                                    <th class="col-acoes">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($atribuicoes->sortBy('turma.nome')->groupBy('turma.id') as $turmaId => $atribuicoesTurma)
                                                @php
                                                    $primeiraAtribuicao = $atribuicoesTurma->first();
                                                    $disciplinas = $primeiraAtribuicao->turma->disciplinas->pluck('nome_disciplina')->implode(', ');
                                                @endphp
                                                <tr>
                                                    <td class="text-center">{{ $primeiraAtribuicao->turma->nome }}</td>
                                                    <td class="text-center">
                                                        @if($disciplinas)
                                                            {{ $disciplinas }}
                                                        @else
                                                            Nenhuma disciplina atribuída
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="button" href="{{ route('atribuicaoturmadisciplina.editar', $primeiraAtribuicao->id) }}">Editar</a>
                                                        <a class="button" href="{{ route('atribuicaoturmadisciplina.deletar', $primeiraAtribuicao->id) }}">Deletar</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="button-container">
                                        @if($turmas->isEmpty())
                                            <script>
                                                function mostrarAlerta() {
                                                    alert("Nenhuma turma disponível para atribuir disciplinas.");
                                                }
                                                window.onload = mostrarAlerta;
                                            </script>
                                        @else
                                            <a class="button" href="{{ route('atribuicaoturmadisciplina.adicionar') }}">Adicionar Atribuição</a>
                                        @endif
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
