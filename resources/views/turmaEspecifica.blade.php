<x-app-layout>
    @section('title', 'Detalhes da Turma - ' . $turmas->nome)

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $turmas->nome }}
            </h2>
            <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
            <link rel="stylesheet" href="{{ asset('css/styleturmas.css') }}">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
            @vite(['resources/css/app.css', 'resources/js/app.js'])
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

                </div>
            </div>
        </div>
    </div>

    @include('layouts._rodape')
</x-app-layout>
