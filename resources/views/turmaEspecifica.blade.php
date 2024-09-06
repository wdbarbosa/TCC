<x-app-layout>
    @section('title', 'Detalhes da Turma - ' . $turmas->nome)

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight p" >
               <a href="{{ route('dashboard') }}"  class="text-cyan-600 hover:text-cyan-600 " style="padding-right: 20px;padding-left: 30px">
                    <i class="fas fa-arrow-left"></i> 
               </a> 
               {{ $turmas->nome }}
              </h2> 
            
            <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
            <link rel="stylesheet" href="{{ asset('css/styleturmas.css') }}">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        </div>
    </x-slot>
    
    <div class="py-12 flex justify-center items-center bg-gray-100 min-h-screen">
        <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-2xl font-semibold mb-4 text-gray-800">Informações da Turma</h3>
            <p class="text-gray-600 mb-6">Professor: {{ $user->name ?? 'Não disponível' }}</p>

            <div class="border border-gray-200 rounded-lg bg-gray-50 p-6 mb-8">
                <div class="mb-6">
                    <h2 class="text-3xl font-bold text-gray-800">{{ $turmas->nome }}</h2>
                    <p class="text-gray-700 mt-2">{{ $turmas->descricao }}</p>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold mb-4 text-gray-800">Adicionar Novo Material Didático</h3>
                        <form action="{{ route('materiais.store', $turmas->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="titulo" class="block text-gray-700 font-medium">Título:</label>
                                <input type="text" id="titulo" name="titulo" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div class="mb-4">
                                <label for="conteudo" class="block text-gray-700 font-medium">Conteúdo:</label>
                                <textarea id="conteudo" name="conteudo" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="playlist" class="block text-gray-700 font-medium">Playlist:</label>
                                <input type="text" id="playlist" name="playlist" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <input type="hidden" name="fk_disciplina_id" value="{{ $turmas->disciplina_id }}">
                            <button type="submit" class="bg-cyan-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-cyan-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Adicionar Material</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts._rodape')
</x-app-layout>
