<x-guest-layout>
<h2 class="font-semibold text-xl text-gray-900 dark:text-gray-200 py-4 leading-tight text-center ">
    
    {{ __('Adicionar Disciplina') }}
</h2>
<hr>
    <form method="POST" action="{{ route('cadastrar-disciplina') }}">
        @csrf
        <!-- Name -->
        <div>
            <x-input-label class="mt-4" for="nome_disciplina" :value="__('Nome:')" />
            <x-text-input id="nome_disciplina" class="block mt-1 w-full" type="text" name="nome_disciplina" :value="old('nome_disciplina')" required
                autofocus autocomplete="nome_disciplina" />
            <x-input-error :messages="$errors->get('nome_disciplina')" class="mt-2" />
        </div>

        <!-- Descrição -->
        <div class="mt-4">
            <x-input-label for="disciplina_descricao" :value="__('Descrição:')" />
            <textarea id="disciplina_descricao" class="focus:outline-none border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 block mt-1 w-full border rounded-lg" name="disciplina_descricao" required autofocus autocomplete="disciplina_descricao">{{ old('disciplina_descricao') }}</textarea>
            <x-input-error :messages="$errors->get('disciplina_descricao')" class="mt-2" />
        </div>
        <div class="flex justify-center mt-4">
            <x-primary-button>
                {{ __('Cadastrar') }}
            </x-primary-button>
        </div>
    </form>
    </x-guest-layout>

