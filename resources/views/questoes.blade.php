<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Questões') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="{{ asset('stylefooter.css')}}">

    <div class="py-6"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a class="bg-[#9dc8ce] text-white py-2 px-4 rounded inline-block hover:bg-[#8ab3b6] transition duration-150" href="{{ route('questoes.criar') }}">
                        Adicionar Questão
                    </a>
                </div>
            </div>
        </div>
    </div>

    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="GET" action="{{ route('questoes.index') }}" class="flex justify-center items-center space-x-4">
                        <!-- Campo de Pesquisa por ID -->
                        <input type="text" name="search" placeholder="Pesquisar pelo ID" class="py-2 px-4 rounded" value="{{ request()->get('search') }}">
    
                        <!-- Dropdown para selecionar a disciplina -->
                        <select name="disciplina" class="py-2 px-7 rounded">
                            <option value="">Todas as Disciplinas</option>
                                @foreach($listaDisciplinas as $disciplina)
                                    <option value="{{ $disciplina->id }}" {{ request()->get('disciplina') == $disciplina->id ? 'selected' : '' }}>
                                    {{ $disciplina->disciplina_descricao }}
                                    </option>
                                @endforeach
                        </select>

                        <button type="submit" class="bg-[#9dc8ce] text-white py-2 px-4 rounded hover:bg-[#8ab3b6] transition duration-150">Filtrar</button>
                    </form>


                    <!-- Mensagens de Sucesso ou Erro -->
                    <!-- @if(session('success'))
                        <script>
                            alert('{{ session('success') }}');
                        </script>
                    @endif
                    @if(session('deletado'))
                        <script>
                            alert('{{ session('deletado') }}');
                        </script>
                    @endif -->

                    <!-- Lista de Questões com Paginação -->
                    <ul>
                        @foreach($questoes as $questao)
                            <li class="mb-4">
                                <strong>ID:</strong> {{ $questao->id }} <br>
                                <strong>Banca:</strong> {{ $questao->banca }} <br>
                                <strong>Assunto:</strong> {{ $questao->assunto }} <br>
                                <strong>Enunciado:</strong> {{ $questao->enunciado }} <br>
                                @if($questao->image_path)
                                    <img src="{{ asset('storage/' . $questao->image_path) }}" alt="Imagem da Questão" class="w-48 h-auto">
                                @endif
                                <strong>Alternativa A:</strong> {{ $questao->alternativa_a }} <br>
                                <strong>Alternativa B:</strong> {{ $questao->alternativa_b }} <br>
                                <strong>Alternativa C:</strong> {{ $questao->alternativa_c }} <br>
                                <strong>Alternativa D:</strong> {{ $questao->alternativa_d }} <br>
                                <strong>Alternativa E:</strong> {{ $questao->alternativa_e }} <br>
                                <strong>Alternativa Correta:</strong> {{ $questao->alternativacorreta }} <br>
                                <strong>Disciplina:</strong> {{ $questao->disciplina->disciplina_descricao }} <br>
                                <a class="bg-[#9dc8ce] text-white py-1 px-2 rounded inline-block hover:bg-[#8ab3b6] transition duration-150" href="{{ route('questoes.editar', $questao->id) }}">
                                    Editar
                                </a>
                                <form action="{{ route('questoes.deletar', $questao->id) }}" method="POST" class="bg-[#9dc8ce] text-white py-1 px-2 rounded inline-block hover:bg-[#8ab3b6] transition duration-150">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Excluir</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Paginação -->
                    <div class="mt-4">
                        {{ $questoes->links() }}
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts._rodape')
</x-app-layout>
