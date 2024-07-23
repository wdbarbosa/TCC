<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Resumos</title>
        <meta charset="utf-8">
    </head>
    <body>
        @include('layouts._cabecalho')
        <h2>Editar Resumo</h2>
        <div class="formulario">
            <form action="{{ route('resumo.atualizar', $resumo->id_resumo) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                @include('resumosForm')
                <button type="submit" class="botao-editar">Editar</button>
            </form>
        </div>
        @include('layouts._rodape')
    </body>
</html>