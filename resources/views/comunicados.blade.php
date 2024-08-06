<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <link rel="stylesheet" href="stylefooter.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comunicados') }}
        </h2>
    </x-slot>

    @if(auth()->user()->nivel_acesso === 'professor')
        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <a class="dropdown-item bg-gray-200 text-gray-800 py-2 px-1 rounded" href="/adicionarComunicado">
                            <u>Adicionar comunicado</u>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Container para os comunicados -->
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @forelse($comunicado as $comunicado)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-lg font-semibold">Título: {{ $comunicado->nomecomunicado }}</p>
                        <p class="text-lg font-semibold">Autor: {{ $comunicado->user ? $comunicado->user->name : 'Não disponível' }}</p>
                        <p class="text-lg font-semibold">Turma: {{ $comunicado->turma->nome ?? 'Não associada' }}</p>
                        <p class="text-gray-600 dark:text-gray-300">{{ $comunicado->comunicado }}</p>
                        <p class="text-lg font-semibold mt-4">Data de postagem: {{ \Carbon\Carbon::parse($comunicado->datacomunicado)->format('d/m/Y') }}</p>
                        
                        @if(auth()->user()->id === $comunicado->id_professor)
                            <div class="mt-4 flex space-x-4">
                                <a class="bg-gray-200 text-gray-800 py-2 px-4 rounded" href="/editar-comunicado/{{ $comunicado->id }}">
                                    Editar comunicado
                                </a>
                                <a class="bg-gray-200 text-gray-800 py-2 px-4 rounded" href="/excluir-comunicado/{{ $comunicado->id }}">
                                    Excluir comunicado
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-600 dark:text-gray-300">Nenhum comunicado disponível.</p>
            @endforelse
        </div>
    </div>

    @include('layouts._rodape')
</x-app-layout>
