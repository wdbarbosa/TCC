<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
        <link rel="stylesheet" href="styleforumdeduvidas.css">
        
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Atualizar Resposta') }}
        </h2>
    </x-slot>
    <style>
        .colorido {
            background-color: #6bb6c0; 
            padding: 5px 10px;
        }
    </style>
    
        <div class="py-9">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <label for="resposta" class="block font-medium text-gray-700 dark:text-gray-200 mb-2 px-6">Dúvida que está sendo respondida:</label>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6">
                <p class="text-xl text-white font-semibold mb-4 sm:rounded colorido">{{ $duvida->nome }}</p>
                    <p>Dúvida:</p>
                    <div class="bg-[#F4F4F4] border border-[#e2e8f0] p-4 rounded-lg shadow-sm mb-4">
                        <p class="text-black dark:text-black">{{ $duvida->mensagem }}</p>
                    </div>
                    <p class="text-gray-800 dark:text-gray-200 mb-2"><strong>Autor:</strong> {{ $duvida->user ? $duvida->user->name : 'Não disponível' }}</p>
                    <p class="text-gray-800 dark:text-gray-200"><strong>Data de postagem:</strong> {{ \Carbon\Carbon::parse($duvida->dataforum)->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Formulário de edição da resposta -->
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6">
                    <form action="{{ route('atualizar-resposta', $resposta->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label for="resposta" class="block font-medium text-gray-700 dark:text-gray-200 mb-3">Atualizar sua resposta:</label>
                        <textarea id="resposta" name="resposta" rows="5" class="w-full border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>{{ $resposta->resposta }}</textarea>

                        <div class="flex justify-center mt-4">
                                <x-primary-button>
                                    {{ __('Atualizar') }}
                                </x-primary-button>
                            </div>
                    </form>
                </div>
            </div>
        </div>

    @include('layouts._rodape')
</x-app-layout>
