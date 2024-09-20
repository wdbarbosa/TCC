<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <link rel="stylesheet" href="{{ asset('stylefooter.css')}}">
    <link rel="stylesheet" href="{{ asset('/styleturmas.css') }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            {{ $turma->nome }} - Disciplinas
        </h2>
    </x-slot>

    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                    <ul>
                        @foreach($disciplinas as $disciplina)
                            <li class="mb-2">
                            <a href="{{ route('materiais.index', $disciplina->id) }}" class="text-lg font-semibold text-cyan-600 hover:text-cyan-700">
                                {{ $disciplina->nome_disciplina }}
                            </a>
                        </li>
                    @endforeach
            </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts._rodape')
</x-app-layout>

