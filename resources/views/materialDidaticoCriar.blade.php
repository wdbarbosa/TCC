<x-app-layout>
    @section('title', 'Adicionar Material - ' . $disciplina->nome_disciplina)

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Adicionar Material Didático - {{ $disciplina->nome_disciplina }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="w-full max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
            <form action="{{ route('materiais.store', $disciplina->id) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" name="titulo" id="titulo" class="block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('titulo') }}" required>
                    @error('titulo')
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="conteudo" class="block text-sm font-medium text-gray-700">Conteúdo</label>
                    <textarea name="conteudo" id="conteudo" class="block w-full border-gray-300 rounded-md shadow-sm" rows="3" required>{{ old('conteudo') }}</textarea>
                    @error('conteudo')
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="playlist" class="block text-sm font-medium text-gray-700">Playlist (Link)</label>
                    <input type="text" name="playlist" id="playlist" class="block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('playlist') }}" required>
                    @error('playlist')
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-cyan-600 text-white px-4 py-2 rounded-md hover:bg-cyan-700">
                        Cadastrar Material
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
