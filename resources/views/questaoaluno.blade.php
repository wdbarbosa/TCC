<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <link rel="stylesheet" href="{{ asset('stylefooter.css')}}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            <a href="{{ route('aluno.bancas', ['disciplinaId' => $disciplinaId]) }}" class="mr-4" alt="Voltar">
                <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
            </a>
            {{ __('Questões') }}
        </h2>
    </x-slot>

    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if($questoes->count() > 0)
                            <!-- Paginação -->
                            <div class="flex justify-between mb-4">
                                @if ($questoes->previousPageUrl())
                                    <a href="{{ $questoes->previousPageUrl() }}" class="flex items-center text-black py-2 px-4 rounded hover:underline transition duration-150">
                                        <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 transform mr-2"> Questão Anterior
                                    </a>
                                @endif
                                @if ($questoes->nextPageUrl())
                                    <a href="{{ $questoes->nextPageUrl() }}" class="flex items-center text-black py-2 px-4 rounded hover:underline transition duration-150">
                                        Próxima Questão <img src="{{ asset('img/voltar.png') }}"  alt="Próxima" class="w-6 rotate-180 h-6 ml-2">
                                    </a>
                                @endif
                            </div>

                            <!-- Formulário de Questão -->
                            @foreach($questoes as $questao)
                                <form action="{{ route('aluno.responder') }}" method="POST">
                                    @csrf
                                    <strong><p>({{ $questao->banca }})</p><input type="hidden" name="questao_id" value="{{ $questao->id }}"></strong>
                                    <p>{{ $questao->enunciado }}</p>
                                    <br><br>
                                    
                                    <input type="radio" name="resposta" value="A" required> <strong>A)</strong> {{ $questao->alternativa_a }} <br>
                                    <input type="radio" name="resposta" value="B" required> <strong>B)</strong> {{ $questao->alternativa_b }} <br>
                                    <input type="radio" name="resposta" value="C" required> <strong>C)</strong> {{ $questao->alternativa_c }} <br>
                                    <input type="radio" name="resposta" value="D" required> <strong>D)</strong> {{ $questao->alternativa_d }} <br>
                                    <input type="radio" name="resposta" value="E" required> <strong>E)</strong> {{ $questao->alternativa_e }} <br>
                                    <br>
                                    <button type="submit" class="bg-[#6bb6c0] text-white py-2 px-4 rounded hover:bg-[#8ab3b6] transition duration-150">Salvar Resposta</button>
                                </form>
                                
                                @if(session('questaoRespondida') == $questao->id)
                                    <div class="mt-3">
                                    @if(session('respostaCorreta'))
                                        <p class="text-green-500">Parabéns, você acertou!</p>
                                        <p><strong>Resposta correta:</strong> {{ session('respostaCorretaTexto') }}</p>
                                    @else
                                        <p class="text-red-500">Infelizmente, você errou.</p>
                                        <p><strong>Resposta correta:</strong> {{ session('respostaCorretaTexto') }}</p>
                                    @endif
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <p>Nenhuma questão encontrada.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts._rodape')
</x-app-layout>
