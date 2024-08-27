<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Disciplinas') }}
            </h2>
    </x-slot>

    <link rel="stylesheet" href="stylefooter.css">
    <link rel="stylesheet" href="styledisciplinas.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<main>
    <div class="grid-container py-12">
                    @foreach($disciplina as $disciplina)
                     <a href="{{ route('disciplinaEspecifica', $disciplina->id) }}" 
                    class="block bg-white dark:bg-gray-800 overflow-hidden gap-100 shadow-sm sm:rounded-lg p-6 transition duration-300 ease-in-out transform hover:scale-105 turma-block"
                    style="border: 3px solid #9dc8ce; border-radius: 10px; color: #333; margin:5%">
                     <h3 class="text-lg font-semibold">{{ $disciplina->nome_disciplina }}</h3>
                     <p class="text-gray-600 dark:text-gray-300">{{ $disciplina->disciplina_descricao }}</p>
                    </a>
                @endforeach
    </div>
</main>
     @include('layouts._rodape')
</x-app-layout>
