<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
        <link rel="stylesheet" href="styleforumdeduvidas.css">

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Fórum de Dúvidas') }}
        </h2>
    </x-slot>

    @if(auth()->user()->nivel_acesso === 'aluno')
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg"> 
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
            @forelse($duvidas->sortByDesc('created_at') as $duvida)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg p-6">
                    <p class="text-xl text-white font-semibold mb-4 sm:rounded colorido">{{ $duvida->nome }}</p>
                    <p>Dúvida:</p>
                    <div class="bg-[#F4F4F4] border border-[#e2e8f0] p-4 rounded-lg shadow-sm mb-4">
                        <p class="text-black dark:text-black">{{ $duvida->mensagem }}</p>
                    </div>
                    <p class="text-gray-800 dark:text-gray-200 mb-2"><strong>Autor:</strong> {{ $duvida->user ? $duvida->user->name : 'Não disponível' }}</p>
                    <p class="text-gray-800 dark:text-gray-200 mb-5"><strong>Data de postagem:</strong> {{ \Carbon\Carbon::parse($duvida->dataforum)->format('d/m/Y') }}</p>


                    @if(auth()->user()->nivel_acesso === 'aluno')
                    @if(auth()->user()->id === $duvida->id_aluno)
                        <div class="mt-4 flex space-x-4">
                            <form action="{{ route('editar-duvida', $duvida->id) }}" method="GET" class="inline-block">
                                @csrf
                                <button type="submit" class="bg-[#6bb6c0] text-white py-2 px-4 rounded hover:bg-[#7fb2b8] transition duration-150 espaco">
                                    Editar
                                </button>
                            </form>
                            <form action="{{ route('excluir-duvida', $duvida->id) }}" method="GET" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-[#6bb6c0] text-white py-2 px-4 rounded hover:bg-[#7fb2b8] transition duration-150 espaco">
                                    Excluir
                                </button>
                            </form>
                        </div><br>
                    @endif
                    @endif


                    @if(auth()->user()->nivel_acesso === 'aluno' || auth()->user()->nivel_acesso === 'professor')
                        <hr class="mb-5">
                        <button class="bg-[#6bb6c0] text-white py-2 px-4 rounded hover:bg-[#7fb2b8] transition duration-150 toggle-responder mb-4" data-id="{{ $duvida->id }}">
                            Responder
                        </button>
                        <div id="responder-{{ $duvida->id }}" class="responder mt-4 hidden">
                            <p class="text-gray-800 dark:text-gray-200 p-3"><strong>Escreva a sua resposta:</strong></p>
                            <form action="{{ route('responder-duvida', $duvida->id) }}" method="POST">
                                @csrf
                                <textarea name="resposta" id="resposta" rows="4" required class="w-full border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                                <button type="submit" class="bg-[#6bb6c0] text-white py-2 px-4 rounded hover:bg-[#7fb2b8] transition duration-150 mt-2 mb-6">
                                    Enviar 
                                </button>
                            </form>
                        </div>
                        
                    @endif
                    <br>

                    @if(auth()->user()->id === $duvida->id_user)
                        <!-- Adicionar este debug temporário -->
                        <p>Debug: auth()->user()->id = {{ auth()->user()->id }} / duvida->id_user = {{ $duvida->id_user }}</p>
                        <!-- Fim do debug -->
                        
                        <!-- Botão de editar dúvida -->
                        <form action="{{ route('edit', $duvida->id) }}" class="inline-block">
                            @csrf
                            @method('GET')
                            <button class="px-2 py-1 rounded-lg bg-[#6bb6c0] text-white hover:bg-[#7fb2b8]">Editar</button>
                        </form>

                        <!-- Botão de excluir dúvida -->
                        <form action="{{ route('destroy', $duvida->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Você tem certeza que deseja excluir esta dúvida?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 rounded-lg bg-[#6bb6c0] text-white hover:bg-[#7fb2b8]">Excluir</button>
                        </form>
                    @endif

                    <!-- Botão para mostrar/ocultar respostas -->
                    @if(isset($respostas[$duvida->id]) && $respostas[$duvida->id]->isNotEmpty())
                        <button class="toggle-respostas" data-id="{{ $duvida->id }}">
                            <u>Respostas</u> <span id="icon-{{ $duvida->id }}">▼</span>
                        </button>
                    @endif

                    <!-- Div com as respostas (escondida por padrão) -->
                    <div id="respostas-{{ $duvida->id }}" class="respostas mt-4 hidden">
                        @if(isset($respostas[$duvida->id]) && $respostas[$duvida->id]->isNotEmpty())
                            @foreach($respostas[$duvida->id] as $resposta)
                                <div class="resposta bg-gray-100 p-4 mb-4 rounded-lg shadow-sm">
                                    <p>{{ $resposta->resposta }}</p>
                                    <p class="text-sm text-gray-500">Postado por: {{ $resposta->aluno }} em {{ \Carbon\Carbon::parse($resposta->dataresposta)->format('d/m/Y') }}</p>
                                    
                                    @if(auth()->user()->id === $resposta->id_user)
                                        <form action="{{ route('editar-resposta', $resposta->id) }}" class="inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button class="px-2 py-1 rounded-lg bg-[#6bb6c0] text-white hover:bg-[#7fb2b8] mt-2">Editar</button>
                                        </form>
                                        <form action="{{ route('excluir-resposta', $resposta->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 rounded-lg bg-[#6bb6c0] text-white hover:bg-[#7fb2b8] mt-2">Excluir</button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-600 dark:text-gray-300">Nenhuma dúvida disponível.</p>
            @endforelse
        </div>
    </div>

    <script>
        document.querySelectorAll('.toggle-responder').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const responderDiv = document.getElementById(`responder-${id}`);

                if (responderDiv.classList.contains('hidden')) {
                    responderDiv.classList.remove('hidden');
                } else {
                    responderDiv.classList.add('hidden');
                }
            });
        });

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
