<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')

<x-slot name="header">
    <link rel="stylesheet" href="stylefooter.css">
    <link rel="stylesheet" href="stylealunosblade.css">
    <link rel="stylesheet" href="stylefuncaoadmin.css">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            <a href="{{ route('dashboard') }}" class="mr-4" alt="Voltar">
                <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
            </a>
            {{ __('Professores') }}
        </h2>
        @include('layouts._funcaoadmin')
    </div>
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
                            @foreach($user->where('nivel_acesso', 'professor')->sortBy('name') as $User)
                                <tr>
                                    <td>{{ $User->name }}</td>
                                    <td>{{ $User->email }}</td>
                                    <td>{{ \Carbon\Carbon::parse($User->data_nasc)->format('d/m/Y') }}</td>
                                    <td>{{ $User->cpf }}</td>
                                    <td>{{ $User->telefone }}</td>
                                    <td>
                                        <a class="button" href="/editar-professor/{{ $User->id }}">Editar</a>
                                        <a class="button" href="/excluir-professor/{{ $User->id }}">Excluir</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="button-container">
                        <a class="button" href="/adicionarProfessor">Adicionar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: center;
        padding: 0.75rem;
    }
</style>
@include('layouts._rodape')
</x-app-layout>
