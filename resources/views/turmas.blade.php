<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('/stylefooter.css') }}">
        <link rel="stylesheet" href="{{ asset('/stylecrudturmas.css') }}">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <a href="{{ route('dashboard') }}" class="mr-4" alt="Voltar">
                    <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
                </a>
                {{ __('Turmas') }}
            </h2>
            @if(auth()->user()->nivel_acesso === 'admin')
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ação do Administrador
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('professores.index') }}">Gerenciar Professores</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('alunos.index') }}">Gerenciar Alunos</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('turma.index') }}">Gerenciar Turmas</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('disciplina.index') }}">Gerenciar Disciplinas</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('atribuicaoprofessor.index') }}">Atribuir Professores</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('atribuicaoaluno.index') }}">Atribuir Alunos</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('alterarInformacao') }}">Alterar Informações</a>
                    </div>
                </div>
            @endif
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
