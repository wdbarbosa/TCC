<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,

initial-scale=1">

<title>Cursinho Primeiro de Maio</title>
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link

href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap"
rel="stylesheet" />

<link rel="stylesheet" href="style_welcome.css">
<link rel="stylesheet" href="stylefooter.css">
</head>
<body>
<header class="grid grid-cols-2 items-center gap-2 py-10

lg:grid-cols-3">

<div class="flex lg:justify-center lg:col-start-2">
<svg xmlns="http://www.w3.org/2000/svg">
<image width="140" height="140"

xlink:href="\img\logoatual.png"/>

</svg>
</div>
@if (Route::has('login'))
<nav class="-mx-3 flex flex-1 justify-end">
@auth
<a
href="{{ url('/dashboard') }}"
class="rounded-md px-3 py-2 text-black

ring-1 ring-transparent transition hover:text-black/70

focus:outline-none focus-visible:ri[#FF2D20] dark:text-white
dark:hover:text-white/80 dark:focus-visible:ring-white"

>
Dashboard
</a>
@else
<a
href="{{ route('login') }}"
class="rounded-md px-3 py-2 text-black

ring-1 ring-transparent transition hover:text-black/70
focus:outline-none focus-visible:ri[#FF2D20] dark:text-white
dark:hover:text-white/80 dark:focus-visible:ring-white"

>
Log in
@if (Route::has('register'))
<a
href="{{ route('register')}}"
class="rounded-md px-3 py-2 text-black

ring-1 ring-transparent transition hover:text-black/70
focus:outline-nofocus-visible:ring-[#FF2D20] dark:text-white
dark:hover:text-white/80 dark:focus-visible:ring-white"

>
Cadastrar
</a>
@endif
@endauth
</nav>
@endif
</header>
<main>
<!--article Logo-->
<article class="gridLogo">
<fieldset>
<h3>Nossa Logo</h3>
@foreach ($registro as $info)
<img class="imgLogo" src=" {{ $info->imagem }} ">
@endforeach
</fieldset>
</article>
<!--article Informações (sobre o cursinho)-->

<article class="gridInfos">
<fieldset>
<h3>Informações</h3>
@foreach ($registro as $info)
<p>{{ $info->info_geral }}</p>
<p>{{ $info->endereco }}</p>
@endforeach
</fieldset>
</article>
<!--article Inscricao-->
<article class="gridInscricao">
<fieldset>
<h3>Inscrições</h3>
@foreach ($registro as $info)
<p>O periodo de inscricao vai de {{
$info->inicio_inscricao }} a {{ $info->fim_inscricao }}</p>

@endforeach
</fieldset>
</article>
</main>
<!--rodape-->
@include('layouts._rodape')
</body>
</html>