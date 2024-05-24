<x-guest-layout>
    <form method="POST" action="{{ route('cadastrar-turma') }}">
        @csrf
        <!-- Name -->
        <div>
            <x-input-label for="nome" :value="__('Nome')" />
            <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required
                autofocus autocomplete="nome" />
            <x-input-error :messages="$errors->get('nome')" class="mt-2" />
        </div>

        <!-- Descrição -->
        <div>
            <x-input-label for="descricao" :value="__('Descricao')" />
            <textarea id="descricao" class="block mt-1 w-full" name="descricao" required autofocus autocomplete="descricao">{{ old('descricao') }}</textarea>
            <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
        </div>
        <br>
        <x-primary-button class="ms-4">
                {{ __('Cadastrar') }}
            </x-primary-button>
        </div>
    </form>
    </x-guest-layout>