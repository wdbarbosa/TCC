<x-app-layout>
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
        AQUI A RAPAZIADA VAI ADICIONAR OS COMUNICADOS

        <form method="POST" action="{{ route('cadastrar-comunicado') }}">
            @csrf
            <!-- Name -->
            <div>
                <x-input-label for="nomecomunicado" :value="__('Título Comunicado')" />
                <x-text-input id="nomecomunicado" class="block mt-1 w-full" type="text" name="nomecomunicado" :value="old('nomecomunicado')" required
                    autofocus autocomplete="nomecomunicado" />
                <x-input-error :messages="$errors->get('nomecomunicado')" class="mt-2" />
            </div>

            <!-- Descrição -->
            <div>
                <x-input-label for="comunicado" :value="__('Comunicado')" />
                <textarea id="comunicado" class="block mt-1 w-full" name="comunicado" required autofocus autocomplete="comunicado">{{ old('comunicado') }}</textarea>
                <x-input-error :messages="$errors->get('comunicado')" class="mt-2" />
            </div>
            <br>
            <!-- Date -->
            <div class="mt-4">
                <x-input-label for="datacomunicado" :value="__('Data do comunicado')" />
                <x-text-input id="datacomunicado" class="block mt-1 w-full" type="date" name="datacomunicado"
                    :value="old('datacomunicado')" required autocomplete="username" max="{{ date('Y-m-d') }}" />
                <x-input-error :messages="$errors->get('datacomunicado')" class="mt-2" />
            </div>
            <x-primary-button class="ms-4">
                    {{ __('Cadastrar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
  @include('layouts._rodape')
</x-app-layout>