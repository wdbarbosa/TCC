<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <link rel="stylesheet" href="stylefooter.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="styleturmasdash.css">

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Home') }}
            </h2>   
        </div>
    </x-slot>

    <main class="main">
        @if(auth()->user()->nivel_acesso === 'admin')
            <div class="admin-actions first-grid-container py-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <a href="{{ route('professores.index') }}" class="admin-action">
                            Gerenciar Professores
                        </a>
                        <a href="{{ route('alunos.index') }}" class="admin-action">
                            Gerenciar Alunos
                        </a>
                        <a href="{{ route('turma.index') }}" class="admin-action">
                            Gerenciar Turmas
                        </a>
                        <a href="{{ route('disciplina.index') }}" class="admin-action">
                            Gerenciar Disciplinas
                        </a>
                        <a href="{{ route('alterarInformacao') }}" class="admin-action">
                            Alterar Informações
                        </a>
                        <a href="{{ route('atribuicaoprofessor.index') }}" class="admin-action">
                            Atribuir Professores
                        </a>
                        <a href="{{ route('atribuicaoaluno.index') }}" class="admin-action">
                            Atribuir Alunos
                        </a>
                    </div>
                </div>
            </div>
        @endif

        @if(auth()->user()->nivel_acesso === 'professor')
            <div class="second-grid-container py-12">
            <div class="max-w-8xl" style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    @if($turmas->isEmpty())
        <div style="height: 300px; display: flex; justify-content: center; align-items: center; text-align: center;">
            <p class="text-xl text-gray-600 dark:text-gray-300">Você não está atribuído a nenhuma turma.</p>
        </div>
                    @else
                        <div class="grid-container">
                            @foreach($turmas as $turma)
                                <a href="{{ route('turmaEspecifica', $turma->id) }}" class="turma-block">
                                    <h3 class="text-lg font-semibold">{{ $turma->nome }}</h3>
                                    <p class="text-gray-600 dark:text-gray-300">{{ $turma->descricao }}</p>
                               </a>
                            @endforeach
                         
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </main>

    @include('layouts._rodape')
</x-app-layout>
