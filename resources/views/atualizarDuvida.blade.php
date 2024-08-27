<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Atualização de Dúvidas
            </h2>
        </div>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="w-full max-w-2xl bg-white border border-gray-200 rounded-lg shadow-lg p-8">
            <form method="POST" action="/atualizar-duvida/{{ $duvida->id }}">
                @csrf

                <!-- Título -->
                <div class="mb-6">
                    <x-input-label for="nome" :value="__('Título da dúvida:')" />
                    <x-text-input
                        id="nome"
                        class="block mt-1 w-full rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50"
                        type="text"
                        name="nome"
                        :value="$duvida->nome"
                        required
                        autofocus
                        autocomplete="nome" />
                    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                </div>

                <!-- Descrição -->
                <div class="mb-6">
                    <x-input-label for="mensagem" :value="__('Dúvida:')" />
                    <textarea
                        id="mensagem"
                        name="mensagem"
                        class="block mt-1 w-full h-32 rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50"
                        required
                        autofocus
                        autocomplete="mensagem">{{ $duvida->mensagem }}</textarea>
                    <x-input-error :messages="$errors->get('mensagem')" class="mt-2" />
                </div>

                <!-- Data da Postagem -->
                <div class="mb-6">
                    <x-input-label for="dataforum" :value="__('Data da postagem:')" />
                    <x-text-input
                        id="dataforum"
                        class="block mt-1 w-full rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50"
                        type="date"
                        name="dataforum"
                        :value="old('dataforum')"
                        required
                        autocomplete="username"
                        max="{{ date('Y-m-d') }}"
                        disabled />
                    <x-input-error :messages="$errors->get('dataforum')" class="mt-2" />
                </div>

                <!-- Botão de Atualizar -->
                <div class="flex justify-center mt-6">
                    <x-primary-button class="bg-[#6bb6c0] text-white py-2 px-4 rounded border border-gray-300 hover:bg-[#5a9a9a] focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition duration-150">
                        {{ __('Atualizar') }}
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
            const dateInput = document.getElementById('dataforum');
            dateInput.value = formattedDate;
        });
    </script>

    @include('layouts._rodape')
</x-app-layout>
