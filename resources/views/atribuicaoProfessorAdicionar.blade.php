<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
    <link rel="stylesheet" href="{{ asset('styleatribuicaoprof.css') }}">
    <x-slot name="header">      
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <a href="{{ route('atribuicaoprofessor.index') }}" class="mr-4" alt="Voltar">
                    <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
                </a>
            {{ __('Atribuição de Professores') }}
        </h2>
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
                                <table class="w-full">
                                    @foreach($disciplinas as $disciplina)
                                        <tr>
                                            <td class="font-bold">{{ $disciplina->nome_disciplina }}</td>
                                            <td>
                                                <label for="professor_{{ $disciplina->id }}">Selecione o professor:</label>
                                                <select class="dropbox block mt-1 w-full rounded-md" name="professor_id" id="professor_{{ $disciplina->id }}">
                                                    @foreach ($professores as $professor)
                                                        <option value="{{ $professor->fk_professor_users_id }}">
                                                            {{ $professor->user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="disciplina_id" value="{{ $disciplina->id }}">
                                            </td>
                                            <td>
                                                <label>Turmas:</label>
                                                <div>
                                                    @foreach ($turmas as $turma)
                                                        <label class="checkbox-custom">
                                                            <input type="checkbox" name="turmas[]" value="{{ $turma->id }}">
                                                            <span class="checkbox-circle"></span>
                                                            <span class="chackbox-text">{{ $turma->nome }}</span>
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
