<x-app-layout>
    @section('title', 'Adicionar Material Didático - ' . $disciplina->nome_disciplina)

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Adicionar Material Didático - {{ $disciplina->nome_disciplina }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="w-full max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-2xl font-semibold mb-4 text-gray-800">Novo Material Didático</h3>

            @if ($errors->any())
                <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('materiais.store', $disciplina->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" name="titulo" id="titulo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('titulo') }}" required>
                </div>

                <div class="mb-4">
                    <label for="conteudo" class="block text-sm font-medium text-gray-700">Conteúdo</label>
                    <textarea name="conteudo" id="conteudo" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('conteudo') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="playlist" class="block text-sm font-medium text-gray-700">Playlist</label>
                    <input type="text" name="playlist" id="playlist" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('playlist') }}" required>
                </div>

                <div class="mb-4">
                    <label for="pdf" class="block text-sm font-medium text-gray-700">PDF (opcional)</label>
                    <input type="file" name="pdf" id="pdf" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mb-4">
                    <label for="slide" class="block text-sm font-medium text-gray-700">Slide (opcional)</label>
                    <input type="file" name="slide" id="slide" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">
                        Adicionar Material
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
