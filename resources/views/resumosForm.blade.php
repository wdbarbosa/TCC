<div class="input-field">
    <label>Título</label>
    <input type="text" name="titulo" value="{{ isset($resumo->titulo) ? $resumo->titulo : ''}}">
</div>
<div class="input-field">
    <label>Resumo</label>
    <input type="file" name="arquivo">
</div>
@if(isset($resumo->arquivo))
    <div class="input-field">
        <label>Arquivo atual</label>
        <p>{{ basename($resumo->arquivo) }}</p>
        <!--aqui tem que vir a miniatura? img width="150" src="{{asset($resumo->arquivo)}}" /-->
        <!-- asset retorna o caminho físico da imagem -->
    </div>
@endif
<div class="input-field">
    <label>Disciplina</label>
    <select name="fk_disciplina_id_disciplina">
        <option value="" disabled>Selecione a disciplina</option>
        @foreach($disciplinas as $disciplina)
            <option value="{{ $disciplina->id_disciplina }}" {{ (isset($resumo->fk_disciplina_id_disciplina) && $resumo->fk_disciplina_id_disciplina == $disciplina->id_disciplina) ? 'selected' : '' }}>
                {{ $disciplina->disciplina_descricao }}
            </option>
        @endforeach
    </select>
</div>