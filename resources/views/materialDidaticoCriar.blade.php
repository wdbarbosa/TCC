<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                {{ __('Adicionar Material Didático - ') . $disciplina->nome_disciplina }}
        </h2>

    </x-slot>

    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('materiais.store', $disciplina->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" name="titulo" class="form-control" id="titulo" value="{{ old('titulo') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="conteudo">Conteúdo</label>
                            <textarea name="conteudo" class="form-control" id="conteudo" rows="3" required>{{ old('conteudo') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="playlist">Playlist</label>
                            <input type="text" name="playlist" class="form-control" id="playlist" value="{{ old('playlist') }}" required>
                        </div>
                            <button type="submit" class="btn btn-primary">Salvar Material Didático</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts._rodape')
</x-app-layout>
