<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Inclua o CSS externo -->
    <link rel="stylesheet" href="stylewelcome.css">
    <link rel="stylesheet" href="stylefooter.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Informações') }}
            </h2>
        </div>
    </x-slot>

    <body>
        <main class="mainColunas">
            <article class="gridLogo">
                <fieldset>
                    <h3 class="titulo">Localização</h3>
                    <hr>
                    <!-- Substitua a imagem da logo pelo mapa -->
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14652.735445711595!2d-49.045832!3d-22.3492301!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x840e2d98630bb946!2sPrimeiro%20de%20Maio%20cursinho%20-%20FEB!5e0!3m2!1spt-BR!2sbr!4v1632266112876!5m2!1spt-BR!2sbr" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </fieldset>
            </article>

            <article class="gridInfos">
                <fieldset>
                    <h3 class="titulo">Informações</h3>
                        <p class="dentro">{{ $informacao->infogeral }}</p>
                        <p class="dentro">Endereço: {{ $informacao->endereco }}</p>
                        <p class="dentro">Horário para atendimento: {{ $informacao->horario }}</p>
                </fieldset>
            </article>

            <article class="gridInscricao">
                <fieldset>
                    <h3 class="titulo">Inscrições</h3>
                    <p class="dentro">Período de inscrição: {{ \Carbon\Carbon::parse($informacao->inicio_inscricao)->format('d/m/Y') }} a {{ \Carbon\Carbon::parse($informacao->fim_inscricao)->format('d/m/Y') }}</p>
                </fieldset>
            </article>
        </main>
        @include('layouts._rodape')
    </body>
</x-app-layout>
