<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Resumos') }}
        </h2>
    </x-slot>

    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2>Adicionar Resumo</h2>
                        <div class="formulario">
                            <form action="{{ route('resumo.salvar') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @include('resumosForm')
                                <button class="botao-salvar" type="submit">Adicionar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts._rodape')
</x-app-layout>