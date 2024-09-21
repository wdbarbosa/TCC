<x-app-layout>
    @section('title', 'Materiais Didáticos - ' . $disciplina->nome_disciplina)

    <link rel="stylesheet" href="{{ asset('stylematerial.css') }}">

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            
                <a href="{{ route('turmaEspecifica', $turma->id) }}" class="mr-4" alt="Voltar"> <!--arrumar rota-->
                    <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
                </a>
                Materiais Didáticos - {{ $disciplina->nome_disciplina }}
            </h2>
            <a class="bg-[#9dc8ce] text-white py-2 px-4 rounded inline-block hover:bg-[#8ab3b6] transition duration-150" href="{{ route('materiais.criar', $disciplina->id) }}">
                Adicionar Questão
            </a>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="w-full max-w-4xl mx-auto container-materiais">
            <h3>Lista de Materiais Didáticos</h3>

            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($materiais->isEmpty())
                <p>Nenhum material cadastrado para esta disciplina.</p>
            @else
                <ul class="lista-materiais">
                    @foreach($materiais as $material)
                        <li>
                            <h4>{{ $material->titulo }}</h4>
                            <p>{{ $material->conteudo }}</p>
                            <p><strong>Playlist:</strong> {{ $material->playlist }}</p>

                            @if ($material->pdf)
                                <p><strong>PDF:</strong> <a href="{{ asset('storage/' . $material->pdf) }}" target="_blank">Baixar PDF</a></p>
                            @endif

                            @if ($material->slide)
                                <p><strong>Slide:</strong> <a href="{{ asset('storage/' . $material->slide) }}" target="_blank">Baixar Slide</a></p>
                            @endif

                            <a href="{{ route('materiais.editar', [$disciplina->id, $material->id]) }}">Editar</a>

                            <form action="{{ route('materiais.deletar', [$disciplina->id, $material->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Deletar</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>
