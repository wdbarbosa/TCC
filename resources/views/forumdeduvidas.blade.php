<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <link rel="stylesheet" href="stylefooter.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Comunicados') }}
        </h2>
    </x-slot>

    @if(auth()->user()->nivel_acesso === 'aluno')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                        <a class="dropdown-item" href="/adicionarDuvida">Adicionar duvida</a>

                </div>
            </div>
            @endif
            <br>
            <br>

            @forelse($duvida as $duvida)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <p class="text-lg font-semibold">Título: {{ $duvida->nome }}</p>
                    <p class="text-lg font-semibold">Mensagem: {{ $duvida->mensagem }}</p>
                    <p class="text-lg font-semibold">Autor: {{ $duvida->user ? $duvida->user->name : 'Não disponível' }}</p>
                    <br>
                    <p class="text-lg font-semibold">Data de postagem: {{ \Carbon\Carbon::parse($duvida->dataforum)->format('d/m/Y') }}</p>
                    <br>
                    @if(auth()->user()->id === $duvida->id_aluno)
                        <a class="dropdown-item" href="/editar-duvida/{{ $duvida->id }}">Editar</a><br>
                        <a class="dropdown-item" href="/excluir-duvida/{{ $duvida->id }}">Excluir</a><br>
                    @endif
                    <a class="dropdown-item" href="/responder-duvida/{{ $duvida->id }}">Responder</a><br>
                </div>
            </div>
            <br>
            <br>
            @empty
                <p class="text-gray-600 dark:text-gray-300">Nenhuma duvida disponível.</p>
            @endforelse

        </div>
    </div>

    @include('layouts._rodape')
</x-app-layout>
