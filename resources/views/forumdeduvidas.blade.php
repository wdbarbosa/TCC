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
                    <a class="dropdown-item responder-link" href="#" data-duvida-id="{{ $duvida->id }}">Responder</a><br>
                    <!-- Formulário de Resposta -->
                    <div id="formularioResponder" style="display: none;">
                        <h2>Responder Dúvida</h2>
                        <form id="responderDuvidaForm" method="POST" action="/responder-duvida/{{ $duvida->id }}">
                            @csrf
                            <input type="hidden" id="duvidaId" name="duvidaId" value="">
                            <label for="resposta">Sua Resposta:</label>
                            <textarea id="resposta" name="resposta" required></textarea><br><br>
                            <button type="submit">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <br>
            @empty
                <p class="text-gray-600 dark:text-gray-300">Nenhuma duvida disponível.</p>
            @endforelse

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Seleciona todos os links "Responder" pela classe
            const responderLinks = document.querySelectorAll('.responder-link');
            const formulario = document.getElementById('formularioResponder');
            const duvidaIdInput = document.getElementById('duvidaId');

            responderLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Evita o comportamento padrão do link

                    // Obtém o ID da dúvida do atributo data-duvida-id
                    const duvidaId = this.getAttribute('data-duvida-id');
                    duvidaIdInput.value = duvidaId; // Define o valor do campo oculto com o ID da dúvida

                    // Alterna a exibição do formulário
                    formulario.style.display = formulario.style.display === 'none' ? 'block' : 'none';
                });
            });
        });
    </script>

    @include('layouts._rodape')
</x-app-layout>
