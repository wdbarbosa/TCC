<x-app-layout>
    @section('title', 'Materiais Didáticos - ' . $disciplina->nome_disciplina)

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

                        @if ($material->pdf)
                            <p><strong>PDF:</strong> <a href="{{ asset('storage/' . $material->pdf) }}" class="text-blue-600 hover:text-blue-700" target="_blank">Baixar PDF</a></p>
                        @endif

                        @if ($material->slide)
                            <p><strong>Slide:</strong> <a href="{{ asset('storage/' . $material->slide) }}" class="text-blue-600 hover:text-blue-700" target="_blank">Baixar Slide</a></p>
                        @endif

                        <a href="{{ route('materiais.editar', [$disciplina->id, $material->id]) }}" class="text-blue-600 hover:text-blue-700">Editar</a>

                        <form action="{{ route('materiais.deletar', [$disciplina->id, $material->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700">Deletar</button>
                        </form>
                    </li>
                @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>
