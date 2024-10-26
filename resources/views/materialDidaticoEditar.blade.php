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
        <div class="py-12 flex justify-center">
            <div class="w-full max-w-2xl bg-white border border-gray-200 rounded-lg shadow-lg p-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('materiais.atualizar', [$disciplina->id, $material->id, $turma->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <label for="titulo">Título</label>
                            <input class="mt-1 block w-full border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm" type="text" name="titulo" value="{{ $material->titulo }}">
        
                            <label for="conteudo">Conteúdo</label>
                            <textarea class="mt-1 block w-full border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm" name="conteudo">{{ $material->conteudo }}</textarea>
        
                            <label for="playlist">Playlist</label>
                            <input class="mt-1 block w-full border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm" type="text" name="playlist" value="{{ $material->playlist }}">

                            <label for="pdf">PDF</label>
                            <input type="file" name="pdf">
                                @if ($material->pdf)
                                    <pclass="text-gray-600">Arquivo atual: <u><a href="{{ asset('storage/'.$material->pdf) }}" target="_blank">{{ $material->pdf }}</a></u></p>
                                @else
                                    
                                @endif

                            <label class="mt-4" for="slide">Slide (PPT/PPTX)</label>
                            <input type="file" name="slide">
                                @if ($material->slide)
                                    <p class="text-gray-600">Arquivo atual: <u><a href="{{ asset('storage/'.$material->slide) }}" target="_blank">{{ $material->slide }}</a></u></p>
                                @else
                                    
                                @endif
                                <div class="flex justify-center mt-2">
                                    <button type="submit" class="bg-[#6bb6c0] text-white px-4 py-2 rounded-lg shadow hover:bg-[#8ab3b6]">
                                        Atualizar Material
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts._rodape')
</x-app-layout>
