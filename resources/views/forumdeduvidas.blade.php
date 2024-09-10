
<link rel="stylesheet" href="stylefooter.css">

<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')

    <x-slot name="header">
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
        @forelse($duvidas as $duvida)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6">
                <p class="text-xl font-semibold mb-4 underline">{{ $duvida->nome }}</p>
                <p>Dúvida:</p>
                <div class="bg-[#F4F4F4] border border-[#e2e8f0] p-4 rounded-lg shadow-sm mb-4">
                    <p class="text-black dark:text-black">{{ $duvida->mensagem }}</p>
                </div>
                <p class="text-gray-800 dark:text-gray-200 mb-2"><strong>Autor:</strong> {{ $duvida->user ? $duvida->user->name : 'Não disponível' }}</p>
                <p class="text-gray-800 dark:text-gray-200 mb-2"><strong>Turma:</strong> {{ $duvida->turma->nome ?? 'Não associada' }}</p>
                <p class="text-gray-800 dark:text-gray-200"><strong>Data de postagem:</strong> {{ \Carbon\Carbon::parse($duvida->dataforum)->format('d/m/Y') }}</p>

                @if(auth()->user()->nivel_acesso === 'aluno')
                        <form action="{{ route('responder-duvida', $duvida->id) }}" method="POST">
                            @csrf
                            <strong>Responder:</strong>
                            <textarea name="resposta" id="resposta" rows="4" required class="w-full border-gray-300 rounded-lg p-2"></textarea>
                            <button type="submit" class="bg-[#6bb6c0] text-white py-2 px-4 rounded hover:bg-[#7fb2b8] transition duration-150 mt-2">
                                Responder
                            </button>
                        </form>
                    @endif

                <!-- Botão para mostrar/ocultar respostas -->
                <button class="bg-[#6bb6c0] text-white py-2 px-4 rounded hover:bg-[#7fb2b8] transition duration-150 mt-4 toggle-respostas" data-id="{{ $duvida->id }}">
                    Respostas <span id="icon-{{ $duvida->id }}">▼</span>
                </button>

                <!-- Div com as respostas (escondida por padrão) -->
                <div id="respostas-{{ $duvida->id }}" class="respostas mt-4 hidden">
                    @if(isset($respostas[$duvida->id]) && $respostas[$duvida->id]->isNotEmpty())
                        @foreach($respostas[$duvida->id] as $resposta)
                            <div class="resposta bg-gray-100 p-4 mb-4 rounded-lg shadow-sm">
                                <p>{{ $resposta->resposta }}</p>
                                <p class="text-sm text-gray-500">Postado por: {{ $resposta->aluno->name }} em {{ \Carbon\Carbon::parse($resposta->dataresposta)->format('d/m/Y') }}</p>
                                
                                @if(auth()->user()->id === $resposta->id_user)
                                    <form action="{{ route('editar-resposta', $resposta->id) }}" class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <button class="px-2 py-1 rounded-lg bg-[#6bb6c0] text-white hover:bg-[#7fb2b8]">Editar</button>
                                    </form>
                                    <form action="{{ route('excluir-resposta', $resposta->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 rounded-lg bg-[#6bb6c0] text-white hover:bg-[#7fb2b8]">Excluir</button>
                                    </form>
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
    document.querySelectorAll('.toggle-respostas').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const respostasDiv = document.getElementById(`respostas-${id}`);
            const icon = document.getElementById(`icon-${id}`);

            if (respostasDiv.classList.contains('hidden')) {
                respostasDiv.classList.remove('hidden');
                icon.textContent = '▲'; // Muda o ícone para seta para cima
            } else {
                respostasDiv.classList.add('hidden');
                icon.textContent = '▼'; // Muda o ícone para seta para baixo
            }
        });
    });
</script>


    @include('layouts._rodape')
</x-app-layout>
