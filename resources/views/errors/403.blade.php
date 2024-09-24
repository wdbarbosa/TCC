<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('styleerros.css') }}">
    <title>403 - Acesso restrito</title>
</head>
<body>
    <h1>ERROR 403</h1>
    <p>Acesso restrito.</p>
    <button>
        <a href="{{ url('/') }}">
            Voltar para a página inicial
        </a>
    </button>
</body>
</html>