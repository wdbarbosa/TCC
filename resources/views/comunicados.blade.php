<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="stylefooter.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comunicados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(auth()->user()->nivel_acesso === 'professor')
                        <a class="dropdown-item" href="/adicionarComunicado">Adicionar comunicado</a>
                    @endif                 
                </div>       
            </div>
                <br>
                <br> 
            
                @forelse($comunicados as $comunicado)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-lg font-semibold">{{ $comunicado->nomecomunicado }}</p>
                        <p class="text-gray-600 dark:text-gray-300">{{ $comunicado->comunicado }}</p>
                        <p class="text-gray-600 dark:text-gray-300">{{ \Carbon\Carbon::parse($comunicado->data_comunicado)->format('d/m/Y') }}</p>
                        <br>
                    </div>
                </div>
                <br>
                <br>
                @empty
                    <p class="text-gray-600 dark:text-gray-300">Nenhum comunicado disponível.</p>                  
                @endforelse
           
        </div>
    </div>
    
    @include('layouts._rodape')
</x-app-layout>
