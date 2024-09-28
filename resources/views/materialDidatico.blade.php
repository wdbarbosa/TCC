<x-app-layout>
    @section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight header-flex">
                <a href="{{ route('turmaEspecifica', $turma->id) }}" class="mr-4" alt="Voltar">
                    <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
                </a>
                 Material Didático - {{ $disciplina->nome_disciplina }}
            </h2>
        </div>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
    <link rel="stylesheet" href="{{ asset('stylematerial.css') }}">

    <div class="py-6"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a class="bg-[#6bb6c0] text-white py-2 px-4 rounded inline-block hover:bg-[#8ab3b6] transition duration-150" href="{{ route('materiais.criar', ['id' => $disciplina->id, 'turmaId' => $turma->id]) }}">
                        Adicionar Material Didático
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
                                    <p><strong>PDF:</strong> <a class="links" href="{{ asset('storage/' . $material->pdf) }}" target="_blank">Abrir PDF</a></p>
                                    @endif

                                    @if ($material->slide)
                                    <p><strong>Slide:</strong> <a class="links" href="{{ asset('storage/' . $material->slide) }}" target="_blank">Baixar Slide</a></p>
                                    @endif
                                    <div class="botao-container">

                                    <a class="editar-btn" href="{{ route('materiais.editar', [$disciplina->id, $material->id, $turma->id]) }}">
                                        <img src="{{ asset('img/escrever.png') }}" alt="Editar" class="icon-escrever">
                                    </a>
                                        <form action="{{ route('materiais.deletar', [$disciplina->id, $material->id, $turma->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="deletar-btn">
                                                <img src="{{ asset('img/lixeira-de-reciclagem.png') }}" alt="Excluir" class="icon-lixeira">
                                            </button>
                                        </form>
                                    </div>

                <a class="editar-btn" href="{{ route('materiais.editar', [$disciplina->id, $material->id, $turma->id]) }}">
                    <img src="{{ asset('img/escrever.png') }}" alt="Editar" class="icon-escrever">
                </a>
                <form action="{{ route('materiais.deletar', [$disciplina->id, $material->id, $turma->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="deletar-btn">
                        <img src="{{ asset('img/lixeira-de-reciclagem.png') }}" alt="Excluir" class="icon-lixeira">
                    </button>
                </form>
            </div>
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
