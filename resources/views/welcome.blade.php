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
    </head>

    <body>
        <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
            <div class="flex lg:justify-center lg:col-start-2">
            <svg  xmlns="http://www.w3.org/2000/svg">
                <image  width="140" height="140" xlink:href="\img\logoatual.png"/>
            </svg>
            </div>
            @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ri[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ri[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Log in
                        
                        @if (Route::has('register'))
                            <a
                                href="{{ route('register')}}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-nofocus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
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
            <h3>Nossa Logo</h3>
            @foreach ($registro as $info)
                <img class="imgLogo" src=" {{ $info->imagem }} ">
            @endforeach
        </article>

<<<<<<< HEAD
          <!--article Informações (sobre o cursinho)-->
          <article class="gridInfos"> 
          <h3>Informações</h3>
            @foreach ($registro as $info)
                <p>{{ $info->info_geral }}</p>
                <p>{{ $info->endereco }}</p>
            @endforeach    
          </article>
=======
                            </div>
                        </div>
                    </main>
<<<<<<< HEAD
                    <footer class="footer">
     <div class="container">
      <div class="row">
        <div class="footer-col">
        <h3>Informacoes</h3>
    @foreach ($registro as $info)
        <p>{{ $info->imagem }}</p>
        <p>{{ $info->info_geral }}</p>
        <p>{{ $info->endereco }}</p>
        <p>O periodo de inscricao vai de {{ $info->inicio_inscricao }} a {{ $info->fim_inscricao }}</p>
    @endforeach
    <p>beijos</p>
          <h4>Informações</h4>
          <ul>
            <li style="text-decoration: underline; color: white;"><a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox?compose=CllgCJlKpBbJbfzRjDSWnPFwScmpccfmSccHzKBhpLMDdHQsRCmwRQQFkntmzvfFKBrxJPFZPDq">cursinhoprimeirodemaio@gmail.com</a></li>
            <li><a href="#">telefone:   (14) 3103-6000</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Nossas redes sociais</h4>
          <div class="social-links">
            <a href="https://www.facebook.com/cursinhoprimeirodemaio/?locale=pt_BR"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/cursinhoprimeirodemaio/"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
        <div class="footer-col">
            <h4>Desenvolvedores -  SWILCOM </h4>
            <ul>
              <li><a href="#">Carlos Eduardo</a></li>
              <li><a href="#">Clara Vargas</a></li>
              <li><a href="#">Isabela Xavier</a></li>
              <li><a href="#">Lais Quintao</a></li>
              <li><a href="#">Maria Gabriela</a></li>
              <li><a href="#">Sofia Ayumi</a></li>
              <li><a href="#">Wendel Rafael</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <img src="./img/primeirodemaio.png">
          </div>
          <div class="footer-col">
            <h1>&copy; Copyright 2024 SWILCOM <h1>
          </div>
          
=======
                    @include('layouts._rodape')
                   
>>>>>>> 2c089022bf0e5592cf795174d975e98777dbee4e
>>>>>>> 3db15218f66229dbf51cb99d4114dc088acea901

          <!--article Inscricao-->
          <article class="gridInscricao">
            <h3>Inscrições</h3>
            @foreach ($registro as $info)
                <p>O periodo de inscricao vai de {{ $info->inicio_inscricao }} a {{ $info->fim_inscricao }}</p>
            @endforeach
          </article>
        </main>
        </main>

        <!--rodape-->
        @include('layouts._rodape')

    </body>
</html>