<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <link rel="stylesheet" href="stylefooter.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="styleturmas.css">

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Home') }}
            </h2>   
        </div>
    </x-slot>

    <main>
        @if(auth()->user()->nivel_acesso === 'admin')
            <div class="admin-actions py-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight mb-4">Ações do Administrador</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <a href="{{ route('professores.index') }}" class="block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 transition duration-300 ease-in-out transform hover:scale-105">
                            Gerenciar Professores
                        </a>
                        <a href="{{ route('alunos.index') }}" class="block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 transition duration-300 ease-in-out transform hover:scale-105">
                            Gerenciar Alunos
                        </a>
                        <a href="{{ route('turma.show') }}" class="block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 transition duration-300 ease-in-out transform hover:scale-105">
                            Gerenciar Turmas
                        </a>
                        <a href="{{ route('disciplina.index') }}" class="block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 transition duration-300 ease-in-out transform hover:scale-105">
                            Gerenciar Disciplinas
                        </a>
                        <a href="{{ route('alterarInformacao') }}" class="block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 transition duration-300 ease-in-out transform hover:scale-105">
                            Alterar Informações
                        </a>
                        <a href="{{ route('atribuicaoprofessor.index') }}" class="block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 transition duration-300 ease-in-out transform hover:scale-105">
                            Atribuir Professores
                        </a>
                        <a href="{{ route('atribuicaoaluno.index') }}" class="block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 transition duration-300 ease-in-out transform hover:scale-105">
                            Atribuir Alunos
                        </a>
                    </div>
                </div>
            </div>
        @endif

        @if(auth()->user()->nivel_acesso === 'professor')
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">         
                        @foreach($turmas as $turma)
                            <a href="{{ route('turmaEspecifica', $turma->id) }}" class="block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 transition duration-300 ease-in-out transform hover:scale-105 turma-block">
                                <h3 class="text-lg font-semibold">{{ $turma->nome }}</h3>
                                <p class="text-gray-600 dark:text-gray-300">{{ $turma->descricao }}</p>
                            </a>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </main>

    <style>
        .admin-actions a {
            display: block;
            text-align: center;
            background-color: #f7fafc;
            color: #1a202c;
            border-radius: 8px;
            font-weight: bold;
            padding: 20px;
            text-decoration: none;
            transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out;
        }

        .admin-actions a:hover {
            transform: scale(1.05);
            background-color: #edf2f7;
        }

        .turma-block {
            word-wrap: break-word;
        }
    </style>
     @include('layouts._rodape')
</x-app-layout>
