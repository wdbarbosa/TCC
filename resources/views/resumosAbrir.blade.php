<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>{{ $resumo->titulo }}</title>
    <meta charset="utf-8">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
        }
        .superior {
            padding: 0.5rem;
            background: #f4f4f4;
            box-sizing: border-box;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            color: #096bac;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1;
        }
        .arquivo-resumo {
            margin-top: 2.5rem;
            height: calc(100vh - 2.5rem); 
            width: 100%;
            overflow: auto;
        }
        .pdf {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="superior">
        <h3>{{ $resumo->titulo }}</h3>
    </div>
    <div class="arquivo-resumo">
        <iframe class="pdf" src="{{ asset('storage/' . $resumo->arquivo) }}" frameborder="0"></iframe>
    </div>
</body>
</html>