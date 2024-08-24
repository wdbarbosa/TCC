<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Questões - Disciplinas') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="{{ asset('stylefooter.css')}}">

 <main>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-4 lg:px-2">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-3 gap-6">
                        @foreach($disciplinas as $disciplina)
                            <a href="{{ route('aluno.bancas', $disciplina->id) }}" 
                               class="bg-[#9dc8ce] hover:bg-[#6498a0] text-white font-bold py-4 px-6 rounded text-center block"
                               style="max-width: 800px;"> <!-- Ajuste a largura máxima conforme necessário -->
                               {{ $disciplina->nome_disciplina }}
                            </a>
                        @endforeach
                    </div>    
                </div>
            </div>
        </div>
    </div>
</main>



    @include('layouts._rodape')
</x-app-layout>


