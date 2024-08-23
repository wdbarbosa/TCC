<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="stylewelcome.css">
    <link rel="stylesheet" href="stylefooter.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <x-slot name="header">
        <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Informações') }}
        </h2>
    </x-slot>

    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <body>
            <main class="mainColunas">
                <article class="gridLogo">
                    <fieldset>
                        <h3 class="titulo">Nossa Logo</h3>
                        @foreach ($informacao as $info)
                            <img class="imgLogo" src="./img/primeirodemaio.png">
                        @endforeach
                    </fieldset>
                </article>

                <article class="gridInfos">
                    <fieldset>
                        <h3 class="titulo">Informações</h3>
                        @foreach ($informacao as $info)
                            <p>Sobre nós: {{ $info->infogeral }}</p>
                            <p>Endereço: {{ $info->endereco }}</p>
                            <p>Horário para atendimento: {{ $info->horario }}</p>
                            @endforeach
                        </fieldset>
                    </article>

                <article class="gridInscricao">
                    <fieldset>
                        <h3 class="titulo">Inscrições</h3>
                        @foreach ($informacao as $info)
                            <p>Período de inscrição: {{\Carbon\Carbon::parse($info->inicio_inscricao)->format('d/m/Y')}} a {{ \Carbon\Carbon::parse($info->fim_inscricao)->format('d/m/Y') }}</p>
                        @endforeach
                    </fieldset>
                </article>
            </main>
            @include('layouts._rodape')
        </body>
    </html>
</x-app-layout>