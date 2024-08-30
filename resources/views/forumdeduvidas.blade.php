<x-app-layout>
    @section('title', 'Fórum de Dúvidas')
    
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Fórum de Dúvidas') }}
        </h2>
    </x-slot>

    @if(auth()->user()->nivel_acesso === 'aluno')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg"> <!-- Adicionado shadow-lg -->
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <a class="bg-[#6bb6c0] text-white py-2 px-4 rounded inline-block hover:bg-[#7fb2b8] transition duration-150" href="/adicionarDuvida">
                            Adicionar dúvida
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Container para as dúvidas -->
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @forelse($duvida as $duvida)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6"> <!-- Adicionado shadow-lg -->
                    <p class="text-xl font-semibold mb-4 underline">{{ $duvida->nome }}</p>
                    <p>Dúvida:</p>

                    <div class="bg-[#F4F4F4] border border-[#e2e8f0] p-4 rounded-lg shadow-sm mb-4">
                        <p class="text-black dark:text-black">{{ $duvida->mensagem }}</p>
                    </div>
                    <p class="text-gray-800 dark:text-gray-200 mb-2"><strong>Autor:</strong> {{ $duvida->user ? $duvida->user->name : 'Não disponível' }}</p>
                    <p class="text-gray-800 dark:text-gray-200 mb-2"><strong>Turma:</strong> {{ $duvida->turma->nome ?? 'Não associada' }}</p>
                    <p class="text-gray-800 dark:text-gray-200"><strong>Data de postagem:</strong> {{ \Carbon\Carbon::parse($duvida->dataforum)->format('d/m/Y') }}</p>

                    @if(auth()->user()->id === $duvida->id_aluno)
                        <div class="mt-4 flex space-x-4">
                            <a class="bg-[#9dc8ce] text-white py-2 px-4 rounded hover:bg-[#7fb2b8] transition duration-150" href="/editar-duvida/{{ $duvida->id }}">
                                Editar
                            </a>
                            <a class="bg-[#9dc8ce] text-white py-2 px-4 rounded hover:bg-[#7fb2b8] transition duration-150" href="/excluir-duvida/{{ $duvida->id }}">
                                Excluir
                            </a>
                        </div>
                    @endif

                    @if(auth()->user()->nivel_acesso === 'aluno')
                        <a class="bg-[#6bb6c0] text-white py-2 px-4 rounded inline-block hover:bg-[#7fb2b8] transition duration-150 mt-4 responder-link" href="#" data-duvida-id="{{ $duvida->id }}">
                            Responder
                        </a>
                    @endif

                    <!-- Formulário de Resposta -->
                    <div class="formulario-responder mt-7 hidden">
                        <h2 class="text-lg font-semibold mb-4">Responder Dúvida:</h2>
                        <form action="/responder-duvida/{{ $duvida->id }}" method="POST">
                            @csrf
                            <textarea name="resposta" id="resposta" rows="4" required class="w-full border-gray-300 rounded-lg p-2"></textarea>
                            <button type="submit" class="bg-[#6bb6c0] text-white py-2 px-4 rounded hover:bg-[#7fb2b8] transition duration-150 mt-2">
                                Enviar
                            </button>
                        </form>
                    </div>

                    <div class="respostas mt-4">
                        @if(isset($respostas[$duvida->id]) && $respostas[$duvida->id]->isNotEmpty())
                            @foreach($respostas[$duvida->id] as $resposta)
                            <strong>Respostas:</strong>
                                <div class="resposta bg-gray-100 p-4 mb-4 rounded-lg shadow-sm"> <!-- Adicionado shadow-sm -->
                                    <p>{{ $resposta->resposta }}</p>
                                    <p class="text-sm text-gray-500">Postado por: {{ $resposta->aluno->name }} em {{ \Carbon\Carbon::parse($resposta->data_resposta)->format('d/m/Y') }}</p>
                                    @if(auth()->user()->id === $resposta->id_user)
                                        <button class="px-2 py-1 rounded-lg bg-[#6bb6c0] text-white hover:bg-[#7fb2b8]" data-resposta-id="{{ $resposta->id }}" href="">Editar</button>
                                        <button class="px-2 py-1 rounded-lg bg-[#6bb6c0] text-white hover:bg-[#7fb2b8]" data-resposta-id="{{ $resposta->id }}" onclick="destroyResource(this)";>Excluir</button>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-600 dark:text-gray-300">Nenhuma resposta disponível.</p>
                        @endif
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
                    formulario.querySelector('textarea').setAttribute('data-duvida-id', duvidaId);
                });
            });
        });

        async function destroyResource(button) {
            const id = button.getAttribute('data-resposta-id');
            
            if (!confirm('Você tem certeza que deseja excluir?')) {
                return; // Se o usuário cancelar, não faz nada
            }

            try {
                const response = await fetch(`/forumdeduvidas/${id}`, {
                    method: 'destroy',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Laravel CSRF token
                    }
                });

                const data = await response.json(); // Obtém o JSON da resposta

                if (response.ok) {
                    alert(data.message); // Exibe a mensagem de sucesso
                    // Opcional: Atualizar a página ou remover o item da interface
                    window.location.reload(); // Recarregar a página para refletir a exclusão
                } else {
                    alert(data.message); // Exibe a mensagem de erro
                }
            } catch (error) {
                console.error('Erro:', error);
                alert('Erro ao excluir o recurso.');
            }
        }
    </script>

    @include('layouts._rodape')
</x-app-layout>
