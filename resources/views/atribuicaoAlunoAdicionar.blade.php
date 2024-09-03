<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Atribuição de Turmas e Alunos') }}
        </h2>

        <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('styleturmas.css') }}">
</div>
    </x-slot>

    <main>
    <div class="py-12">
    
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-200 py-1 leading-tight text-center ">
                    {{ __('Adicionar Aluno') }}
                </h2>
                <div class="p-6 text-gray-900">
                    
                        <form action="{{ route('atribuicaoaluno.salvar') }}" method="POST">
                            {{ csrf_field() }}
                            <table class="w-full">
                                @foreach($alunos as $aluno)
                                    <tr>
                                        <td class="p-4" style="width: 60%; font-size: 1.125rem;"><b>Aluno: </b>{{ $aluno->user->name }}</td>
                                        <td class="p-2" style="width: 40%">
                                            <select name="turma[{{ $aluno->fk_aluno_users_id }}]" 
                                                class="block mt-1 w-full rounded-md"
                                                style="background-color: #f9f9f9; border: 2px solid #d1d5db;" 
                                                onfocus="this.style.borderColor='#66d6e3'" 
                                                onblur="this.style.borderColor='#d1d5db'"
                                                required>
                                                <option value="" disabled>Selecione uma turma:</option>
                                                @foreach($turmas as $turma)
                                                    <option value="{{ $turma->id }}">{{ $turma->nome }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="mt-6 flex justify-center">
                                <x-primary-button class="mt-6" style="display: block; margin: 0 auto; background-color: #05abd2; text-align: center;">
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
