<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Criação de Comunicados

            </h2>

        <link rel="stylesheet" href="stylefooter.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="styleturmas.css">
    </x-slot>
    <div class="py-12">
        AQUI A RAPAZIADA VAI ATUALIZAR OS COMUNICADOS

        <form method="POST" action="/atualizar-duvida/{{ $duvida->id }}">
            @csrf
            <!-- Name -->
            <div>
                <x-input-label for="nome" :value="__('Título nome')" />
                <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="$duvida->nome" required
                    autofocus autocomplete="nome" />
                <x-input-error :messages="$errors->get('nome')" class="mt-2" />
            </div>

            <!-- Descrição -->
            <div>
                <x-input-label for="mensagem" :value="__('mensagem')" />
                <x-text-input id="mensagem" class="block mt-1 w-full" type="text" name="mensagem" :value="$duvida->mensagem" required
                    autofocus autocomplete="mensagem" />
                <x-input-error :messages="$errors->get('mensagem')" class="mt-2" />
            </div>
            <br>
            <!-- Date -->
            <div class="mt-4">
                <x-input-label for="dataforum" :value="__('dataforum')" />
                <x-text-input id="dataforum" class="block mt-1 w-full" type="date" name="dataforum"
                    :value="old('dataforum')" required autocomplete="username" max="{{ date('Y-m-d') }}" disabled />
                <x-input-error :messages="$errors->get('dataforum')" class="mt-2" />
            </div>
            <x-primary-button class="ms-4">
                    {{ __('Atualizar') }}
                </x-primary-button>
            </div>
        </form>
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
