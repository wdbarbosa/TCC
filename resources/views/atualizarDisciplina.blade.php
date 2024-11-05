<x-app-layout>
    
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <a href="{{ route('atribuicaoaluno.index') }}" class="mr-4" alt="Voltar">
                    <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
                </a>
                {{ __('Disciplinas') }}
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
    {{ __('Atualizar Disciplina') }}
</h2>
<hr>
    <form method="POST" action="/atualizar-disciplina/{{ $disciplina->id }}">
        @csrf
        @method('PUT')

        <div>
            <x-input-label class="mt-4" for="nome_disciplina" :value="__('Nome:')" />
            <x-text-input id="nome_disciplina" class="block mt-1 w-full" type="text" name="nome_disciplina" :value="$disciplina->nome_disciplina" required autofocus />
            <x-input-error :messages="$errors->get('nome_disciplina')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="disciplina_descricao" :value="__('Descrição:')" />
            <textarea id="disciplina_descricao" class="focus:outline-none border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 block mt-1 w-full border rounded-lg" name="disciplina_descricao" required autofocus>{{$disciplina->disciplina_descricao}}</textarea>
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
