<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            <a href="{{ route('disciplinas') }}" class="mr-4" alt="Voltar">
                <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
            </a>
                {{ __($disciplina->nome_disciplina) }}
            </h2>
            <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
            <link rel="stylesheet" href="{{ asset('/styledisciplinaEspecifica.css') }}">
            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
            @vite(['resources/css/app.css', 'resources/js/app.js'])
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg"> 
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="turma-container">
                    <div class="turma-header">
                        <h2 class="turma-title"><strong>{{ __($disciplina->nome_disciplina) }}</strong></h2>
                        <p class="turma-description">{{ __($disciplina->disciplina_descricao) }}</p>
                    </div>
                    
                    <form action="{{ route('materiais.filtrar', $disciplina->id) }}" method="GET">
                        <div class="playlist-filter">
                            <label for="playlist">Filtrar por Playlist:</label>
                            <select name="playlist" id="playlist" class="form-select ml-1 sm:rounded focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Todas as Playlists</option>
                                @foreach($playlists as $playlist)
                                    <option value="{{ $playlist }}">{{ $playlist }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="bg-[#6bb6c0] text-white py-2 px-4 ml-1 rounded inline-block hover:bg-[#8ab3b6] transition duration-150">Filtrar</button>
                        </div>
                    </form>

            <div class="turma-content">
                <div class="turma-playlists">
                    <div class="titulo2">Materiais Didáticos:</div>

                    @if($materiais->isNotEmpty())
                        <div class="materiais-grid">
                            @foreach($materiais as $material)
                                <div class="material-item">
                                    <strong>{{ $material->titulo }}</strong>
                                    <p>Conteúdo: {{ $material->conteudo }}</p>
                                    
                                    @if($material->playlist)
                                        <p>Playlist: {{ $material->playlist }}</p>
                                    @endif

                                    @if($material->pdf)
                                    <p>PDF: <a href="{{ asset('TCC/public/' . $material->pdf) }}" target="_blank"><u>Ver PDF</u></a></p>
                                    @endif

                                    @if($material->slide)
                                    <p>Slide: <a href="{{ asset('TCC/public/' . $material->slide) }}" target="_blank"><u>Ver Slide</u></a></p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>Nenhum material didático disponível para esta disciplina.</p>
                    @endif
                </div>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>


    @include('layouts._rodape')
</x-app-layout>
