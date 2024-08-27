<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
    <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Atribuição de professores') }}
        </h2>
    </x-slot>
    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form action="{{ route('atribuicaoprofessor.atualizar', $atribuicao->id) }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT">

                            <div>
                                <p><strong>Disciplina:</strong> {{ $atribuicao->disciplina->nome_disciplina }}</p>
                                <input type="hidden" name="fk_disciplina_id" value="{{ $atribuicao->disciplina->id }}">
                            </div>

                            <div>
                                <label for="professor">Selecione o professor:</label>
                                <select name="fk_professor_users_id" id="professor" required>
                                    @foreach($professores as $professor)
                                        <option value="{{ $professor->fk_professor_users_id }}" 
                                            {{ $professor->fk_professor_users_id == $atribuicao->fk_professor_users_id ? 'selected' : '' }}>
                                            {{ $professor->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label>Selecione a(s) turma(s):</label>
                                <div>
                                    @foreach($turmas as $turma)
                                        <label>
                                            <input type="checkbox" name="turmas[]" value="{{ $turma->id }}" 
                                                {{ $atribuicao->turmas->contains($turma->id) ? 'checked' : '' }}>
                                            <span>{{ $turma->nome }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <button type="submit">Atualizar</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layouts._rodape')
</x-app-layout>
