<x-guest-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <form method="POST" action="/atualizar-turma/{{ $turma->id }}">
        @csrf
        @method('PUT')

        <div>
            <x-input-label for="nome" :value="__('Nome')" />
            <x-text-input style="background-color: #F4F4F4; border: 2px solid #d1d5db;"  onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="nome" class="block mt-1 w-full" type="text" name="nome" :value="$turma->nome" required autofocus />
            <x-input-error :messages="$errors->get('nome')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="descricao" :value="__('Descricao')" />
            <x-text-input style="background-color: #F4F4F4; border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="descricao" class="block mt-1 w-full" type="text" name="descricao" :value="$turma->descricao" required autofocus />
            <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ms-4" style="display: block; margin: 0 auto; background-color: #22d3ee; text-align: center; width: fit-content;">
            {{ __('Atualizar') }}
        </x-primary-button>
        </div>
    </form>
</x-guest-layout>
