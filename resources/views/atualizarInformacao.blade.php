<x-app-layout>
    
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <a href="{{ route('dashboard') }}" class="mr-4" alt="Voltar">
                    <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
                </a>
                {{ __('Alterar Informações') }}
            </h2>

            <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('styleturmas.css') }}">
        </div>
        </x-slot>
<main>
    <div class="py-12 flex justify-center">
        <div class="w-full max-w-2xl bg-white border border-gray-200 rounded-lg shadow-lg p-8"> 
<h2 class="font-semibold text-xl text-gray-900 dark:text-gray-200 py-4 leading-tight text-center ">
    {{ __('Informações do cursinho') }}
</h2>
<hr>
        <p class="mt-3 text-sm text-gray-600 dark:text-gray-400 text-center">
            {{ __("Atualize as informações do cursinho se necessário:") }}
        </p>
    </header>

    <form method="post" action="{{ route('atualizarInformacao') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div class="mt-4">
            <x-input-label for="inicio_inscricao" :value="__('Inicio da inscrição:')" />
            <x-text-input id="inicio_inscricao" class="block mt-1 w-full" type="date" name="inicio_inscricao" value="{{ old('inicio_inscricao', $informacao->inicio_inscricao ? \Carbon\Carbon::parse($informacao->inicio_inscricao)->format('Y-m-d') : '') }}" required autocomplete="inicio_inscricao"/>
            
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 px-3">
                {{ __("A data atual é ") . (\Carbon\Carbon::parse(old('inicio_inscricao', $informacao->inicio_inscricao)) ? \Carbon\Carbon::parse(old('inicio_inscricao', $informacao->inicio_inscricao))->format('d/m/Y') : 'não definida') }}
            </p>

            <x-input-error :messages="$errors->get('inicio_inscricao')" class="mt-2" />
        </div>

        <div class="borda-hover">
            <x-input-label for="infogeral" :value="__('Informações Gerais:')" />
            <x-text-input id="infogeral" name="infogeral" type="text" class="mt-1 block w-full" :value="old('infogeral', $informacao->infogeral)" required autofocus autocomplete="infogeral"/>
            <x-input-error class="mt-2" :messages="$errors->get('infogeral')" />
        </div>

        <div class="mt-4">
            <x-input-label for="fim_inscricao" :value="__('Fim da inscrição:')" />
            <x-text-input id="fim_inscricao" class="block mt-1 w-full" type="date" name="fim_inscricao" :value="old('fim_inscricao', $informacao->fim_inscricao ? \Carbon\Carbon::parse($informacao->fim_inscricao)->format('Y-m-d') : '')" required autocomplete="fim_inscricao"/>
            <x-input-error :messages="$errors->get('fim_inscricao')" class="mt-2" />
        </div>

        <div class="borda-hover">
            <x-input-label for="endereco" :value="__('Endereço:')" />
            <x-text-input id="endereco" name="endereco" type="text" class="mt-1 block w-full" :value="old('endereco', $informacao->endereco)" required autofocus autocomplete="endereco" />
            <x-input-error class="mt-2" :messages="$errors->get('endereco')" />
        </div>

        <div class="borda-hover">
            <x-input-label for="horario" :value="__('Horários:')" />
            <x-text-input id="horario" name="horario" type="text" class="mt-1 block w-full" :value="old('horario', $informacao->horario)" required autofocus autocomplete="horario" />
            <x-input-error class="mt-2" :messages="$errors->get('horario')" />
        </div>

        <div class="flex justify-center mt-4">
            <x-primary-button>
                {{ __('Atualizar') }}
            </x-primary-button>
        </div>
    </form>
</section>
</x-guest-layout>
