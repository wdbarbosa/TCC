<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="stylefooter.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Adicionar Questão') }}
        </h2>
    </x-slot>

    <main>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1></h1>
                    <form action="{{ route('questoes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="banca">Banca:</label>
                            <input type="text" name="banca" id="banca" required>
                        </div>
                        <div>
                            <label for="assunto">Assunto:</label>
                            <input type="text" name="assunto" id="assunto" required>
                        </div>
                        <div>
                            <label for="enunciado">Enunciado:</label>
                            <input type="text" name="enunciado" id="enunciado" required>
                        </div>
                        <div>
                            <label for="image">Imagem</label>
                            <input type="file" name="image_path" id="image_path">
                        </div>
                        <div>
                            <label for="alternativa_a">Alternativa A:</label>
                            <input type="text" name="alternativa_a" id="alternativa_a" required>
                        </div>
                        <div>
                            <label for="alternativa_b">Alternativa B:</label>
                            <input type="text" name="alternativa_b" id="alternativa_b" required>
                        </div>
                        <div>
                            <label for="alternativa_c">Alternativa C:</label>
                            <input type="text" name="alternativa_c" id="alternativa_c" required>
                        </div>
                        <div>
                            <label for="alternativa_d">Alternativa D:</label>
                            <input type="text" name="alternativa_d" id="alternativa_d" required>
                        </div>
                        <div>
                            <label for="alternativa_e">Alternativa E:</label>
                            <input type="text" name="alternativa_e" id="alternativa_e" required>
                        </div>
                        <div>
                            <label for="alternativacorreta">Alternativa Correta:</label>
                            <input type="text" name="alternativacorreta" id="alternativacorreta" required>
                        </div>
                        <div>
                            <label for="fk_disciplina_id_disciplina">Disciplina:</label>
                            <select name="fk_disciplina_id_disciplina" id="fk_disciplina_id_disciplina" required>
                                @foreach($disciplinasArray as $disciplina)
                                <option value="{{ $disciplina->id_disciplina }}">{{ $disciplina->disciplina_descricao }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="deletado">Deletado:</label>
                            <select name="deletado" id="deletado" required>
                                <option value="0">Não</option>
                                <option value="1">Sim</option>
                            </select>
                        </div>
                        <button type="submit">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </main>

    @include('layouts._rodape')
</x-app-layout>