<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <link rel="stylesheet" href="{{ asset('stylefooter.css')}}">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
            <a href="{{ route('questoes.index') }}" class="mr-4" alt="Voltar">
                <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
            </a>
            {{ __('Adicionar Questão') }}
        </h2>
    </x-slot>

    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form action="{{ route('questoes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex flex-col">
                                    <label for="banca" class="font-medium text-gray-700">Banca:</label>
                                    <input type="text" name="banca" id="banca" class="mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                </div>
                                <div class="flex flex-col">
                                    <label for="assunto" class="font-medium text-gray-700">Assunto:</label>
                                    <input type="text" name="assunto" id="assunto" class="mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                </div>
                            </div>

                            <div class="flex flex-col">
                                <label for="enunciado" class="font-medium text-gray-700">Enunciado:</label>
                                <input type="text" name="enunciado" id="enunciado" class="mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            </div>

                            <div class="flex flex-col">
                                <label for="image_path" class="font-medium text-gray-700">Imagem:</label>
                                <input type="file" name="image_path" id="image_path" class="mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex flex-col">
                                    <label for="alternativa_a" class="font-medium text-gray-700">Alternativa A:</label>
                                    <input type="text" name="alternativa_a" id="alternativa_a" class="mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                </div>
                                <div class="flex flex-col">
                                    <label for="alternativa_b" class="font-medium text-gray-700">Alternativa B:</label>
                                    <input type="text" name="alternativa_b" id="alternativa_b" class="mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex flex-col">
                                    <label for="alternativa_c" class="font-medium text-gray-700">Alternativa C:</label>
                                    <input type="text" name="alternativa_c" id="alternativa_c" class="mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                </div>
                                <div class="flex flex-col">
                                    <label for="alternativa_d" class="font-medium text-gray-700">Alternativa D:</label>
                                    <input type="text" name="alternativa_d" id="alternativa_d" class="mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                </div>
                            </div>

                            <div class="flex flex-col">
                                <label for="alternativa_e" class="font-medium text-gray-700">Alternativa E:</label>
                                <input type="text" name="alternativa_e" id="alternativa_e" class="mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            </div>

                            <div class="flex flex-col">
                                <label for="alternativacorreta" class="font-medium text-gray-700">Alternativa Correta:</label>
                                <select name="alternativacorreta" id="alternativacorreta" class="mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                </select>
                            </div>

                            <div class="flex flex-col">
                                <label for="fk_disciplina_id" class="font-medium text-gray-700">Disciplina:</label>
                                <select name="fk_disciplina_id" id="fk_disciplina_id" class="mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    @foreach($disciplinas as $disciplina)
                                        <option value="{{ $disciplina->id }}">{{ $disciplina->disciplina_descricao }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex flex-col">
                                <label for="deletado" class="font-medium text-gray-700">Deletado:</label>
                                <select name="deletado" id="deletado" class="mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>

                            <button type="submit" class="mt-4 bg-[#9dc8ce] text-white py-2 px-4 rounded hover:bg-[#8ab3b6] transition duration-150">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts._rodape')
</x-app-layout>
