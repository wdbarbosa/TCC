<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Atribuição de Turmas e Alunos') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2>Nova Atribuição</h2>

                    @if($alunos->isEmpty())
                        <p>Todos os alunos já possuem turma atribuída.</p>
                    @else
                        <form action="{{ route('atribuicaoaluno.salvar') }}" method="POST">
                            {{ csrf_field() }}
                            
                            <button type="submit">Salvar</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
