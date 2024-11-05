@section('title', 'Cursinho Primeiro de Maio')
<link rel="stylesheet" href="{{ asset('styleresumosform.css') }}">
<div class="input-field">
    <label>Título:</label>
    <input type="text" name="titulo" value="{{ isset($resumo->titulo) ? $resumo->titulo : ''}}">
</div>
<div class="input-field">
    <label>Resumo:</label>
    <input type="file" name="arquivo">
</div>
@if(isset($resumo->arquivo))
    <div class="input-field">
        <label>Arquivo atual:</label>
        <p>{{ basename($resumo->arquivo) }}</p>
    </div>
@endif  
<div class="input-field">
    <label>Disciplina:</label>
    <select class="dropbox" name="fk_disciplina_id">
        <option value="" disabled>Selecione a disciplina</option>
        @foreach($disciplinas as $disciplina)
            <option value="{{ $disciplina->id }}" {{ (isset($resumo->fk_disciplina_id) && $resumo->fk_disciplina_id == $disciplina->id) ? 'selected' : '' }}>
                {{ $disciplina->nome_disciplina }}
            </option>
        @endforeach
    </select>
</div>
