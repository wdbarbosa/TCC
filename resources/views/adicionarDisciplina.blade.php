<x-guest-layout>
    <form method="POST" action="{{ route('cadastrar-disciplina') }}">
        @csrf
        <!-- Name -->
        <div>
            <x-input-label for="nome_disciplina" :value="__('Nome:')" />
            <x-text-input style="background-color: #F4F4F4; border: 2px solid #d1d5db;"  onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="nome_disciplina" class="block mt-1 w-full" type="text" name="nome_disciplina" :value="old('nome_disciplina')" required
                autofocus autocomplete="nome_disciplina" />
            <x-input-error :messages="$errors->get('nome_disciplina')" class="mt-2" />
        </div>

        <!-- Descrição -->
        <div class="mt-4">
            <x-input-label for="disciplina_descricao" :value="__('Descrição:')" />
            <textarea style="background-color: #F4F4F4; border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3' "onblur="this.style.borderColor='#d1d5db'"  id="disciplina_descricao" class=" block mt-1 w-full border rounded-lg" name="disciplina_descricao" required autofocus autocomplete="disciplina_descricao">{{ old('disciplina_descricao') }}</textarea>
            <x-input-error :messages="$errors->get('disciplina_descricao')" class="mt-2" />
        </div>
        <br>
        <x-primary-button class="ms-4" style="display: block; margin: 0 auto; background-color: #05abd2; text-align: center; width: fit-content;">
                {{ __('Cadastrar') }}
            </x-primary-button>
    </form>
    </x-guest-layout>

