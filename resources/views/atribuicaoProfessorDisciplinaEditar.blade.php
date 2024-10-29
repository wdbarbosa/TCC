<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
        <link rel="stylesheet" href="{{ asset('styleatribuicaoprofdisci.css') }}">
        <link rel="stylesheet" href="{{ asset('stylefuncaoadmin.css') }}">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <a href="{{ route('atribuicaoprofessordisciplina.index') }}" class="mr-4" alt="Voltar">
                    <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
                </a>
            {{ __('Atribuição de Professores e Disciplinas') }}
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
                            {{ __('Editar Atribuição de Professores e Disciplinas') }}
                        </h2>
                        <form action="{{ route('atribuicaoprofessordisciplina.atualizar', $atribuicao->id) }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">
                            <table class="w-full">
                                <tr>
                                    <td class="font-bold">{{ $atribuicao->professor->user->name }}
                                        <input type="hidden" name="fk_professor_users_id" value="{{ $atribuicao->professor->fk_professor_users_id }}">
                                    </td>  
                                    <td>
                                        <label>Selecione a(s) disciplinas(s):</label>
                                        <div>
                                            @foreach($disciplinas as $disciplina)
                                                <label class="checkbox-custom">
                                                    <input type="checkbox" name="disciplinas[]" value="{{ $disciplina->id }}" 
                                                    {{ in_array($disciplina->id, $disciplinasAtuais) ? 'checked' : '' }}>
                                                    <span class="checkbox-circle"></span>
                                                    <span class="checkbox-text">{{ $disciplina->nome_disciplina }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div class="flex justify-center mt-5">
                                <x-primary-button>
                                    {{ __('Atualizar') }}
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
