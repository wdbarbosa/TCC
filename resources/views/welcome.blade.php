<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cursinho Primeiro de Maio</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style_welcome.css">
    <link rel="stylesheet" href="stylefooter.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        
        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                {{ $header }}
            </header>
        @endif

        @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <!-- Link de registro (opcional) -->
                    @endif
                @endauth
            </nav>
        @endif

        <main>
            <!--article Logo-->
            <article class="gridLogo">
                <fieldset>
                    <h3>Nossa Logo</h3>
                    @foreach ($registro as $info)
                        <img class="imgLogo" src="./img/primeirodemaio.png">
                    @endforeach
                </fieldset>
            </article>

            <!--article Informações (sobre o cursinho)-->
            <article class="gridInfos">
                <fieldset>
                    <h3>Informações</h3>
                    @foreach ($registro as $info)
                        <p>Sobre nós: {{ $info->infogeral }}</p>
                        <p>Endereço: {{ $info->endereco }}</p>
                        <p>Horário para atendimento: {{ $info->horario }}</p>
                    @endforeach
                </fieldset>
            </article>

            <!--article Inscricao-->
            <article class="gridInscricao">
                <fieldset>
                    <h3>Inscrições</h3>
                    @foreach ($registro as $info)
                        <p>Período de inscrição: {{$info->inicio_inscricao }} a {{ $info->fim_inscricao }}</p>
                    @endforeach
                </fieldset>
            </article>
        </main>

        <!--rodape-->
        @include('layouts._rodape')
    </div>
</body>

</html>
