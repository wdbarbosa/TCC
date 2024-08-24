<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
<link rel="stylesheet" href="stylefooter.css">
<link rel="stylesheet" href="styleresumos.css">
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Resumos') }}
    </h2>
</x-slot>
<!DOCTYPE html>
<html lang="pt-br">
    <body>
        <main>
            <div class="py-6"> 
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <a class="bg-[#9dc8ce] text-white py-2 px-4 rounded inline-block hover:bg-[#8ab3b6] transition duration-150" href="{{ route('resumo.adicionar') }}">
                                Adicionar resumo
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-6"> 
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="filtro">
                                <form action="{{ route('resumo.index') }}" method="get">
                                    <p class="titulo" style="font-size: larger; margin-top: 1%; margin-bottom: 1%;">Selecione a disciplina para buscar:</p>
                                    <select name="id_busca" style="border-radius: 8px; padding: 8px; border: 1px solid #ccc; background-color: #fff; font-size: 1rem; margin-right: 5px; width: 200px;">
                                        <option value="">Todas as disciplinas</option>
                                        @foreach($disciplinas as $disciplina)
                                            <option value="{{ $disciplina->id }}" {{ request('id_busca') == $disciplina->id ? 'selected' : '' }}>
                                                {{ $disciplina->nome_disciplina }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="bg-[#9dc8ce] text-white py-2 px-4 rounded inline-block hover:bg-[#8ab3b6] transition duration-150" style="margin-left: 5px; padding: 8px 16px;">
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
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">                       
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            @if($resumos->isEmpty())
                                <h3>Não há resumos aqui, adicione um!</h3>
                            @else
                                <div class="lista">
                                    @foreach($resumos as $resumo)
                                        <div class="item">
                                            <img src="miniatura" alt="Miniatura do resumo">
                                            <p class="titulo">{{ $resumo->titulo }}</p>
                                            <p class="data-publicado">Publicado em: {{ \Carbon\Carbon::parse($resumo->datapublicado)->format('d/m/Y') }}</p>
                                            @if($resumo->dataeditado)
                                                <p class="data-editado">Editado em: {{ \Carbon\Carbon::parse($resumo->dataeditado)->format('d/m/Y') }}</p>
                                            @endif
                                            <div class="acoes">
                                                <a href="{{ route('resumo.abrir', $resumo->id) }}" class="bg-[#9dc8ce] text-white py-2 px-4 rounded inline-block hover:bg-[#8ab3b6] transition duration-150" target="_blank">Abrir</a>
                                                <a href="{{ route('resumo.editar', $resumo->id) }}" class="bg-[#9dc8ce] text-white py-2 px-4 rounded inline-block hover:bg-[#8ab3b6] transition duration-150">Editar</a>
                                                <a href="{{ route('resumo.deletar', $resumo->id) }}" class="bg-[#9dc8ce] text-white py-2 px-4 rounded inline-block hover:bg-[#8ab3b6] transition duration-150">Apagar</a>
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
    </body>
</html>
</x-app-layout>
