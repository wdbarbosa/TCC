<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Resumos</title>
        <meta charset="utf-8">
    </head>
    <body>
        @include('layouts._cabecalho')
        <h2>Meus Resumos</h2>
        <div class="filtro">
            <form action="{{ route('resumo.index') }}" method="get">
                <p>Selecione a disciplina para busca</p>
                <select name="id_busca">
                    <option value="">Todas as disciplinas</option>
                    @foreach($disciplinas as $disciplina)
                        <option value="{{ $disciplina->id_disciplina }}">{{ $disciplina->descricao_disciplina }}</option>
                    @endforeach
                </select>
                <button type="submit" class="botao-buscar">Buscar</button>
            </form>
        </div>
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
        <div class="adicionar">
            <a href="{{ route('resumo.adicionar') }}" class="botao-adicionar">Adicionar<a>
        </div>
        @include('layouts._rodape')
    </body>
</html>