<x-guest-layout>
    <form method="POST" action="/atualizar-informacao/{{ $informacao->id }}">
        @csrf

        <!-- informacao -->
        <div>
            <x-input-label for="informacao" :value="__('Informacao')" />
            <textarea id="informacao" class="block mt-1 w-full" name="informacao" required autofocus autocomplete="informacao">{{ old('informacao') }}</textarea>
            <x-input-error :messages="$errors->get('informacao')" class="mt-2" />
        </div>
        <br>
        <x-primary-button class="ms-4">
                {{ __('Atualizar') }}
            </x-primary-button>
        </div>
    </form>
    </x-guest-layout>