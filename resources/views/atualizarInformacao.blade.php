<x-guest-layout>
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informações do Cursinho') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Atualize as informações do cursinho se necessário:") }}
        </p>
    </header>

    <form method="post" action="{{ route('atualizarInformacao') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div class="borda-hover">
            <x-input-label for="imagem" :value="__('Imagem')" />
            <input id="imagem" name="imagem" type="file" class="mt-1 block w-full" autofocus autocomplete="imagem" :value="old('imagem', $informacao->imagem)">
            <x-input-error class="mt-2" :messages="$errors->get('imagem')" />
        </div>


        <div class="mt-4">
            <x-input-label for="inicio_inscricao" :value="__('Inicio da inscrição')" />
            <x-text-input id="inicio_inscricao" class="block mt-1 w-full" type="date" name="inicio_inscricao" :value="old('inicio_inscricao', $informacao->inicio_inscricao)" required autocomplete="inicio_inscricao"/>
            <x-input-error :messages="$errors->get('inicio_inscricao')" class="mt-2" />
        </div>


        <div class="borda-hover">
            <x-input-label for="infogeral" :value="__('Informações Gerais')" />
            <x-text-input id="infogeral" name="infogeral" type="text" class="mt-1 block w-full" :value="old('infogeral', $informacao->infogeral)" required autofocus autocomplete="infogeral"/>
            <x-input-error class="mt-2" :messages="$errors->get('infogeral')" />
        </div>

        <div class="mt-4">
            <x-input-label for="fim_inscricao" :value="__('Fim da inscrição')" />
            <x-text-input id="fim_inscricao" class="block mt-1 w-full" type="date" name="fim_inscricao" :value="old('fim_inscricao', $informacao->fim_inscricao)" required autocomplete="fim_inscricao"/>
            <x-input-error :messages="$errors->get('fim_inscricao')" class="mt-2" />
        </div>

        <div class="borda-hover">
            <x-input-label for="endereco" :value="__('Endereço')" />
            <x-text-input id="endereco" name="endereco" type="text" class="mt-1 block w-full" :value="old('endereco', $informacao->endereco)" required autofocus autocomplete="endereco" />
            <x-input-error class="mt-2" :messages="$errors->get('endereco')" />
        </div>

        <div class="borda-hover">
            <x-input-label for="horario" :value="__('Horários')" />
            <x-text-input id="horario" name="horario" type="text" class="mt-1 block w-full" :value="old('horario', $informacao->horario)" required autofocus autocomplete="horario" />
            <x-input-error class="mt-2" :messages="$errors->get('horario')" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Atualizar') }}</x-primary-button>
        </div>

    </form>
</section>
</x-guest-layout>
