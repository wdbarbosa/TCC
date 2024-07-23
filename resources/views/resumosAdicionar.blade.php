<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Resumos</title>
        <meta charset="utf-8">
    </head>
    <body>
        @include('layouts._cabecalho')
        <h2>Adicionar Resumo</h2>
        <div class="formulario">
            <form action="{{ route('resumo.salvar') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include('resumosForm')
                <button class="botao-salvar" type="submit">Adicionar</button>
            </form>
        </div>
        @include('layouts._rodape')
    </body>
</html>