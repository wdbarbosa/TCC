<x-guest-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <form method="POST" action="/atualizar-disciplina/{{ $disciplina->id }}">
        @csrf
        @method('PUT')

        <div>
            <x-input-label for="nome_disciplina" :value="__('Nome:')" />
            <x-text-input style="background-color: #F4F4F4; border: 2px solid #d1d5db;"  onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="nome_disciplina" class="block mt-1 w-full" type="text" name="nome_disciplina" :value="$disciplina->nome_disciplina" required autofocus />
            <x-input-error :messages="$errors->get('nome_disciplina')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="disciplina_descricao" :value="__('Descrição:')" />
            <x-text-input style="background-color: #F4F4F4; border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="disciplina_descricao" class="block mt-1 w-full" type="text" name="disciplina_descricao" :value="$disciplina->disciplina_descricao" required autofocus />
            <x-input-error :messages="$errors->get('disciplina_descricao')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ms-4" style="display: block; margin: 0 auto; background-color: #05abd2; text-align: center; width: fit-content;">
            {{ __('Atualizar') }}
        </x-primary-button>
        </div>
    </form>
</x-guest-layout>
