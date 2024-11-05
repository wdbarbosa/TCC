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
                            {{ __('Adicionar Atribuição de Professores e Disciplinas') }}
                        </h2>
                            <form action="{{ route('atribuicaoprofessordisciplina.salvar') }}" method="POST">
                                {{ csrf_field() }}
                                <table class="w-full">
                                    @foreach($professores as $professor)
                                        <tr>
                                            <td class="font-bold">{{ $professor->user->name }}</td>
                                            <td>
                                                <input type="hidden" name="professores[]" value="{{ $professor->fk_professor_users_id }}">
                                                <label>Disciplinas:</label>
                                                <div>
                                                    @foreach ($disciplinas as $disciplina)
                                                        <label class="checkbox-custom">
                                                        <input type="checkbox" name="disciplinas[{{ $professor->fk_professor_users_id }}][]" value="{{ $disciplina->id }}">
                                                            <span class="checkbox-circle"></span>
                                                            <span class="chackbox-text">{{ $disciplina->nome_disciplina }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
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