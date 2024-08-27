<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
<x-slot name="header">
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $turmas->nome }}
        </h2>

        <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styleturmas.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @if(auth()->user()->nivel_acesso === 'admin')
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="btn btn-primary">
                        Ação do Administrador
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link href="/professor">Gerenciar Professores</x-dropdown-link>
                    <x-dropdown-link href="/aluno">Gerenciar Alunos</x-dropdown-link>
                    <x-dropdown-link href="/turma">Gerenciar Salas</x-dropdown-link>
                    <x-dropdown-link href="/alterarInformacao">Alterar Informações</x-dropdown-link>
                </x-slot>
            </x-dropdown>
        @endif
    </div>
</x-slot>

<div class="py-12 flex justify-center items-center">
    <div class="w-full max-w-4xl">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold">Informações da Turma</h3>
            <p class="text-gray-600">Professor: {{ $user->name ?? 'Não disponível' }}</p>
        </div>

        <div class="mt-8">
            <div class="border border-gray-200 rounded-lg bg-gray-50 p-6">
                <div class="mb-4">
                    <h2 class="text-2xl font-bold">{{ $turmas->nome }}</h2>
                    <p class="text-gray-700">{{ $turmas->descricao }}</p>
                </div>

                <div class="space-y-4">
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <p>Outros posts podem seguir aqui</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts._rodape')
</x-app-layout>
