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
                        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-200 py-1 leading-tight text-center">
                            {{ __('Adicionar Atribuição de Professor') }}
                        </h2>
                        <form action="{{ route('atribuicaoprofessor.salvar') }}" method="POST">
                            @csrf               
                            @foreach($turmas as $turma)
                                <div class="turma-section my-6">
                                    <h3 class="font-semibold text-lg text-gray-700 dark:text-gray-300 py-2">{{ $turma->nome }}</h3>

                                    <table class="table table-bordered w-full">
                                        <thead>
                                            <tr class="bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                                                <th class="p-2">Disciplina</th>
                                                <th class="p-2">Professor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($turma->disciplinas as $disciplina)
                                            <tr>
                                                <td>{{ $disciplina->nome_disciplina }}</td>
                                                <td>
                                                    <select name="atribuicoes[{{ $turma->id }}][{{ $disciplina->id }}][fk_professor_users_id]" class="form-select">
                                                        <option value="" disabled>Selecione um professor</option>
                                                        @foreach($disciplina->professores as $professor)
                                                            <option value="{{ $professor->fk_professor_users_id }}"
                                                                @if(isset($disciplina->atribuicao) && $disciplina->atribuicao->fk_professor_users_id == $professor->fk_professor_users_id)
                                                                    selected
                                                                @endif>
                                                                {{ $professor->user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach

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
