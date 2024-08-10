<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <link rel="stylesheet" href="stylefooter.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Fórum de Dúvidas') }}
        </h2>
    </x-slot>

    @if(auth()->user()->nivel_acesso === 'aluno')
        <div class="py-6"> <!-- Ajustei o padding vertical -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <a class="bg-[#9dc8ce] text-white py-2 px-4 rounded inline-block hover:bg-[#8ab3b6] transition duration-150" href="/adicionarDuvida">
                            Adicionar dúvida
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Container para as dúvidas -->
    <div class="py-8"> <!-- Ajustei o padding vertical -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @forelse($duvida as $duvida)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <!-- Título da dúvida -->
                        <p class="text-xl text-[#1a202c] font-semibold mb-4 underline">{{ $duvida->nome }}</p>

                        <!-- Mensagem da dúvida -->
                        <div class="bg-[#F4F4F4] border border-[#e2e8f0] p-4 rounded-lg shadow-sm mb-4">
                            <p class="text-black dark:text-black">{{ $duvida->mensagem }}</p>
                        </div>

                        <!-- Detalhes da dúvida -->
                        <p class="text-gray-800 dark:text-gray-200 mb-2"><strong>Autor:</strong> {{ $duvida->user ? $duvida->user->name : 'Não disponível' }}</p>
                        <p class="text-gray-800 dark:text-gray-200 mb-2"><strong>Turma:</strong> {{ $duvida->turma->nome ?? 'Não associada' }}</p>
                        <p class="text-gray-800 dark:text-gray-200"><strong>Data de postagem:</strong> {{ \Carbon\Carbon::parse($duvida->dataforum)->format('d/m/Y') }}</p>

                        @if(auth()->user()->id === $duvida->id_aluno)
                            <div class="mt-4 flex space-x-4">
                                <a class="bg-[#9dc8ce] text-white py-2 px-4 rounded hover:bg-[#8ab3b6] transition duration-150" href="/editar-duvida/{{ $duvida->id }}">
                                    Editar
                                </a>
                                <a class="bg-[#9dc8ce] text-white py-2 px-4 rounded hover:bg-[#8ab3b6] transition duration-150" href="/excluir-duvida/{{ $duvida->id }}">
                                    Excluir
                                </a>
                            </div>
                        @endif

                        @if(auth()->user()->nivel_acesso === 'aluno')
                            <a class="bg-[#9dc8ce] text-white py-2 px-4 rounded inline-block hover:bg-[#8ab3b6] transition duration-150 mt-4 responder-link" href="#" data-duvida-id="{{ $duvida->id }}">
                                Responder
                            </a>
                        @endif

                        <!-- Formulário de Resposta -->
                        <div id="formularioResponder" style="display: none;">
                            <h2 class="text-lg font-semibold mb-4">Responder Dúvida</h2>
                            <form id="responderDuvidaForm" method="POST" action="/responder-duvida/{{ $duvida->id }}">
                                @csrf
                                <input type="hidden" id="duvidaId" name="duvidaId" value="">
                                <label for="resposta" class="block mb-2">Sua Resposta:</label>
                                <textarea id="resposta" name="resposta" rows="4" required class="w-full border-gray-300 rounded-lg p-2"></textarea><br><br>
                                <button type="submit" class="bg-[#9dc8ce] text-white py-2 px-4 rounded hover:bg-[#8ab3b6] transition duration-150">
                                    Enviar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 dark:text-gray-300">Nenhuma dúvida disponível.</p>
            @endforelse
        </div>
    </div>

    @include('layouts._rodape')
</x-app-layout>

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

                // Alter
