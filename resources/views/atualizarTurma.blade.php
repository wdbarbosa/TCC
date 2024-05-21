<x-guest-layout>
    <form method="POST" action="/atualizar-turma/{{ $turma->id }}">
        @csrf
        @method('PUT')

        <div>
            <x-input-label for="nome" :value="__('Nome')" />
            <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="$turma->nome" required autofocus />
            <x-input-error :messages="$errors->get('nome')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="descricao" :value="__('Descricao')" />
            <x-text-input id="descricao" class="block mt-1 w-full" type="text" name="descricao" :value="$turma->descricao" required autofocus />
            <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">

        <x-primary-button class="ms-4">
            {{ __('Atualizar') }}
        </x-primary-button>
        </div>
    </form>
</x-guest-layout>