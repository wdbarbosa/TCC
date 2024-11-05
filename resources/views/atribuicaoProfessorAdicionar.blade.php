<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
        <link rel="stylesheet" href="{{ asset('styleatribuicaoprof.css') }}">
        <link rel="stylesheet" href="{{ asset('stylefuncaoadmin.css') }}">
        <div class="flex justify-between items-center">    
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <a href="{{ route('atribuicaoprofessor.index') }}" class="mr-4" alt="Voltar">
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
                            {{ __('Adicionar Atribuição de Professor') }}
                        </h2>
                            <form action="{{ route('atribuicaoprofessor.salvar') }}" method="POST">
                                {{ csrf_field() }}
                                @foreach($turmas as $turma)
                                <div class="turma-section">
                                    <h3 class="font-semibold text-lg text-gray-700 dark:text-gray-300 py-2">{{ $turma->nome }}</h3>

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Turma</th>
                                                <th>Disciplina</th>
                                                <th>Professor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($turma->disciplinas as $disciplina)
                                                <tr>
                                                    <td>{{ $turma->nome }}</td>
                                                    <td>{{ $disciplina->nome_disciplina }}</td>
                                                    <td>
                                                        <select name="atribuicoes[{{ $turma->id }}][{{ $disciplina->id }}][fk_professor_users_id]" class="sm:rounded focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                                                            <option value="">Selecione um professor</option>
                                                            @foreach($disciplina->professores as $professor)
                                                                <option value="{{ $professor->fk_professor_users_id }}">{{ $professor->user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                            <input type="hidden" name="fk_turma_id" value="{{ $turma->id }}">
                            <div class="flex justify-center mt-4">
                                <x-primary-button>
                                    {{ __('Salvar') }}
                                </x-primary-button>
                            </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layouts._rodape')
</x-app-layout>