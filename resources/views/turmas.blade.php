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
    <main>
        <h2>Cadastros de Turmas</h2>
            <table>
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
                            <td>{{ $turma->nome }}</td>
                            <td class="descricao">{{ $turma->descricao }}</td>
                            <td>
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
            <a class="button" href="{{ route('dashboard') }}">Voltar</a>
            <a class="button" href="{{ route('turma.create') }}">Adicionar</a>
        </main>    
    <footer>
    @include('layouts._rodape')
    </footer>
   
</x-app-layout>
