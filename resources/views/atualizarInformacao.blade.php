<x-guest-layout>
@section('title', 'Cursinho Primeiro de Maio')
<section>
    <header>
        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-200 py-4 leading-tight text-center ">
            {{ __('Informações do Cursinho') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 text-center">
            {{ __("Atualize as informações do cursinho se necessário:") }}
        </p>
    </header>

    <form method="post" action="{{ route('atualizarInformacao') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div class="borda-hover">
            <x-input-label for="imagem" :value="__('Imagem')" />
            <input style="background-color: #F4F4F4; border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="imagem" name="imagem" type="file" class="mt-1 block w-full" autofocus autocomplete="imagem" :value="old('imagem', $informacao->imagem)">
            <x-input-error class="mt-2" :messages="$errors->get('imagem')" />
        </div>

        <div class="mt-4">
            <x-input-label for="inicio_inscricao" :value="__('Inicio da inscrição')" />
            <x-text-input style="background-color: #F4F4F4; border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="inicio_inscricao" class="block mt-1 w-full" type="date" name="inicio_inscricao" value="{{ old('inicio_inscricao', $informacao->inicio_inscricao ? \Carbon\Carbon::parse($informacao->inicio_inscricao)->format('Y-m-d') : '') }}" required autocomplete="inicio_inscricao"/>
            
            <!-- Exibir a data formatada -->
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __("A data atual é ") . (\Carbon\Carbon::parse(old('inicio_inscricao', $informacao->inicio_inscricao)) ? \Carbon\Carbon::parse(old('inicio_inscricao', $informacao->inicio_inscricao))->format('d/m/Y') : 'não definida') }}
            </p>

            <x-input-error :messages="$errors->get('inicio_inscricao')" class="mt-2" />
        </div>

        <div class="borda-hover">
            <x-input-label for="infogeral" :value="__('Informações Gerais')" />
            <x-text-input style="background-color: #F4F4F4; border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="infogeral" name="infogeral" type="text" class="mt-1 block w-full" :value="old('infogeral', $informacao->infogeral)" required autofocus autocomplete="infogeral"/>
            <x-input-error class="mt-2" :messages="$errors->get('infogeral')" />
        </div>

        <div class="mt-4">
            <x-input-label for="fim_inscricao" :value="__('Fim da inscrição')" />
            <x-text-input style="background-color: #F4F4F4; border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="fim_inscricao" class="block mt-1 w-full" type="date" name="fim_inscricao" :value="old('fim_inscricao', $informacao->fim_inscricao ? \Carbon\Carbon::parse($informacao->fim_inscricao)->format('Y-m-d') : '')" required autocomplete="fim_inscricao"/>
            <x-input-error :messages="$errors->get('fim_inscricao')" class="mt-2" />
        </div>

        <div class="borda-hover">
            <x-input-label for="endereco" :value="__('Endereço')" />
            <x-text-input style="background-color: #F4F4F4; border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="endereco" name="endereco" type="text" class="mt-1 block w-full" :value="old('endereco', $informacao->endereco)" required autofocus autocomplete="endereco" />
            <x-input-error class="mt-2" :messages="$errors->get('endereco')" />
        </div>

        <div class="borda-hover">
            <x-input-label for="horario" :value="__('Horários')" />
            <x-text-input style="background-color: #F4F4F4; border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="horario" name="horario" type="text" class="mt-1 block w-full" :value="old('horario', $informacao->horario)" required autofocus autocomplete="horario" />
            <x-input-error class="mt-2" :messages="$errors->get('horario')" />
        </div>

        <x-primary-button class="flex items-center gap-4" style="display: block; background-color: #6bb6c0; text-align: center; width: fit-content;">
            {{ __('Atualizar') }}
        </x-primary-button>

    </form>
</section>
</x-guest-layout>
