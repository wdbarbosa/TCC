<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
    <link rel="stylesheet" href="{{ asset('styleatribuicaoturmadisci.css') }}">
    <link rel="stylesheet" href="{{ asset('stylefuncaoadmin.css') }}">
    <x-slot name="header">      
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <a href="{{ route('atribuicaoturmadisciplina.index') }}" class="mr-4" alt="Voltar">
                    <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
                </a>
            {{ __('Atribuição de Turmas e Disciplinas') }}
        </h2>
        @include('layouts._funcaoadmin')
    </x-slot>
    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-200 py-1 leading-tight text-center ">
                            {{ __('Adicionar Atribuição de Turmas e Disciplinas') }}
                        </h2>
                            <form action="{{ route('atribuicaoturmadisciplina.salvar') }}" method="POST">
                                {{ csrf_field() }}
                                <table class="w-full">
                                    @foreach($turmas as $turma)
                                        <tr>
                                            <td class="font-bold">{{ $turma->nome }}</td>
                                            <td>
                                                <label>Disciplinas:</label>
                                                <div>
                                                    @foreach ($disciplinas as $disciplina)
                                                        <label class="checkbox-custom">
                                                            <input type="checkbox" name="disciplinas[]" value="{{ $disciplina->id }}">
                                                            <span class="checkbox-circle"></span>
                                                            <span class="chackbox-text">{{ $disciplina->nome_disciplina }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <div class="button-container">
                                    <button type="submit" class="button">Salvar</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layouts._rodape')
</x-app-layout>
