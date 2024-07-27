<x-guest-layout>
    <form method="POST" action="{{ route('cadastrar-turma') }}">
        @csrf
        <!-- Name -->
        <div>
            <x-input-label for="nome" :value="__('Nome')" />
            <x-text-input style="background-color: #F4F4F4;" id="nome" class="focus:border-cyan-200 block mt-1 w-full" type="text" name="nome" :value="old('nome')" required
                autofocus autocomplete="nome" />
            <x-input-error :messages="$errors->get('nome')" class="mt-2" />
        </div>

        <!-- Descrição -->
        <div class="mt-4">
            <x-input-label for="descricao" :value="__('Descrição')" />
            <textarea style="background-color: #F4F4F4;" id="descricao" class=" focus:border-cyan-200 block mt-1 w-full border-gray-300 rounded-lg" name="descricao" required autofocus autocomplete="descricao">{{ old('descricao') }}</textarea>
            <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
        </div>
        <br>
        <x-primary-button class="ms-4" style="display: block; margin: 0 auto; background-color: #22d3ee; text-align: center; width: fit-content;">
                {{ __('Cadastrar') }}
            </x-primary-button>
    </form>
    </x-guest-layout>

