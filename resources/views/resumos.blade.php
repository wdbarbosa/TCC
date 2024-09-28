<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
    <link rel="stylesheet" href="styleresumos.css">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Resumos') }}
        </h2>
    </x-slot>

    <main>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <a class="bg-[#6bb6c0] text-white py-2 px-4 rounded inline-block hover:bg-[#8ab3b6] transition duration-150" href="{{ route('resumo.adicionar') }}">
                            Adicionar resumo
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="filtro text-center">
                            <p class="titulo">Selecione a disciplina para buscar:</p>
                            <form action="{{ route('resumo.index') }}" method="get" class="flex items-center justify-center mt-2">
                                <select name="id_busca" class="form-select sm:rounded focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Todas as disciplinas</option>
                                    @foreach($disciplinas as $disciplina)
                                        <option value="{{ $disciplina->id }}" {{ request('id_busca') == $disciplina->id ? 'selected' : '' }}>
                                            {{ $disciplina->nome_disciplina }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="bg-[#6bb6c0] text-white py-2 px-4 rounded ml-3 hover:bg-[#8ab3b6] transition duration-150">
                                    Buscar
                                </button>
                            </form>
                        </div>  
                    </div>
                </div>
            </div>
        </div>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if($resumos->isEmpty())
                            <h3>Não há resumos aqui, adicione um!</h3>
                        @else
                            <div class="lista flex flex-wrap gap-6">
                                @foreach($resumos->sortByDesc('created_at') as $resumo)
                                    <div class="item bg-[#def2f5] overflow-hidden shadow-lg sm:rounded-lg p-4">
                                        <div class="imgPdf">
                                            <img class="imgPdf mb-2" src="{{ asset('img/simboloPDF.png') }}" width="150" height="150" alt="Primeiro de Maio">
                                        </div>

                                        <p class="titulo text-xl font-semibold">{{ $resumo->titulo }}</p>
                                        <p class="data-publicado text-gray-600 dark:text-gray-300">Publicado em: {{ \Carbon\Carbon::parse($resumo->datapublicado)->format('d/m/Y') }}</p>
                                        <p class="data-publicado text-gray-600 dark:text-gray-300">Disciplina: {{ $resumo->disciplina->nome_disciplina }}</p>
                                        @if($resumo->dataeditado)
                                            <p class="data-editado text-gray-600 dark:text-gray-300">Editado em: {{ \Carbon\Carbon::parse($resumo->dataeditado)->format('d/m/Y') }}</p>
                                        @endif
                                        <div class="acoes mt-4">
                                            <a href="{{ route('resumo.abrir', $resumo->id) }}" class="bg-[#6bb6c0] text-white py-2 px-4 rounded inline-block hover:bg-[#8ab3b6] transition duration-150" target="_blank">Abrir</a>
                                            <a href="{{ route('resumo.editar', $resumo->id) }}" class="bg-[#6bb6c0] text-white py-2 px-4 rounded inline-block hover:bg-[#8ab3b6] transition duration-150">Editar</a>
                                            <a href="{{ route('resumo.deletar', $resumo->id) }}" class="bg-[#6bb6c0] text-white py-2 px-4 rounded inline-block hover:bg-[#8ab3b6] transition duration-150">Apagar</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    @include('layouts._rodape')
</x-app-layout>
