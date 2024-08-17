<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <link rel="stylesheet" href="stylefooter.css">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Atribuição de professores') }}
        </h2>
    </x-slot>
    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form action="{{ route('atribuicaoprofessor.salvar') }}" method="POST">
                            {{ csrf_field() }}
                            @foreach ($disciplinas as $disciplina)
                                <div>
                                    <p>{{ $disciplina->nome_disciplina }}</p>

                                    <div>
                                        <label for="professor_{{ $disciplina->id }}">Selecione o professor:</label>
                                        <select name="professor[{{ $disciplina->id }}]" id="professor_{{ $disciplina->id }}">
                                            @foreach ($professores as $professor)
                                                <option value="{{ $professor->id }}">{{ $professor->user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                
                                    <div>
                                        <label>Turmas:</label>
                                        <div>
                                            @foreach ($turmas as $turma)
                                                <label>
                                                    <input type="checkbox" name="turmas[{{ $disciplina->id }}][]" value="{{ $turma->id }}">
                                                    <span>{{ $turma->nome }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div>
                                <button type="submit">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layouts._rodape')
</x-app-layout>
