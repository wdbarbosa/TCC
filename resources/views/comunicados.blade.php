<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
    <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
    <link rel="stylesheet" href="stylecomunicados.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comunicados') }}
        </h2>
    </x-slot>

    @if(auth()->user()->nivel_acesso === 'professor')
        <div class="py-6"> <!-- Reduzi o padding vertical aqui -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg"> <!-- Adicionado shadow-lg -->
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <a class="bg-[#6bb6c0] text-white py-2 px-4 rounded inline-block hover:bg-[#8ab3b6] transition duration-150" href="/adicionarComunicado">
                            Adicionar comunicado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Container para os comunicados -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @forelse($comunicados->sortByDesc('created_at') as $comunicado)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg"> <!-- Adicionado shadow-lg -->
                    <div class="p-6">
                        <!-- Título do comunicado -->
                        <p class="text-xl text-white font-semibold mb-4 sm:rounded colorido" >
                            {{ $comunicado->nomecomunicado }}
                        </p>

                        <!-- Detalhes do comunicado -->
                        <p class="text-gray-800 dark:text-gray-200 mb-2"><strong>Autor:</strong> {{ $comunicado->user ? $comunicado->user->name : 'Não disponível' }}</p>
                        <p class="text-gray-800 dark:text-gray-200 mb-2"><strong>Turma:</strong> {{ $comunicado->turma->nome ?? 'Não associada' }}</p>

                        <!-- Container para destacar o conteúdo do comunicado -->
                        <div class="bg-[#F4F4F4] border border-[#e2e8f0] p-4 rounded-lg shadow-sm mb-4">
                            <p class="text-black dark:text-black">{{ $comunicado->comunicado }}</p> <!-- Texto preto em ambos os temas -->
                        </div>

                        <p class="text-gray-800 dark:text-gray-200"><strong>Data de postagem:</strong> {{ \Carbon\Carbon::parse($comunicado->datacomunicado)->format('d/m/Y') }}</p>

                        @if(auth()->user()->id === $comunicado->id_professor)
                            <div class="mt-4 flex space-x-4">
                                <a class="bg-[#6bb6c0] text-white py-2 px-4 rounded hover:bg-[#8ab3b6] transition duration-150" href="/editar-comunicado/{{ $comunicado->id }}">
                                    Editar
                                </a>
                                <a class="bg-[#6bb6c0] text-white py-2 px-4 rounded hover:bg-[#8ab3b6] transition duration-150" href="/excluir-comunicado/{{ $comunicado->id }}">
                                    Excluir
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
