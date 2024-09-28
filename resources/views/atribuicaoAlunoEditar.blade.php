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
            <link rel="stylesheet" type="text/css" href="{{ asset('styleturmas.css') }}">
        </div>
        </x-slot>
<main>
    <div class="py-12 flex justify-center">
        <div class="w-full max-w-2xl bg-white border border-gray-200 rounded-lg shadow-lg p-8"> 
            <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-200 py-4 leading-tight text-center ">
                {{ __('Atualizar Aluno') }}
            </h2>
            <hr>
            <div class="mb-6">
                <p class="text-gray-800 font-semibold text-lg mt-4">{{ __('Aluno:') }} 
                    <span class="font-normal text-lg">{{ $aluno->user->name }}</span>
                </p>
                <p class="text-gray-800 font-semibold text-lg mt-2">{{ __('Matrícula:') }} 
                    <span class="font-normal text-lg">{{ $aluno->matricula }}</span>
                </p>
            </div>

            <form action="{{ route('atribuicaoaluno.atualizar', $aluno->fk_aluno_users_id) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="put">

                <!-- Campo Turma -->
                <div class="mb-6">
                    <x-input-label for="turma" :value="__('Turma:')" />
                    <select id="turma" name="turma" 
                    class="block mt-1 w-full rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                        <option value="" disabled>Selecione uma turma:</option>
                        @foreach($turmas as $turma)
                            <option value="{{ $turma->id }}" {{ $aluno->fk_turma_id == $turma->id ? 'selected' : '' }}>
                                {{ $turma->nome }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('turma')" class="mt-2" />
                </div>

                <div class="flex justify-center mt-6">
                    <x-primary-button>
                        {{ __('Atualizar') }}
                    </x-primary-button>
            </form>
        </div>
    </div>
</main>
    @include('layouts._rodape')
</x-app-layout>
