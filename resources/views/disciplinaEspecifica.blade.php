<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __($disciplina->nome_disciplina) }}
            </h2>
            <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
            <link rel="stylesheet" href="{{ asset('/styledisciplinaEspecifica.css') }}">
            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
            @vite(['resources/css/app.css', 'resources/js/app.js'])
    </x-slot>

    <div class="py-12">
        <div class="sidebar-widget">
            <h3 class="widget-title">Informações da Disciplina</h3>
        </div>

        <div class="turma-container">
            <div class="turma-header">
                <h2 class="turma-title">{{ __($disciplina->nome_disciplina) }}</h2>
                <p class="turma-description">{{ __($disciplina->disciplina_descricao) }}</p>
            </div>

            <form action="{{ route('materiais.filtrar', $disciplina->id) }}" method="GET">
                        <div class="playlist-filter">
                            <label for="playlist">Filtrar por Playlist:</label>
                            <select name="playlist" id="playlist" class="form-select">
                                <option value="">Todas as Playlists</option>
                                @foreach($playlists as $playlist)
                                    <option value="{{ $playlist }}">{{ $playlist }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </div>
                    </form>

            <div class="turma-content">
                <div class="turma-playlists">
                    <h3>Materiais Didáticos</h3>

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
                                    <p>PDF: <a href="{{ asset('storage/'.$material->pdf) }}" target="_blank">Ver PDF</a></p>
                                    @endif

                                    @if($material->slide)
                                    <p>Slide: <a href="{{ asset('storage/'.$material->slide) }}" target="_blank">Ver Slide</a></p>
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

    @include('layouts._rodape')
</x-app-layout>
