<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
<x-slot name="header">
    <link rel="stylesheet" href="stylefooter.css">
    <link rel="stylesheet" href="stylealunosblade.css">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Alunos') }}
        </h2>
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
    </div>
</x-slot>

<main>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mb-4">Cadastros de Alunos</h2>
                    <table class="w-full border border-gray-200 rounded-lg shadow-lg"> <!-- Alterado para shadow-lg -->
                        <thead class="bg-[#6bb6c0] text-white">
                            <tr>
                                <th class="px-4 py-2">Nome</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Data de Nascimento</th>
                                <th class="px-4 py-2">CPF</th>
                                <th class="px-4 py-2">Telefone</th>
                                <th class="px-4 py-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $User)
                                @if($User->nivel_acesso === 'aluno')
                                    <tr>
                                        <td class="px-4 py-2">{{ $User->name }}</td>
                                        <td class="px-4 py-2">{{ $User->email }}</td>
                                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($User->data_nasc)->format('d/m/Y') }}</td>
                                        <td class="px-4 py-2">{{ $User->cpf }}</td>
                                        <td class="px-4 py-2">{{ $User->telefone }}</td>
                                        <td class="px-4 py-2">
                                            <a class="button bg-[#6bb6c0] text-white py-1 px-2 rounded hover:bg-[#8ab3b6]" href="/editar-aluno/{{ $User->id }}">Editar</a>
                                            <a class="button bg-[#6bb6c0] text-white py-1 px-2 rounded hover:bg-[#8ab3b6]" href="/excluir-aluno/{{ $User->id }}">Excluir</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <div class="button-container mt-4">
                        <a class="button bg-[#6bb6c0] text-white py-2 px-4 rounded hover:bg-[#8ab3b6]" href="/dashboard">Voltar</a>
                        <a class="button bg-[#6bb6c0] text-white py-2 px-4 rounded hover:bg-[#8ab3b6]" href="/adicionarAluno">Adicionar</a>
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


    table {
        border-collapse: collapse;
        width: 100%;
        background-color: #fff;
        border-radius: 0.375rem; 
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); 
    }

    thead th {
        background-color: #6bb6c0;
        color: white;
        padding: 0.75rem;
    }

    tbody tr:nth-child(even) {
        background-color: #f5f5f5; 
    }

    tbody tr:nth-child(odd) {
        background-color: #fff; 
    }

    tbody tr {
        border-bottom: 1px solid #ddd;
    }

    .button {
        display: inline-block;
        text-align: center;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .button-container {
        margin-top: 1rem;
    }
</style>

@include('layouts._rodape')
</x-app-layout>
