<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Resumos</title>
        <meta charset="utf-8">
    </head>
    <body>
        <div class="superior">
            <h3>{{ $resumo->titulo }}</h3>
        </div>
        <div class="arquivo-resumo">
            <embed src="{{ asset('storage/' . $resumo->arquivo) }}" type="application/pdf" width="100%" height="100%">
        </div>
    </body>
</html>