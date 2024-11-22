<?php

use App\Http\Controllers\ProfileController;
use App\Models\RespostaDuvida;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Turma;
use App\Models\Disciplina;
use App\Models\InformacaoSite;
use App\Models\Comunicado;
use App\Models\Duvida;
use App\Http\Controllers\ComunicadoController;
use App\Http\Controllers\InformacaoController;
use App\Http\Controllers\QuestaoController;
use App\Http\Controllers\ResumoController;
use App\Http\Controllers\AlunoQuestaoController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\DuvidaController;
use App\Http\Controllers\RespostaDuvidaController;
use App\Http\Controllers\AtribuicaoProfessorController;
use App\Http\Controllers\AtribuicaoAlunoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TurmaEspecificaController;
use App\Http\Controllers\MaterialDidaticoController;
use App\Http\Controllers\ProfessorDisciplinaController;
use App\Http\Controllers\TurmaDisciplinaController;
use Carbon\Carbon;
use App\Http\Controllers\ErrorController;

require __DIR__.'/auth.php';

Route::get('/', [InformacaoController::class, 'index'])->name('welcome');

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});

Route::get('/perfil', function (){
    return view('perfil');
})->middleware(['auth', 'verified'])->name('perfil');

Route::middleware(['auth', 'verified'])->group(function() {
Route::get('/delete-user-form/{id}', function($id) {
    $user = User::findOrFail($id);
    $user->delete();
    return redirect('/welcome');
})->name('excluir');
});


Route::get('/forumdeduvidas', function () {
    return view('forumdeduvidas');
})->middleware(['auth', 'verified'])->name('forumdeduvidas');


Route::get('/informacoes', function (){
    return view('informacoes');
})->middleware(['auth', 'verified'])->name('informacoes');



    /*Rotas do CRUD de Comunicados*/
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/comunicados', [ComunicadoController::class, 'index'])->name('comunicados');
        Route::get('/adicionarComunicado', [ComunicadoController::class, 'create']);
        Route::post('/cadastrar-comunicado', [ComunicadoController::class, 'store'])->name('cadastrar-comunicado');
        Route::get('/editar-comunicado/{id}', [ComunicadoController::class, 'edit']);
        Route::post('/atualizar-comunicado/{id}', [ComunicadoController::class, 'update'])->name('atualizar-comunicado');
        Route::get('/excluir-comunicado/{id}', [ComunicadoController::class, 'destroy'])->name('excluir-comunicado');
    });

    /*Rotas do CRUD de Duvidas*/
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/forumdeduvidas', [DuvidaController::class, 'index'])->name('forumdeduvidas');
        Route::get('/adicionarDuvida', [DuvidaController::class, 'create']);
        Route::post('/cadastrar-duvida', [DuvidaController::class, 'store'])->name('cadastrar-duvida');
        Route::get('/editar-duvida/{id}', [DuvidaController::class, 'edit'])->name('editar-duvida');
        Route::post('/atualizar-duvida/{id}', [DuvidaController::class, 'update'])->name('atualizar-duvida');
        Route::get('/excluir-duvida/{id}', [DuvidaController::class, 'destroy'])->name('excluir-duvida');
    });

    /*Rotas de Respostas*/
        Route::middleware(['auth', 'verified'])->group(function() {
        Route::post('/responder-duvida/{id_duvida}', [RespostaDuvidaController::class, 'responderForum'])->name('responder-duvida');
        Route::get('/forum-de-duvidas', [RespostaDuvidaController::class, 'index'])->name('forum.de.duvidas');
        Route::get('/editar-resposta/{id}', [RespostaDuvidaController::class, 'edit'])->name('editar-resposta');
        Route::put('/atualizar-resposta/{id}', [RespostaDuvidaController::class, 'update'])->name('atualizar-resposta');
        Route::delete('/excluir-resposta/{id}', [RespostaDuvidaController::class, 'destroy'])->name('excluir-resposta');
    });

    /*Rotas de Resumos*/
        Route::middleware(['auth', 'verified'])->group(function() {
        Route::get('/resumo', [ResumoController::class, 'index'])->name('resumo.index');
        Route::get('/resumo/abrir/{id}', [ResumoController::class, 'abrir'])->name('resumo.abrir');
        Route::get('/resumo/editar/{id}', [ResumoController::class, 'editar'])->name('resumo.editar');
        Route::get('/resumo/deletar/{id}', [ResumoController::class, 'deletar'])->name('resumo.deletar');
        Route::get('/resumo/adicionar', [ResumoController::class, 'adicionar'])->name('resumo.adicionar');
        Route::post('/resumo/salvar', [ResumoController::class, 'salvar'])->name('resumo.salvar');
        Route::put('/resumo/atualizar/{id}', [ResumoController::class, 'atualizar'])->name('resumo.atualizar');
    });

    //Rota questões professor
        Route::middleware(['auth', 'verified'])->group(function() {
        Route::get('/questoes', [QuestaoController::class, 'index'])->name('questoes.index');
        Route::get('/questoes/criar', [QuestaoController::class, 'criar'])->name('questoes.criar');
        Route::post('/questoes', [QuestaoController::class, 'store'])->name('questoes.store');
        Route::get('/questoes/{questao}/editar', [QuestaoController::class, 'editar'])->name('questoes.editar');
        Route::put('/questoes/{questao}', [QuestaoController::class, 'atualizar'])->name('questoes.atualizar');
        Route::delete('/questoes/{questao}', [QuestaoController::class, 'deletar'])->name('questoes.deletar');
    });

    //Rota questões aluno
    Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/questoes/disciplinas', [AlunoQuestaoController::class, 'index'])->name('aluno.disciplinas');
    Route::get('/questoes/disciplinas/{disciplinaId}/bancas', [AlunoQuestaoController::class, 'listarBancas'])->name('aluno.bancas');
    Route::get('/questoes/disciplinas/{disciplinaId}/bancas/{banca}/questao', [AlunoQuestaoController::class, 'listarQuestoes'])->name('aluno.questoes');
    Route::post('/questoes/responder', [AlunoQuestaoController::class, 'responder'])->name('aluno.responder');
    });

    /*Rotas do CRUD de Professor*/
        Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/professor', [ProfessorController::class, 'index'])->name('professores.index');
        Route::get('/adicionarProfessor', [ProfessorController::class, 'create'])->name('professores.create');
        Route::post('/cadastrar-professor', [ProfessorController::class, 'store'])->name('cadastrar-professor');
        Route::get('/editar-professor/{id}', [ProfessorController::class, 'edit'])->name('professores.edit');
        Route::put('/atualizar-professor/{id}', [ProfessorController::class, 'update'])->name('professores.update');
        Route::get('/excluir-professor/{id}', [ProfessorController::class, 'destroy'])->name('professores.destroy');
    });

    /*Rotas do CRUD de Aluno*/
        Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/aluno', [AlunoController::class, 'index'])->name('alunos.index');
        Route::get('/adicionarAluno', [AlunoController::class, 'create'])->name('alunos.create');
        Route::post('/cadastrar-aluno', [AlunoController::class, 'store'])->name('cadastrar-aluno');
        Route::get('/editar-aluno/{id}', [AlunoController::class, 'edit'])->name('alunos.edit');
        Route::put('/atualizar-aluno/{id}', [AlunoController::class, 'update'])->name('alunos.update');
        Route::get('/excluir-aluno/{id}', [AlunoController::class, 'destroy'])->name('alunos.destroy');
    });

    /*Rotas das Turmas*/
        Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/turma', [TurmaController::class, 'index'])->name('turma.index');
        Route::get('/adicionarTurma', [TurmaController::class, 'create'])->name('turma.create');
        Route::post('/cadastrar-turma', [TurmaController::class, 'store'])->name('cadastrar-turma');
        Route::get('/editar-turma/{id}', [TurmaController::class, 'edit'])->name('turma.edit');
        Route::put('/atualizar-turma/{id}', [TurmaController::class, 'update'])->name('turma.update');
        Route::delete('/excluir-turma/{id}', [TurmaController::class, 'destroy'])->name('turma.destroy');

        Route::get('/turmaEspecifica/{id}', [TurmaEspecificaController::class, 'show'])->name('turmaEspecifica');   
    });

    // Rotas Material Didático 
    Route::middleware(['auth', 'verified'])->group(function(){
        Route::get('/disciplina/{id}/materiais/{turmaId}', [MaterialDidaticoController::class, 'index'])->name('materiais.index');
        Route::get('/disciplina/{id}/materiais/criar/{turmaId}', [MaterialDidaticoController::class, 'criar'])->name('materiais.criar');
        Route::post('/disciplina/{id}/materiais/{turmaId}', [MaterialDidaticoController::class, 'store'])->name('materiais.store');
        Route::get('/materiais/{id}/editar/{materialId}/{turmaId}', [MaterialDidaticoController::class, 'editar'])->name('materiais.editar');
        Route::put('/materiais/{id}/atualizar/{materialId}/{turmaId}', [MaterialDidaticoController::class, 'atualizar'])->name('materiais.atualizar');
        Route::delete('/materiais/{id}/deletar/{materialId}/{turmaId}', [MaterialDidaticoController::class, 'deletar'])->name('materiais.deletar');

        //Aluno visualizando Material Didático
        Route::get('/materiais/disciplina/{id}', [DisciplinaController::class, 'mostrarMateriaisDaDisciplina'])->name('materiais.disciplina');
    });

    /*Rotas do CRUD de Disciplina*/
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/disciplina', [DisciplinaController::class, 'index'])->name('disciplina.index');
        Route::get('/disciplinasExcluidas', [DisciplinaController::class, 'excluidas'])->name('disciplina.excluidas');
        Route::get('/adicionarDisciplina', [DisciplinaController::class, 'create'])->name('disciplina.create');
        Route::post('/cadastrar-disciplina', [DisciplinaController::class, 'store'])->name('cadastrar-disciplina');
        Route::get('/editar-disciplina/{id}', [DisciplinaController::class, 'edit'])->name('disciplina.edit');
        Route::put('/atualizar-disciplina/{id}', [DisciplinaController::class, 'update'])->name('disciplina.update');
        Route::get('/excluir-disciplina/{id}', [DisciplinaController::class, 'destroy'])->name('disciplina.destroy');
    });

    /*Rotas das Informações*/
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/alterarInformacao', function () {
            $informacao = InformacaoSite::first();
            return view('atualizarInformacao', ['informacao' => $informacao]);
        })->name('alterarInformacao');

        Route::post('/atualizarInformacao', function(Request $request) {
            $informacao = InformacaoSite::firstOrFail();

            $informacao->imagem = $request->input('imagem');
            $informacao->inicio_inscricao = $request->input('inicio_inscricao');
            $informacao->infogeral = $request->input('infogeral');
            $informacao->fim_inscricao = $request->input('fim_inscricao');
            $informacao->endereco = $request->input('endereco');
            $informacao->horario = $request->input('horario');

            $informacao->save();
            $informacao = InformacaoSite::first();

            return view('welcome', compact('informacao'));
        })->name('atualizarInformacao');
    });

    /*}*/

    Route::middleware(['auth', 'verified'])->group(function() {
        Route::get('/atribuicaoprofessor', [AtribuicaoProfessorController::class, 'index'])->name('atribuicaoprofessor.index');
        Route::get('/atribuicaoprofessor/adicionar', [AtribuicaoProfessorController::class, 'adicionar'])->name('atribuicaoprofessor.adicionar');
        Route::post('/atribuicaoprofessor/salvar', [AtribuicaoProfessorController::class, 'salvar'])->name('atribuicaoprofessor.salvar');
        Route::get('/atribuicaoprofessor/editar/{id}', [AtribuicaoProfessorController::class, 'editar'])->name('atribuicaoprofessor.editar');
        Route::put('/atribuicaoprofessor/atualizar/{id}', [AtribuicaoProfessorController::class, 'atualizar'])->name('atribuicaoprofessor.atualizar');
        Route::get('/atribuicaoprofessor/deletar/{id}', [AtribuicaoProfessorController::class, 'deletar'])->name('atribuicaoprofessor.deletar');
        Route::get('/atribuicaoaluno', [AtribuicaoAlunoController::class, 'index'])->name('atribuicaoaluno.index');
        Route::get('/atribuicaoaluno/adicionar', [AtribuicaoAlunoController::class, 'adicionar'])->name('atribuicaoaluno.adicionar');
        Route::post('/atribuicaoaluno/salvar', [AtribuicaoAlunoController::class, 'salvar'])->name('atribuicaoaluno.salvar');
        Route::get('/atribuicaoaluno/editar/{id}', [AtribuicaoAlunoController::class, 'editar'])->name('atribuicaoaluno.editar');
        Route::put('/atribuicaoaluno/atualizar/{id}', [AtribuicaoAlunoController::class, 'atualizar'])->name('atribuicaoaluno.atualizar');
        Route::get('/atribuicaoaluno/deletar/{id}', [AtribuicaoAlunoController::class, 'deletar'])->name('atribuicaoaluno.deletar');
    });

    Route::middleware(['auth', 'verified'])->group(function() {
        Route::get('/atribuicaoturmadisciplina', [TurmaDisciplinaController::class, 'index'])->name('atribuicaoturmadisciplina.index');
        Route::get('/atribuicaoturmadisciplina/adicionar', [TurmaDisciplinaController::class, 'adicionar'])->name('atribuicaoturmadisciplina.adicionar');
        Route::post('/atribuicaoturmadisciplina/salvar', [TurmaDisciplinaController::class, 'salvar'])->name('atribuicaoturmadisciplina.salvar');
        Route::get('/atribuicaoturmadisciplina/editar/{id}', [TurmaDisciplinaController::class, 'editar'])->name('atribuicaoturmadisciplina.editar');
        Route::put('/atribuicaoturmadisciplina/atualizar/{id}', [TurmaDisciplinaController::class, 'atualizar'])->name('atribuicaoturmadisciplina.atualizar');
        Route::get('/atribuicaoturmadisciplina/deletar/{id}', [TurmaDisciplinaController::class, 'deletar'])->name('atribuicaoturmadisciplina.deletar');
        Route::get('/atribuicaoprofessordisciplina', [ProfessorDisciplinaController::class, 'index'])->name('atribuicaoprofessordisciplina.index');
        Route::get('/atribuicaoprofessordisciplina/adicionar', [ProfessorDisciplinaController::class, 'adicionar'])->name('atribuicaoprofessordisciplina.adicionar');
        Route::post('/atribuicaoprofessordisciplina/salvar', [ProfessorDisciplinaController::class, 'salvar'])->name('atribuicaoprofessordisciplina.salvar');
        Route::get('/atribuicaoprofessordisciplina/editar/{id}', [ProfessorDisciplinaController::class, 'editar'])->name('atribuicaoprofessordisciplina.editar');
        Route::put('/atribuicaoprofessordisciplina/atualizar/{id}', [ProfessorDisciplinaController::class, 'atualizar'])->name('atribuicaoprofessordisciplina.atualizar');
        Route::get('/atribuicaoprofessordisciplina/deletar/{id}', [ProfessorDisciplinaController::class, 'deletar'])->name('atribuicaoprofessordisciplina.deletar');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/disciplinas', function(){
        $disciplina = Disciplina::all();
        return view ('disciplinas', ['disciplina' => $disciplina]);
    })->name('disciplinas');

    Route::get('/disciplinas/{id}', [DisciplinaController::class, 'mostrarDisciplina'])->name('disciplinaEspecifica');

    Route::get('/disciplinas/{id}/materiais/filtrar', [DisciplinaController::class, 'filtrarMateriaisPorPlaylist'])->name('materiais.filtrar');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::delete('/forumdeduvidas/{id}', [RespostaDuvidaController::class, 'destroy'])->name('forumdeduvidas.destroy');
});





