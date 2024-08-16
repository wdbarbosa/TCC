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
                    <a class="dropdown-item" href="/adicionarDuvida">Adicionar dúvida</a>
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
                    @if(auth()->user()->id === $duvida->id_user)
                        <a class="dropdown-item" href="/editar-duvida/{{ $duvida->id }}">Editar</a><br>
                        <a class="dropdown-item" href="/excluir-duvida/{{ $duvida->id }}">Excluir</a><br>
                    @endif
                    <a class="dropdown-item responder-link" href="#" data-duvida-id="{{ $duvida->id }}">Responder</a><br>
                    
                    <!-- Formulário de Resposta -->
                    <div class="formulario-responder" id="formularioResponder-{{ $duvida->id }}" style="display: none;">
                        <h2>Responder Dúvida</h2>
                        <form id="responderDuvida-{{ $duvida->id }}" method="POST" action="{{ route('responder-duvida', $duvida->id) }}">
                            @csrf
                            <input type="hidden" name="id_user" value="{{ auth()->user()->id }}"> 
                            <input type="hidden" name="id_duvida" value="{{ $duvida->id }}">
                            <label for="resposta">Sua Resposta:</label>
                            <div>
                                <textarea id="resposta" class="block mt-1 w-full" name="resposta" required autofocus>{{ old('resposta') }}</textarea>
                                <x-input-error :messages="$errors->get('resposta')" class="mt-2" />
                            </div><br><br>
                            <button type="submit">Enviar</button>
                        </form>
                    </div>
                    
                    <!-- Respostas -->
                    <div class="respostas mt-4">
                        @if($duvida->respostaforum && $duvida->respostaforum->isNotEmpty())
                            @foreach($duvida->respostaforum as $resposta)
                            <div class="resposta bg-gray-100 p-4 mb-2 rounded-lg">
                                <p>{{ $resposta->resposta }}</p>
                                <p class="text-sm text-gray-500">Postado por: {{ $resposta->user->name }} em {{ \Carbon\Carbon::parse($resposta->dataresposta)->format('d/m/Y') }}</p>
                                @if(auth()->user()->id === $resposta->id_user)
                                    <button class="editar-resposta-btn" data-resposta-id="{{ $resposta->id }}">Editar</button>
                                    <button class="excluir-resposta-btn" data-resposta-id="{{ $resposta->id }}">Excluir</button>
                                @endif
                            </div>
                            @endforeach
                        @else
                            <p class="text-gray-600 dark:text-gray-300">Nenhuma resposta disponível.</p>
                        @endif
                    </div>

                </div>
            </div>
            <br>
            <br>
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
                    const formulario = document.getElementById(`formularioResponder-${duvidaId}`);
                    
                    // Alterna a exibição do formulário
                    formulario.style.display = formulario.style.display === 'none' ? 'block' : 'none';
                });
            });

            // Editar resposta
            document.querySelectorAll('.editar-resposta-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const respostaId = this.getAttribute('data-resposta-id');
                    const respostaDiv = this.parentElement;
                    const respostaTexto = respostaDiv.querySelector('p').textContent;
                    
                    const novaResposta = prompt("Digite a nova resposta:", respostaTexto);

                    if (novaResposta !== null) {
                        fetch(`/atualizar-resposta/${respostaId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                resposta: novaResposta
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                respostaDiv.querySelector('p').textContent = novaResposta;
                            }
                        });
                    }
                });
            });

            // Excluir resposta
            document.querySelectorAll('.excluir-resposta-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const respostaId = this.getAttribute('data-resposta-id');

                    if (confirm('Você tem certeza de que deseja excluir esta resposta?')) {
                        fetch(`/excluir-resposta/${respostaId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.parentElement.remove();
                            }
                        });
                    }
                });
            });
        });
    </script>

    @include('layouts._rodape')
</x-app-layout>
