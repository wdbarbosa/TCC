<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Criação de Dúvidas
            </h2>

            <link rel="stylesheet" href="stylefooter.css">
            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
            <link rel="stylesheet" type="text/css" href="styleturmas.css">
        </div>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="w-full max-w-2xl bg-white border border-gray-200 rounded-lg shadow-lg p-8">
            <form method="POST" action="{{ route('cadastrar-duvida') }}">
                @csrf

                <!-- Título -->
                <div class="mb-6">
                    <x-input-label for="nome" :value="__('Título da dúvida:')" />
                    <x-text-input 
                        id="nome" 
                        class="block mt-1 w-full rounded-md" 
                        type="text" 
                        name="nome" 
                        :value="old('nome')" 
                        required
                        autofocus 
                        autocomplete="nome"
                        style="background-color: #f9f9f9; border: 2px solid #d1d5db;" 
                        onfocus="this.style.borderColor='#66d6e3'" 
                        onblur="this.style.borderColor='#d1d5db'" />
                    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                </div>

                <!-- Descrição -->
                <div class="mb-6">
                    <x-input-label for="mensagem" :value="__('Dúvida:')" />
                    <textarea 
                        id="mensagem" 
                        class="block mt-1 w-full h-32 rounded-md" 
                        name="mensagem" 
                        required 
                        autofocus 
                        autocomplete="mensagem"
                        style="background-color: #f9f9f9; border: 2px solid #d1d5db;" 
                        onfocus="this.style.borderColor='#66d6e3'" 
                        onblur="this.style.borderColor='#d1d5db'">{{ old('mensagem') }}</textarea>
                    <x-input-error :messages="$errors->get('mensagem')" class="mt-2" />
                </div>

                <!-- Data da Postagem -->
                <div class="mb-6">
                    <x-input-label for="dataforum" :value="__('Data da postagem:')" />
                    <x-text-input 
                        id="dataforum" 
                        class="block mt-1 w-full rounded-md" 
                        type="date" 
                        name="dataforum" 
                        :value="old('dataforum')" 
                        required 
                        autocomplete="username"
                        style="background-color: #f9f9f9; border: 2px solid #d1d5db;" 
                        onfocus="this.style.borderColor='#66d6e3'" 
                        onblur="this.style.borderColor='#d1d5db'" />
                    <x-input-error :messages="$errors->get('dataforum')" class="mt-2" />
                </div>

                <!-- Botão de Cadastrar -->
                <x-primary-button class="ms-4" style="display: block; margin: 20px auto 0 auto; background-color: #22d3ee; text-align: center; width: fit-content; border: 2px solid #d1d5db; padding: 10px 20px; border-radius: 8px;">
                    {{ __('Cadastrar') }}
                </x-primary-button>
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
