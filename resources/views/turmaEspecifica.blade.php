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

                    <div class="space-y-4">
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-semibold">Adicionar Novo Material Didático</h3>
                            <form action="{{ route('materiais.store', $turmas->id) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="titulo" class="block text-gray-700">Título:</label>
                                    <input type="text" id="titulo" name="titulo" class="form-input mt-1 block w-full" required>
                                </div>
                                <div class="mb-4">
                                    <label for="conteudo" class="block text-gray-700">Conteúdo:</label>
                                    <textarea id="conteudo" name="conteudo" class="form-input mt-1 block w-full" required></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="playlist" class="block text-gray-700">Playlist:</label>
                                    <input type="text" id="playlist" name="playlist" class="form-input mt-1 block w-full">
                                </div>
                                <input type="hidden" name="fk_disciplina_id" value="{{ $turmas->disciplina_id }}">
                                <button type="submit" class=" text-black py-2 px-4 rounded">Adicionar Material</button>
                            </form>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts._rodape')
</x-app-layout>
