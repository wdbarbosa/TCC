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
                        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-200 py-1 leading-tight text-center ">
                            {{ __('Editar Atribuição de Professor') }}
                        </h2>
                        <form action="{{ route('atribuicaoprofessor.atualizar', $atribuicao->id) }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <table class="w-full">
                                <tr>
                                    <td class="text-center">
                                        <strong>Turma:</strong> {{ $atribuicao->turma->nome }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <strong>Disciplina:</strong> {{ $atribuicao->disciplina->nome_disciplina }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <label for="fk_professor_users_id"><strong>Selecionar Professor:</strong></label>
                                        <select name="fk_professor_users_id" id="fk_professor_users_id" required>
                                            <option value="" disabled selected>Selecione um professor</option>
                                            @foreach ($professores as $professor)
                                                <option value="{{ $professor->fk_professor_users_id }}" 
                                                    {{ $professor->fk_professor_users_id == $atribuicao->fk_professor_users_id ? 'selected' : '' }}>                                                        {{ $professor->user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <div class="button-container">
                                <button type="submit" class="button">Atualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts._rodape')
</x-app-layout>
