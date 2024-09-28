@if(auth()->user()->nivel_acesso === 'admin')
    <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Ação do Administrador
    </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('professores.index') }}">Gerenciar Professores</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('alunos.index') }}">Gerenciar Alunos</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('turma.index') }}">Gerenciar Turmas</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('disciplina.index') }}">Gerenciar Disciplinas</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('alterarInformacao') }}">Alterar Informações</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('atribuicaoprofessor.index') }}">Atribuir Professores</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('atribuicaoaluno.index') }}">Atribuir Alunos</a>
        </div>
    </div>
@endif