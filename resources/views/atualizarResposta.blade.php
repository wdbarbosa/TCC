<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Resposta') }}
        </h2>
    </x-slot>

    <!-- Exibir a dúvida no topo -->
    
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6">
                <label for="resposta" class="block font-medium text-gray-700 dark:text-gray-200">Dúvida que está sendo respondida:</label>
                    <h3 class="text-xl font-semibold mb-4 underline">{{ $duvida->nome }}</h3>
                    <p>Dúvida:</p>
                    <div class="bg-[#F4F4F4] border border-[#e2e8f0] p-4 rounded-lg shadow-sm mb-4">
                        <p class="text-black dark:text-black">{{ $duvida->mensagem }}</p>
                    </div>
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

                        <label for="resposta" class="block font-medium text-gray-700 dark:text-gray-200">Editar sua resposta:</label>
                        <textarea id="resposta" name="resposta" rows="6" class="w-full border-gray-300 rounded-lg p-2" required>{{ $resposta->resposta }}</textarea>

                        <button type="submit" class="mt-4 bg-[#6bb6c0] text-white py-2 px-4 rounded hover:bg-[#7fb2b8] transition duration-150">
                            Atualizar Resposta
                        </button>
                    </form>
                </div>
            </div>
        </div>

    @include('layouts._rodape')
</x-app-layout>
