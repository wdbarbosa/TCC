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
        </div>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="w-full max-w-2xl bg-white border border-gray-200 rounded-lg shadow-lg p-8">
            <form method="POST" action="{{ route('cadastrar-comunicado') }}">
                @csrf

                <!-- Titulo -->
                <div class="mb-6">
                    <x-input-label for="nomecomunicado" :value="__('Título do comunicado:')" />
                    <x-text-input 
                        id="nomecomunicado" 
                        class="block mt-1 w-full rounded-md" 
                        type="text" 
                        name="nomecomunicado" 
                        :value="old('nomecomunicado')" 
                        required
                        autofocus 
                        autocomplete="nomecomunicado"
                        style="background-color: #f9f9f9; border: 2px solid #d1d5db;" 
                        onfocus="this.style.borderColor='#66d6e3'" 
                        onblur="this.style.borderColor='#d1d5db'" />
                    <x-input-error :messages="$errors->get('nomecomunicado')" class="mt-2" />
                </div>

                <!-- Descrição -->
                <div class="mb-6">
                    <x-input-label for="comunicado" :value="__('Comunicado:')" />
                    <textarea 
                        id="comunicado" 
                        class="block mt-1 w-full h-32 rounded-md" 
                        name="comunicado" 
                        required 
                        autofocus 
                        autocomplete="comunicado"
                        style="background-color: #f9f9f9; border: 2px solid #d1d5db;" 
                        onfocus="this.style.borderColor='#66d6e3'" 
                        onblur="this.style.borderColor='#d1d5db'">{{ old('comunicado') }}</textarea>
                    <x-input-error :messages="$errors->get('comunicado')" class="mt-2" />
                </div>

                <!-- Date -->
                <div class="mb-6">
                    <x-input-label for="datacomunicado" :value="__('Data do comunicado:')" />
                    <x-text-input 
                        id="datacomunicado" 
                        class="block mt-1 w-full rounded-md" 
                        type="date" 
                        name="datacomunicado" 
                        :value="old('datacomunicado')" 
                        required 
                        autocomplete="username"
                        style="background-color: #f9f9f9; border: 2px solid #d1d5db;" 
                        onfocus="this.style.borderColor='#66d6e3'" 
                        onblur="this.style.borderColor='#d1d5db'" />
                    <x-input-error :messages="$errors->get('datacomunicado')" class="mt-2" />
                </div>

                <!-- Campo Turma -->
                <div class="mb-6">
                    <x-input-label for="id_turma" :value="__('Turma:')" />
                    <select 
                        id="id_turma" 
                        name="id_turma" 
                        class="block mt-1 w-full rounded-md" 
                        style="background-color: #f9f9f9; border: 2px solid #d1d5db;" 
                        onfocus="this.style.borderColor='#66d6e3'" 
                        onblur="this.style.borderColor='#d1d5db'">
                        @foreach($turmas as $turma)
                            <option value="{{ $turma->id }}">{{ $turma->nome }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('id_turma')" class="mt-2" />
                </div>

                <!-- Botão de Cadastrar -->
                <x-primary-button class="ms-4" style="display: block; margin: 20px auto 0 auto; background-color: #22d3ee; text-align: center; width: fit-content;">
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
            const dateInput = document.getElementById('datacomunicado');
            dateInput.value = formattedDate;
        });
    </script>

    @include('layouts._rodape')
</x-app-layout>
