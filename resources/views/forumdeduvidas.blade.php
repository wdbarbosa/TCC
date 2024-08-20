<x-app-layout>
    @section('title', 'Fórum de Dúvidas')
    <x-slot name="header">
    <link rel="stylesheet" href="{{ asset('stylefooter.css')}}">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Fórum de Dúvidas') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="{{ asset('stylefooter.css')}}">

    @if(auth()->user()->nivel_acesso === 'aluno')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                        <a class="dropdown-item" href="/adicionarDuvida">Adicionar dúvida</a>

                </div>
            </div>
        </div>
    @endif

    <!-- Container para as dúvidas -->
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @forelse($duvida as $duvida)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-lg font-semibold">Título: {{ $duvida->nome }}</p>
                    <p class="text-lg font-semibold">Mensagem: {{ $duvida->mensagem }}</p>
                    <p class="text-lg font-semibold">Autor: {{ $duvida->user ? $duvida->user->name : 'Não disponível' }}</p>
                    <br>
                    <p class="text-lg font-semibold">Data de postagem: {{ \Carbon\Carbon::parse($duvida->created_at)->format('d/m/Y') }}</p>
                    <br>
                    @if(auth()->user()->id === $duvida->id_aluno)
                        <a class="dropdown-item" href="/editar-duvida/{{ $duvida->id }}">Editar</a><br>
                        <a class="dropdown-item" href="/excluir-duvida/{{ $duvida->id }}">Excluir</a><br>
                    @endif
                    <a class="dropdown-item responder-link" href="#" data-duvida-id="{{ $duvida->id }}">Responder</a><br>

                    <!-- Respostas -->
                    <div class="respostas mt-4">
                        @if(isset($respostas[$duvida->id]) && $respostas[$duvida->id]->isNotEmpty())
                            @foreach($respostas[$duvida->id] as $resposta)
                                <div class="resposta bg-gray-100 p-4 mb-4 rounded-lg">
                                    <p>{{ $resposta->resposta }}</p>
                                    <p class="text-sm text-gray-500">Postado por: {{ $resposta->aluno->name }} em {{ \Carbon\Carbon::parse($resposta->data_resposta)->format('d/m/Y') }}</p>
                                    @if(auth()->user()->id === $resposta->id_user)
                                        <button class="editar-resposta-btn bg-yellow-500 text-white px-2 py-1 rounded-lg" data-resposta-id="{{ $resposta->id }}">Editar</button>
                                        <button class="excluir-resposta-btn bg-red-500 text-white px-2 py-1 rounded-lg" data-resposta-id="{{ $resposta->id }}">Excluir</button>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-600 dark:text-gray-300">Nenhuma resposta disponível.</p>
                        @endif
                    </div>

                    <!-- Formulário de Resposta -->
                    <div class="formulario-responder mt-4 hidden">
                        <h2 class="text-xl font-semibold">Responder Dúvida</h2>
                        <form action="{{ route('responder-duvida', $duvida->id) }}" method="POST">
                            @csrf
                            <textarea name="resposta" rows="4" required></textarea>
                            <button type="submit">Responder</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 dark:text-gray-300">Nenhuma dúvida disponível.</p>
            @endforelse
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const responderLinks = document.querySelectorAll('.responder-link');
            responderLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const duvidaId = this.getAttribute('data-duvida-id');
                    const formulario = this.closest('div.bg-white').querySelector('.formulario-responder');
                    formulario.classList.toggle('hidden');
                    // Remove o valor antigo do campo data-duvida-id para evitar problemas
                    formulario.querySelector('textarea').setAttribute('data-duvida-id', duvidaId);
                });
            });
        });
    </script>
    @include('layouts._rodape')
</x-app-layout>
