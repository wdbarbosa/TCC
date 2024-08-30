<x-guest-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <form method="POST" action="{{ route('cadastrar-turma') }}">
        @csrf
        <!-- Name -->
        <div>
            <x-input-label for="nome" :value="__('Nome')" />
            <x-text-input style="background-color: #F4F4F4; border: 2px solid #d1d5db;"  onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required
                autofocus autocomplete="nome" />
            <x-input-error :messages="$errors->get('nome')" class="mt-2" />
        </div>

        <!-- Descrição -->
        <div class="mt-4">
            <x-input-label for="descricao" :value="__('Descrição')" />
            <textarea style="background-color: #F4F4F4; border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3' "onblur="this.style.borderColor='#d1d5db'"  id="descricao" class=" block mt-1 w-full border rounded-lg" name="descricao" required autofocus autocomplete="descricao">{{ old('descricao') }}</textarea>
            <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
        </div>
        <br>
        <x-primary-button class="ms-4" style="display: block; margin: 0 auto; background-color: #05abd2; text-align: center; width: fit-content;">
                {{ __('Cadastrar') }}
            </x-primary-button>
    </form>
    </x-guest-layout>

