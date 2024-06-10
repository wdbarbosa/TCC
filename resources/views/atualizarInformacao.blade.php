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
        @method('patch')

        <div class="borda-hover">
            <x-input-label for="imagem" :value="__('Imagem')" />
            <input id="imagem" name="imagem" type="file" class="mt-1 block w-full" required autofocus autocomplete="imagem">
            <x-input-error class="mt-2" :messages="$errors->get('imagem')" />
        </div>

        <div class="mt-4">
            <x-input-label for="inicioinscricao" :value="__('Inicio da inscrição')" />
            <x-text-input id="inicioinscricao" class="block mt-1 w-full" type="date" name="inicioinscricao" :value="$informacao->inicioinscricao" required autocomplete="inicioinscricao" max="{{ date('Y-m-d') }}" />
            <x-input-error :messages="$errors->get('inicioinscricao')" class="mt-2" />
        </div>


        <div class="borda-hover">
            <x-input-label for="infogeral" :value="__('Informação Geral')" />
            <textarea id="infogeral" name="infogeral" class="mt-1 block w-full" required autofocus autocomplete="infogeral">{{ old('infogeral', $informacao->infogeral) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('infogeral')" />
        </div>

        <div class="mt-4">
            <x-input-label for="fiminscricao" :value="__('fim da inscrição')" />
            <x-text-input id="fiminscricao" class="block mt-1 w-full" type="date" name="fiminscricao" :value="$informacao->fiminscricao" required autocomplete="fiminscricao" max="{{ date('Y-m-d') }}" />
            <x-input-error :messages="$errors->get('fiminscricao')" class="mt-2" />
        </div>

        <div class="borda-hover">
            <x-input-label for="endereco" :value="__('Endereço')" />
            <x-text-input id="endereco" name="endereco" type="text" class="mt-1 block w-full" :value="old('endereco', $informacao->endereco)" required autofocus autocomplete="endereco" />
            <x-input-error class="mt-2" :messages="$errors->get('endereco')" />
        </div>

        <div class="borda-hover">
            <x-input-label for="horarios" :value="__('Horários')" />
            <textarea id="horarios" name="horarios" class="mt-1 block w-full" required autofocus autocomplete="horarios">{{ old('horarios', $informacao->horarios) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('horarios')" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Atualizar') }}</x-primary-button>
        </div>
    </form>
</section>
