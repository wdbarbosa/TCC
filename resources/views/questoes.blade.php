<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="stylefooter.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Questões') }}
        </h2>
    </x-slot>

    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <a href="{{ route('questoes.criar') }}">Adicionar Questão</a>
                        <ul>
                            @foreach($questoes as $questao)
                                <li>
                                    <strong>Enunciado:</strong> {{ $questao->banca }} <br>
                                    <strong>Alternativa A:</strong> {{ $questao->alternativa_a }} <br>
                                    <strong>Alternativa B:</strong> {{ $questao->alternativa_b }} <br>
                                    <strong>Alternativa C:</strong> {{ $questao->alternativa_c }} <br>
                                    <strong>Alternativa D:</strong> {{ $questao->alternativa_d }} <br>
                                    <strong>Alternativa E:</strong> {{ $questao->alternativa_e }} <br>
                                    <strong>Alternativa Correta:</strong> {{ $questao->alternativacorreta }} <br>
                                    <strong>Disciplina:</strong> {{ $questao->disciplina->disciplina_descricao }} <br>
                                    <a href="{{ route('questoes.editar', $questao->id_questao) }}">Editar</a>
                                    <form action="{{ route('questoes.deletar', $questao->id_questao) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Excluir</button>
                                    </form>
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