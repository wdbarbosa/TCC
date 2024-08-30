<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
    <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
    <link rel="stylesheet" href="styletitulo.css">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Criação de Dúvidas
            </h2>
        </div>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="w-full max-w-2xl bg-white border border-gray-200 rounded-lg shadow-lg p-8">
            <form method="POST" action="{{ route('cadastrar-duvida') }}">
                @csrf
                
                <h1>Adicionar dúvida</h1>
                <hr>

                <div class="mb-6">
                    <x-input-label for="nome" :value="__('Título:')" />
                    <x-text-input
                        id="nome"
                        class="block mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50"
                        type="text"
                        name="nome"
                        :value="old('nome')"
                        required
                        autofocus
                        autocomplete="nome" />
                    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <x-input-label for="mensagem" :value="__('Dúvida:')" />
                    <textarea
                        id="mensagem"
                        name="mensagem"
                        class="block mt-1 w-full h-32 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50"
                        required
                        autofocus
                        autocomplete="mensagem">{{ old('mensagem') }}</textarea>
                    <x-input-error :messages="$errors->get('mensagem')" class="mt-2" />
                </div>

                <div class="mb-6">
                    <x-input-label for="dataforum" :value="__('Data da postagem:')" />
                    <x-text-input
                        id="dataforum"
                        class="block mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50"
                        type="date"
                        name="dataforum"
                        :value="old('dataforum')"
                        required
                        readonly
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('dataforum')" class="mt-2" />
                </div>

                <div class="flex justify-center mt-6">
                    <x-primary-button style="background-color: #05abd2" class="mt-4 text-white py-2 px-4 rounded border border-gray-300 hover:bg-[#5a9a9a] transition duration-150">
                        {{ __('Adicionar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            const day = String(today.getDate()).padStart(2, '0');
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const year = today.getFullYear();
            const formattedDate = `${year}-${month}-${day}`;
            const dateInput = document.getElementById('dataforum');
            dateInput.value = formattedDate;
        });
    </script>

    @include('layouts._rodape')
</x-app-layout>
