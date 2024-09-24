<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('styleerros.css') }}">
    <title>419 - Página expirada</title>
</head>
<body>
    <h1>ERROR 419</h1>
    <p>A página que você está expirou.</p>
    <button>
        <a href="{{ url('/') }}">
            Voltar para a página inicial
        </a>
    </button>
</body>
</html>