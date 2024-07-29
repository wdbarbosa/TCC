@extends('layouts.app')

@section('content')
    <h1>Editar Questão</h1>
    <form action="{{ route('questoes.atualizar', $questao) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="banca">Banca:</label>
            <input type="text" name="banca" id="banca" value="{{ $questao->banca }}" required>
        </div>
        <div>
            <label for="alternativa_a">Alternativa A:</label>
            <input type="text" name="alternativa_a" id="alternativa_a" value="{{ $questao->alternativa_a }}" required>
        </div>
        <div>
            <label for="alternativa_b">Alternativa B:</label>
            <input type="text" name="alternativa_b" id="alternativa_b" value="{{ $questao->alternativa_b }}" required>
        </div>
        <div>
            <label for="alternativa_c">Alternativa C:</label>
            <input type="text" name="alternativa_c" id="alternativa_c" value="{{ $questao->alternativa_c }}" required>
        </div>
        <div>
            <label for="alternativa_d">Alternativa D:</label>
            <input type="text" name="alternativa_d" id="alternativa_d" value="{{ $questao->alternativa_d }}" required>
        </div>
        <div>
            <label for="alternativa_e">Alternativa E:</label>
            <input type="text" name="alternativa_e" id="alternativa_e" value="{{ $questao->alternativa_e }}" required>
        </div>
        <div>
            <label for="alternativacorreta">Alternativa Correta:</label>
            <input type="text" name="alternativacorreta" id="alternativacorreta" value="{{ $questao->alternativacorreta }}" required>
        </div>
        <div>
            <label for="fk_disciplina_id_disciplina">Disciplina:</label>
            <select name="fk_disciplina_id_disciplina" id="fk_disciplina_id_disciplina" required>
                @foreach($disciplinas as $disciplina)
                    <option value="{{ $disciplina->id_disciplina }}" @if($disciplina->id_disciplina == $questao->fk_disciplina_id_disciplina) selected @endif>{{ $disciplina->disciplina_descricao }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="deletado">Deletado:</label>
            <select name="deletado" id="deletado" required>
                <option value="0" @if($questao->deletado == 0) selected @endif>Não</option>
                <option value="1" @if($questao->deletado == 1) selected @endif>Sim</option>
            </select>
        </div>
        <button type="submit">Salvar</button>
    </form>
@endsection
