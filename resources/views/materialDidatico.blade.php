<x-app-layout>
    @section('title', 'Materiais Didáticos - ' . $disciplina->nome)

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Materiais Didáticos - {{ $disciplina->nome_disciplina }}
            </h2>
            <a href="{{ route('materiais.criar', $disciplina->id) }}" class="text-cyan-600 hover:text-cyan-700">Adicionar Material</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="w-full max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-2xl font-semibold mb-4 text-gray-800">Lista de Materiais Didáticos</h3>

            @if (session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($materiais->isEmpty())
                <p>Nenhum material cadastrado para esta disciplina.</p>
            @else
                <ul>
                    @foreach($materiais as $material)
                        <li class="mb-4">
                            <h4 class="text-lg font-semibold">{{ $material->titulo }}</h4>
                            <p>{{ $material->conteudo }}</p>
                            <p><strong>Playlist:</strong> {{ $material->playlist }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>
