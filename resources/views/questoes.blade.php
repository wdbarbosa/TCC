<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="stylefooter.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Questões') }}
            <a href="{{ route('questoes.criar') }}">Adicionar Questão</a>
        </h2>
    </x-slot>

    @section('content')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <a href="{{ route('questoes.criar') }}">Adicionar Questão</a>
                        <ul>
                            @foreach($questaos as $questao)
                                <li>
                                    {{ $questao->banca }} - {{ $questao->disciplina->disciplina_descricao }}
                                    <a href="{{ route('questoes.editar', $questao) }}">Editar</a>
                                    <form action="{{ route('questoes.deletar', $questao) }}" method="POST" style="display:inline;">
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
    @endsection

    @include('layouts._rodape')
</x-app-layout>