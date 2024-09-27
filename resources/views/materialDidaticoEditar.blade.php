<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
    <link rel="stylesheet" href="{{ asset('styleformmaterial.css') }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            <a href="{{ route('materiais.index', ['id' => $disciplina->id, 'turmaId' => $turma->id]) }}" class="mr-4" alt="Voltar">
                <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
            </a>
            {{ __('Editar Material') }}
        </h2>
    </x-slot>

    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('materiais.atualizar', [$disciplina->id, $material->id, $turma->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <label for="titulo">Título</label>
                            <input type="text" name="titulo" value="{{ $material->titulo }}">
        
                            <label for="conteudo">Conteúdo</label>
                            <textarea name="conteudo" style="height: 150px; resize: none;">{{ $material->conteudo }}</textarea>
        
                            <label for="playlist">Playlist</label>
                            <input type="text" name="playlist" value="{{ $material->playlist }}">

                            <label for="pdf">PDF</label>
                            <input type="file" name="pdf">
                                @if ($material->pdf)
                                    <p>Arquivo atual: <a href="{{ asset('storage/'.$material->pdf) }}" target="_blank">{{ $material->pdf }}</a></p>
                                @else
                                    <p>Nenhum PDF adicionado ainda.</p>
                                @endif

                            <label for="slide">Slide (PPT/PPTX)</label>
                            <input type="file" name="slide">
                                @if ($material->slide)
                                    <p>Arquivo atual: <a href="{{ asset('storage/'.$material->slide) }}" target="_blank">{{ $material->slide }}</a></p>
                                @else
                                    <p>Nenhum slide adicionado ainda.</p>
                                @endif
                            <button type="submit">Atualizar Material</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts._rodape')
</x-app-layout>
