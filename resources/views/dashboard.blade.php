<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Painel de controle') }}
            </h2>

            <link rel="stylesheet" href="stylefooter.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

            @if(auth()->user()->nivel_acesso === 'admin')
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ação do Administrador
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="/professor">CRUD Professores</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/aluno">CRUD Alunos</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/turma">CRUD Salas</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Alterar Informações</a>
                    </div>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($turmas as $turma)
                    <a href="{{ route('turma') }}" class="block bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 transition duration-300 ease-in-out transform hover:scale-105">
                        <h3 class="text-lg font-semibold">{{ $turma->nome }}</h3>
                        <p class="text-gray-600 dark:text-gray-300">{{ $turma->descricao }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <style>
        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
            z-index: 1000;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu .dropdown-item {
            font-size: 14px;
            padding: 0.5rem 1rem;
            margin: 0.25rem 0;
        }

        .dropdown-menu .dropdown-item:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease-in-out;
        }

        .dropdown-divider {
            border-top: 1px solid #e5e7eb;
            margin: 0.5rem 0;
        }
    </style>

<footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
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
                    <h4>Desenvolvedores - SWILCOM</h4>
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
                    <img src="./img/primeirodemaio.png" width="90" height="90">
                </div>
                <div class="footer-col">
                    <h1>&copy; Copyright 2024 SWILCOM</h1>
                </div>
            </div>
        </div>
    </footer>

</x-app-layout>
