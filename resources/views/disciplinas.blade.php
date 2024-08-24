<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Disciplinas') }}
            </h2>
    </x-slot>

    <link rel="stylesheet" href="stylefooter.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-10 lg:px-10">
            <div class="grid grid-cols-6 sm:grid-cols-6 md:grid-cols-6 lg:grid-cols-6 gap-1 ">

                @foreach($disciplina as $disciplina)
                <a href="{{ route('disciplinaEspecifica', $disciplina->id) }}" 
   class="block bg-white dark:bg-gray-800 overflow-hidden gap-100 shadow-sm sm:rounded-lg p-6 transition duration-300 ease-in-out transform hover:scale-105 turma-block"
   style="border: 3px solid #9dc8ce; border-radius: 10px; color: #333; ">
    <h3 class="text-lg font-semibold">{{ $disciplina->nome_disciplina }}</h3>
    <p class="text-gray-600 dark:text-gray-300">{{ $disciplina->disciplina_descricao }}</p>
</a>

                    <br>
                @endforeach
               
            </div>
        </div>
    </div>


    <style>
        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
            z-index: 1000;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu .dropdown-item {
            font-size: 14px;
            padding: 0.5rem 1rem;
            margin: 0.25rem 0;
        }

        .dropdown-menu .dropdown-item:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease-in-out;
        }

        .dropdown-divider {
            border-top: 1px solid #e5e7eb;
            margin: 0.5rem 0;
        }
        .turma-block {
            word-wrap: break-word;
        }
    </style>
     @include('layouts._rodape')
</x-app-layout>
