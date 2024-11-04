
<link rel="stylesheet" href="stylefooter.css">
<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <a href="{{ route('comunicados') }}" class="mr-4" alt="Voltar">
                    <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
                </a>
                Adicionar Comunicado
            </h2>
        </div>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="w-full max-w-2xl bg-white border border-gray-200 rounded-lg shadow-lg p-8">
            <form method="POST" action="{{ route('cadastrar-comunicado') }}">
                @csrf

                <!-- Titulo -->
                <div class="mb-6">
                    <label for="nomecomunicado" class="font-medium text-gray-700">Título do comunicado:</label>
                    <input id="nomecomunicado" class="block mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" 
                        name="nomecomunicado" :value="old('nomecomunicado')" required autofocus autocomplete="nomecomunicado" />
                    <x-input-error :messages="$errors->get('nomecomunicado')" class="mt-2" />
                </div>

                <!-- Descrição -->
                <div class="mb-6">
                    <label for="comunicado" class="font-medium text-gray-700">Comunicado:</label>
                    <textarea id="comunicado" class="block mt-1 w-full h-32 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="comunicado" required autofocus autocomplete="comunicado">{{ old('comunicado') }}</textarea>
                    <x-input-error :messages="$errors->get('comunicado')" class="mt-2" />
                </div>

                <!-- Date -->
                <div class="mb-6">
                    <label for="datacomunicado" class="font-medium text-gray-700">Data do comunicado:</label>
                    <input id="datacomunicado" class="block mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="date" name="datacomunicado" :value="old('datacomunicado')" required autocomplete="username" readonly />
                    <x-input-error :messages="$errors->get('datacomunicado')" class="mt-2" />
                </div>

                <!-- Campo Turma -->
                <div class="mb-6">  
                    <label for="id_turma" class="font-medium text-gray-700">Turma:</label>
                    <select id="id_turma" name="id_turma" class="block mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach($turmas as $turma)
                            <option value="{{ $turma->id }}">{{ $turma->nome }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('id_turma')" class="mt-2" />
                </div>

                <!-- Botão de Cadastrar -->
                <div class="flex justify-center mt-4">
                    <x-primary-button>
                        {{ __('Adicionar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtém a data atual
            const today = new Date();

            // Formata a data no formato YYYY-MM-DD
            const day = String(today.getDate()).padStart(2, '0');
            const month = String(today.getMonth() + 1).padStart(2, '0'); // Janeiro é 0!
            const year = today.getFullYear();
            const formattedDate = `${year}-${month}-${day}`;

            // Define o valor do campo de data para a data atual
            const dateInput = document.getElementById('datacomunicado');
            dateInput.value = formattedDate;
        });
    </script>

    @include('layouts._rodape')
</x-app-layout>
