<x-app-layout>
    @section('title', 'Disciplinas - ' . $turma->nome) 

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <a href="{{ route('turmaEspecifica', $turma->id) }}" class="text-cyan-600 hover:text-cyan-600">
                    <i class="fas fa-arrow-left"></i> 
                </a>
                {{ $turma->nome }} - Disciplinas
            </h2>
        </div>
    </x-slot>

    <div class="py-12 flex justify-center items-center bg-gray-100 min-h-screen">
        <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-2xl font-semibold mb-4 text-gray-800">Disciplinas</h3>
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
</x-app-layout>
