<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <a href="{{ route('atribuicaoaluno.index') }}" class="mr-4" alt="Voltar">
                    <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
                </a>
            {{ __('Atribuição de Turmas e Alunos') }}
        </h2>

        <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('styleatribuicaoaluno.css') }}">
</div>
    </x-slot>

    <main>
    <div class="py-12">
    
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                        <form action="{{ route('atribuicaoaluno.salvar') }}" method="POST">
                            {{ csrf_field() }}
                            <table class="table-aluno">
                                <thead>
                                    <tr>
                                        <th class="aluno">Aluno</th>
                                        <th class="turma">Turma</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alunos as $aluno)
                                        <tr>
                                            <td class="aluno">{{ $aluno->user->name }}</td>
                                            <td class="turma">
                                                <select name="turma[{{ $aluno->fk_aluno_users_id }}]" 
                                                    class="select-turma" 
                                                    required>
                                                    <option value="" disabled>Selecione uma turma:</option>
                                                    @foreach($turmas as $turma)
                                                        <option value="{{ $turma->id }}">{{ $turma->nome }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="button-container mt-6 flex justify-center">
                                <x-primary-button class="button-adicionar">
                                    {{ __('Adicionar') }}
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
