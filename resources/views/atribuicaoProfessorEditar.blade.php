<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
        <link rel="stylesheet" href="{{ asset('styleatribuicaoprof.css') }}">
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
                        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-200 py-1 leading-tight text-center ">
                            {{ __('Editar Atribuição de Professor') }}
                        </h2>
                        <form action="{{ route('atribuicaoprofessor.atualizar', $atribuicao->id) }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">

                            <table class="w-full">
                                <tr>
                                    <td class="font-bold">{{ $atribuicao->disciplina->nome_disciplina }}
                                        <input type="hidden" name="fk_disciplina_id" value="{{ $atribuicao->disciplina->id }}">
                                    </td>
                                    <td>
                                        <label for="professor">Selecione o professor:</label>
                                        <select name="fk_professor_users_id" id="professor" class="dropbox block mt-1 w-full rounded-md" required>
                                            @foreach($professores as $professor)
                                                <option value="{{ $professor->fk_professor_users_id }}" 
                                                    {{ $professor->fk_professor_users_id == $atribuicao->fk_professor_users_id ? 'selected' : '' }}>
                                                    {{ $professor->user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>  
                                    <td>
                                        <label>Selecione a(s) turma(s):</label>
                                        <div>
                                            @foreach($turmas as $turma)
                                                <label class="checkbox-custom">
                                                    <input type="checkbox" name="turmas[]" value="{{ $turma->id }}" 
                                                    {{ $atribuicao->turmas->contains($turma->id) ? 'checked' : '' }}>
                                                    <span class="checkbox-circle"></span>
                                                    <span class="checkbox-text">{{ $turma->nome }}</span>
                                                </label>
                                            @endforeach
                                        </div>
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
