<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <link rel="stylesheet" href="{{ asset('stylefooter.css')}}">
    <link rel="stylesheet" href="{{ asset('stylecheck.css') }}">
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

                            @foreach($questoes as $questao)
                                <form action="{{ route('aluno.responder') }}" method="POST">
                                    @csrf
                                    <strong><p>({{ $questao->banca }})</p><input type="hidden" name="questao_id" value="{{ $questao->id }}"></strong>
                                    <p>{{ $questao->enunciado }}</p>
                                    
                                    @if($questao->image_path)
                                        <img src="{{ asset('storage/' . $questao->image_path) }}" alt="Imagem da questão" class="mt-4 mb-4">
                                    @endif

                                    <br><br>

                                    
                                    @if($questao->alternativa_a)
                                    <p> <input type="radio" class="form-radio h-4 w-4 text-cyan-600 transition duration-150 ease-in-out" name="resposta" value="A" required> <strong class="ml-1">A)</strong> {{ $questao->alternativa_a }} </p>
                                    @endif

                                    @if($questao->alternativa_b)
                                    <p> <input type="radio" class="form-radio h-4 w-4 text-cyan-600 transition duration-150 ease-in-out" name="resposta" value="B" required> <strong class="ml-1">B)</strong> {{ $questao->alternativa_b }} </p>
                                    @endif

                                    @if($questao->alternativa_c)
                                    <p> <input type="radio" class="form-radio h-4 w-4 text-cyan-600 transition duration-150 ease-in-out" name="resposta" value="C" required> <strong class="ml-1">C)</strong> {{ $questao->alternativa_c }} </p>
                                    @endif

                                    @if($questao->alternativa_d)
                                    <p> <input type="radio" class="form-radio h-4 w-4 text-cyan-600 transition duration-150 ease-in-out" name="resposta" value="D" required> <strong class="ml-1">D)</strong> {{ $questao->alternativa_d }} </p>
                                    @endif

                                    @if($questao->alternativa_e)
                                    <p> <input type="radio" class="form-radio h-4 w-4 text-cyan-600 transition duration-150 ease-in-out" name="resposta" value="E" required> <strong class="ml-1">E)</strong> {{ $questao->alternativa_e }} </p>
                                    @endif
                                    <br>
                                    <button type="submit" class="bg-[#6bb6c0] text-white py-2 px-4 rounded hover:bg-[#8ab3b6] transition duration-150">Responder</button>
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
