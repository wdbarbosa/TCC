<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Questões') }}
        </h2>
    </x-slot>

    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <ul>
                            @foreach($questoes as $questao)
                                <li>
                                    <p>{{ $questao->enunciado }}</p>
                                    <p>Sua resposta: {{ $request->resposta[$questao->id] }}</p>
                                    <p>Resposta correta: {{ $questao->alternativacorreta }}</p>
                                    <p>
                                    @if($request->resposta[$questao->id] == $questao->alternativacorreta)
                                        <span style="color: green;">Você acertou!</span>
                                    @else
                                        <span style="color: red;">Você errou!</span>
                                    @endif
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts._rodape')
</x-app-layout>







