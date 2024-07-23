<x-app-layout>
    <!DOCTYPE html>
    <html lang="pt-br">
    <link rel="stylesheet" href="stylefooter.css">
        <body>
            <h2>Adicionar Resumo</h2>
            <div class="formulario">
                <form action="{{ route('resumo.salvar') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @include('resumosForm')
                    <button class="botao-salvar" type="submit">Adicionar</button>
                </form>
            </div>
        </body>
    </html>
    @include('layouts._rodape')
</x-app-layout>