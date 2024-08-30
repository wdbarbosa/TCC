<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
<x-slot name="header">
    <link rel="stylesheet" href="stylefooter.css">
    <link rel="stylesheet" href="stylealunosblade.css">
    <div class="flex justify-between items-center">
    <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Professores') }}
    </h1>
    @if(auth()->user()->nivel_acesso === 'admin')
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ação do Administrador
                    </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="/professor">Gerenciar Professores</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/aluno">Gerenciar Alunos</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/turma">Gerenciar Turmas</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/disciplina">Gerenciar Disciplinas</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/alterarInformacao">Alterar Informações</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('atribuicaoprofessor.index') }}">Atribuir Professores</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('atribuicaoaluno.index') }}">Atribuir Alunos</a>
                        </div>
                </div>
        @endif
</x-slot>
<main>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mb-4">Cadastros de Professores</h2>
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Data de Nascimento</th>
                                <th>CPF</th>
                                <th>Telefone</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($user as $user): ?>
                                <?php if($user->nivel_acesso === 'professor'): ?>
                                    <tr>
                                        <td><?php echo $user->name; ?></td>
                                        <td><?php echo $user->email; ?></td>
                                        <td><?php echo \Carbon\Carbon::parse($user->data_nasc)->format('d/m/Y'); ?></td>
                                        <td><?php echo $user->cpf; ?></td>
                                        <td><?php echo $user->telefone; ?></td>
                                        <td>
                                            <a class="button" href="/editar-professor/<?php echo $user->id; ?>">Editar</a>
                                            <a class="button" href="/excluir-professor/<?php echo $user->id; ?>">Excluir</a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="button-container"> <!-- Ajusta o alinhamento e o espaçamento dos botões -->
                        <a class="button" href="/dashboard">Voltar</a>
                        <a class="button" href="/adicionarProfessor">Adicionar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
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
@include('layouts._rodape')
</x-app-layout>
