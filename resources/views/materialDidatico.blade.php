<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Materiais Didáticos - {{ $disciplina->nome_disciplina }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
    <link rel="stylesheet" href="{{ asset('stylematerial.css') }}">

    <div class="py-6"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a class="bg-[#9dc8ce] text-white py-2 px-4 rounded inline-block hover:bg-[#8ab3b6] transition duration-150" href="{{ route('materiais.criar', ['id' => $disciplina->id, 'turmaId' => $turma->id]) }}">
                        Adicionar Questão
                    </a>
                </div>
            </div>
        </div>
    </div>

    <main>
        <div class="py-12">
            <div class="container-materiais max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3>Lista de Materiais Didáticos</h3>

                        @if (session('success'))
                            <div class="alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($materiais->isEmpty())
                            <p>Nenhum material cadastrado para esta disciplina.</p>
                        @else
                        <ul class="lista-materiais">
                            @foreach($materiais as $material)
                                <li>
                                    <h4>{{ $material->titulo }}</h4>
                                    <p>{{ $material->conteudo }}</p>
                                    <p><strong>Playlist:</strong> {{ $material->playlist }}</p>

                                    @if ($material->pdf)
                                        <p><strong>PDF:</strong> <a href="{{ asset('storage/' . $material->pdf) }}" target="_blank">Baixar PDF</a></p>
                                    @endif

                                    @if ($material->slide)
                                        <p><strong>Slide:</strong> <a href="{{ asset('storage/' . $material->slide) }}" target="_blank">Baixar Slide</a></p>
                                    @endif

                                    <a href="{{ route('materiais.editar', [$disciplina->id, $material->id, $turma->id]) }}">Editar</a>
                                    <form action="{{ route('materiais.deletar', [$disciplina->id, $material->id, $turma->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Deletar</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts._rodape')
</x-app-layout>
