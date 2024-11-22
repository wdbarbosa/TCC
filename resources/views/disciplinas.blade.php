<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Disciplinas') }}
            </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
    <link rel="stylesheet" href="{{ asset('styledisciplinas.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<main>
    <div class="grid-container py-9">
        @foreach($disciplina as $disciplina)
            <a href="{{ route('disciplinaEspecifica', $disciplina->id) }}" 
                class="turma-block">
                <h3 class="text-lg font-semibold">{{ $disciplina->nome_disciplina }}</h3>
                <p class="text-gray-600 dark:text-gray-300">{{ $disciplina->disciplina_descricao }}</p>
            </a>
        @endforeach
    </div>
</main>
@include('layouts._rodape')
</x-app-layout>
