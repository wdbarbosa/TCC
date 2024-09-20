<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
    <link rel="stylesheet" href="{{ asset('/styleturmas.css') }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $turma->nome }} - Disciplinas
        </h2>
    </x-slot>

    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 justify-items-center">
                            @foreach($disciplinas as $disciplina)
                                <a href="{{ route('materiais.index', $disciplina->id) }}"
                                   class="text-lg font-semibold text-white bg-[#9dc8ce] hover:bg-[#6498a0] py-3 px-6 rounded-lg shadow-lg flex justify-center items-center" style="min-width: 200px; height: 60px;">
                                    {{ $disciplina->nome_disciplina }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts._rodape')
</x-app-layout>
