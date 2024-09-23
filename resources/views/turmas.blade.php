<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')

<x-slot name="header">
    <link rel="stylesheet" href="{{ asset('/stylefooter.css') }}">
    <link rel="stylesheet" href="{{ asset('/stylecrudturmas.css') }}">
    <link rel="stylesheet" href="{{ asset('/stylefuncaoadmin.css') }}">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            <a href="{{ route('dashboard') }}" class="mr-4" alt="Voltar">
                <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
            </a>
            {{ __('Turmas') }}
        </h2>
        @include('layouts._funcaoadmin')
    </div>
</x-slot>

<main class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-lg font-semibold mb-4 text-center">Cadastros de Turmas</h2>
                <div class="table-container">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($turmas as $turma)
                                <tr>
                                    <td class="text-center">{{ $turma->nome }}</td>
                                    <td class="descricao text-center">{{ $turma->descricao }}</td>
                                    <td class="text-center">
                                        <a class="button" href="{{ route('turma.edit', $turma->id) }}">Editar</a>
                                        <a class="button" href="{{ route('turma.destroy', $turma->id) }}" 
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $turma->id }}').submit();">
                                            Excluir
                                        </a>
                                        <form id="delete-form-{{ $turma->id }}" action="{{ route('turma.destroy', $turma->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="button-container">
                    <a class="button" href="{{ route('turma.create') }}">Adicionar</a>
                </div>
            </div>
        </div>
    </div>
</main>


<footer>
    @include('layouts._rodape')
</footer>
</x-app-layout>
