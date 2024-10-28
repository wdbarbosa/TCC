<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
        <link rel="stylesheet" href="{{ asset('styleatribuicaoprof.css') }}">
        <link rel="stylesheet" href="{{ asset('stylefuncaoadmin.css') }}">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <a href="{{ route('dashboard') }}" class="mr-4" alt="Voltar">
                    <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
                </a>
                {{ __('Atribuição de Professores') }}
            </h2>
            @include('layouts._funcaoadmin')
        </div>
    </x-slot>

    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            {{ __('Atribuição de Professores') }}
                        </h3>
                        <a class="button" href="{{ route('atribuicaoturmadisciplina.index') }}">Gerenciar Atribuição de Disciplinas e Turmas</a>
                        <a class="button" href="{{ route('atribuicaoprofessordisciplina.index') }}">Gerenciar Atribuição de Disciplinas e Professores</a>
                        <table class="w-full mb-12">
                            <thead>
                                <tr>
                                    <th class="col-nome">Professor</th>
                                    <th class="col-disciplina">Disciplina</th>
                                    <th class="col-turma">Turma</th>
                                    <th class="col-acoes">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($atribuicoes as $atribuicao)
                                    <tr>
                                        <td class="text-center">{{ $atribuicao->professor->user->name }}</td>
                                        <td class="text-center">{{ $atribuicao->disciplina->nome_disciplina }}</td>
                                        <td class="text-center">{{ $atribuicao->turma->nome }}</td>
                                        <td class="text-center">
                                            <a class="button" href="{{ route('atribuicaoprofessor.editar', $atribuicao->id) }}">Editar</a>
                                            <a class="button" href="{{ route('atribuicaoprofessor.deletar', $atribuicao->id) }}">Deletar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="button-container">
                            <a class="button" href="{{ route('atribuicaoprofessor.adicionar') }}">Adicionar Atribuição</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layouts._rodape')
</x-app-layout>
