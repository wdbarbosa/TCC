<x-guest-layout>
    <form method="POST" action="/atualizar-informacao">
        @csrf
        @method('PUT')

        <!-- Conteúdo -->
        <div class="mt-4">
            <x-input-label for="info_geral" :value="__('Informações gerais')" />
            <x-text-input id="info_geral" class="block mt-1 w-full" type="text" name="info_geral" :value="$informacao->info_geral" required />
            <x-input-error :messages="$errors->get('info_geral')" class="mt-2" />
        </div>

        <!-- Imagem -->
        <div class="mt-4">
            <x-input-label for="imagem" :value="__('Imagem')" />
            <x-text-input id="imagem" class="block mt-1 w-full" type="text" name="imagem" :value="$informacao->imagem" required />
            <x-input-error :messages="$errors->get('imagem')" class="mt-2" />
        </div>

        <!-- Endereço -->
        <div class="mt-4">
            <x-input-label for="endereco" :value="__('Endereço')" />
            <x-text-input id="endereco" class="block mt-1 w-full" type="text" name="endereco" :value="$informacao->endereco" required />
            <x-input-error :messages="$errors->get('endereco')" class="mt-2" />
        </div>

        <!-- Início da Inscrição -->
        <div class="mt-4">
            <x-input-label for="inicio_inscricao" :value="__('Início da Inscrição')" />
            <x-text-input id="inicio_inscricao" class="block mt-1 w-full" type="date" name="inicio_inscricao" :value="$informacao->inicio_inscricao" required />
            <x-input-error :messages="$errors->get('inicio_inscricao')" class="mt-2" />
        </div>

        <!-- Fim da Inscrição -->
        <div class="mt-4">
            <x-input-label for="fim_inscricao" :value="__('Fim da Inscrição')" />
            <x-text-input id="fim_inscricao" class="block mt-1 w-full" type="date" name="fim_inscricao" :value="$informacao->fim_inscricao" required />
            <x-input-error :messages="$errors->get('fim_inscricao')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Atualizar Informação') }}
            </button>
        </div>
    </form>
</x-guest-layout>
