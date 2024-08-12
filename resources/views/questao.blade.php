<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <link rel="stylesheet" href="stylefooter.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bancas') }}
        </h2>
    </x-slot>

    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('aluno.responder') }}" method="POST">
                        @csrf
                        <ul>
                            @foreach($questoes as $questao)
                                <li>
                                    <p>{{ $questao->enunciado }}</p>
                                    <input type="radio" name="resposta[{{ $questao->id }}]" value="A"> {{ $questao->alternativa_a }} <br>
                                    <input type="radio" name="resposta[{{ $questao->id }}]" value="B"> {{ $questao->alternativa_b }} <br>
                                    <input type="radio" name="resposta[{{ $questao->id }}]}" value="C"> {{ $questao->alternativa_c }} <br>
                                    <input type="radio" name="resposta[{{ $questao->id }}]}" value="D"> {{ $questao->alternativa_d }} <br>
                                    <input type="radio" name="resposta[{{ $questao->id }}]}" value="E"> {{ $questao->alternativa_e }} <br>
                                </li>
                            <input type="hidden" name="questoes_ids[]" value="{{ $questao->id }}">
                            @endforeach
                        </ul>
                        <button type="submit">Enviar Respostas</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts._rodape')
</x-app-layout>


