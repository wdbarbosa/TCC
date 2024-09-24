<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('styleerros.css') }}">
    <title>500 - Erro interno do servidor</title>
</head>
<body>
    <h1>ERROR 500</h1>
    <p>Ocorreu um erro interno no servidor.</p>
    <button>
        <a href="{{ url('/') }}">
            Voltar para a página inicial
        </a>
    </button>
</body>
</html>