<x-app-layout>
<x-slot name="header">
        <link rel="stylesheet" href="stylefooter.css">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Resumos') }}
            </h2>
    </x-slot>
    <!DOCTYPE html>
    <html lang="pt-br">
        <body>
            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h2>Meus Resumos</h2>
                                <div class="filtro">
                                    <form action="{{ route('resumo.index') }}" method="get">
                                        <p>Selecione a disciplina para busca</p>
                                        <select name="id_busca">
                                            <option value="">Todas as disciplinas</option>
                                            @foreach($disciplinas as $disciplina)
                                                <option value="{{ $disciplina->id_disciplina }}" {{ request('id_busca') == $disciplina->id_disciplina ? 'selected' : '' }}>
                                                    {{ $disciplina->disciplina_descricao }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="botao-buscar">Buscar</button>
                                    </form>
                                </div>
                                @if($resumos ->isEmpty())
                                    <h3>Não há resumos aqui, adicione um!!</h3>
                                @else
                                    <div class="lista">
                                        @foreach($resumos as $resumo)
                                            <div class="item">
                                                <img src="miniatura" alt="Miniatura do resumo">
                                                <p class="titulo">{{ $resumo->titulo }}</p>
                                                <p class="data-publicado">Publicado em: {{ $resumo->datapublicado }}</p>
                                                @if($resumo->dataeditado)
                                                    <p class="data-editado">Editado em: {{ $resumo->dataeditado }}</p>
                                                @endif
                                                <div class="acoes">
                                                    <a href="{{ route('resumo.abrir', $resumo->id_resumo) }}" class="botao botao-abrir" target="_blank">Abrir</a>
                                                    <a href="{{ route('resumo.editar', $resumo->id_resumo) }}" class="botao botao-editar">Editar</a>
                                                    <a href="{{ route('resumo.deletar', $resumo->id_resumo) }}" class="botao botao-deletar">Apagar</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="adicionar">
                                    <a href="{{ route('resumo.adicionar') }}" class="botao-adicionar">Adicionar<a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('layouts._rodape')
        </body>
    </html>
</x-app-layout>
