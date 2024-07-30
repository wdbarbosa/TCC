<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Turma;
use App\Models\InformacaoSite;
use App\Models\Comunicado;
use App\Http\Controllers\InformacaoController;
use App\Http\Controllers\QuestaoController;
use App\Http\Controllers\ResumoController;
use Carbon\Carbon;


Route::get('/', [InformacaoController::class, 'index'])->name('welcome');

Route::get('/dashboard', function () {
    $turmas = Turma::all();
    return view('dashboard',['turmas' => $turmas]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/perfil', function (){
    return view('perfil');
})->middleware(['auth', 'verified'])->name('perfil');

Route::get('/delete-user-form/{id}', function($id) {
    $user = User::findOrFail($id);
    $user->delete();
    return redirect('/welcome');
})->name('excluir');


Route::get('/forumdeduvidas', function () {
    return view('forumdeduvidas');
})->middleware(['auth', 'verified'])->name('forumdeduvidas');


Route::get('/informacoes', function (){
    return view('informacoes');
})->middleware(['auth', 'verified'])->name('informacoes');

Route::get('/disciplinas', function (){
    return view('disciplinas');
})->middleware(['auth', 'verified'])->name('disciplinas');

Route::get('/comunicados', function (){
    $users = User::where('nivel_acesso', 'professor')->get();
    $comunicados = Turma::all(); 
    return view('comunicados', compact('users'), compact('comunicados'));
})->middleware(['auth', 'verified'])->name('comunicados');

Route::get('/adicionarComunicado', function () {
    return view('adicionarComunicado');
});

Route::post('/cadastrar-comunicado', function(Request $informacoes)
        {
            $users = User::where('nivel_acesso', 'professor')->get();
            $nomecomunicado = request()->input('nomecomunicado');
            $comunicado = request()->input('comunicado');
            $data_comunicado = request()->input('data_comunicado');

            Comunicado::create([
                'nomecomunicado' => $nomecomunicado,
                'comunicado' => $comunicado,
                'data_comunicado' => $data_comunicado,
            ]);
            $comunicados = Comunicado::all();
            return view('comunicados', compact('users'), compact('comunicados'));
        })->name('cadastrar-comunicado');


Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/resumo', [ResumoController::class, 'index'])->name('resumo.index');
    Route::get('/resumo/abrir/{id_resumo}', [ResumoController::class, 'abrir'])->name('resumo.abrir');
    Route::get('/resumo/editar/{id_resumo}', [ResumoController::class, 'editar'])->name('resumo.editar');
    Route::get('/resumo/deletar/{id_resumo}', [ResumoController::class, 'deletar'])->name('resumo.deletar');
    Route::get('/resumo/adicionar', [ResumoController::class, 'adicionar'])->name('resumo.adicionar');
    Route::post('/resumo/salvar', [ResumoController::class, 'salvar'])->name('resumo.salvar');
    Route::put('/resumo/atualizar/{id_resumo}', [ResumoController::class, 'atualizar'])->name('resumo.atualizar');
});

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/questoes', [QuestaoController::class, 'index'])->name('questoes.index');
    Route::get('/questoes/criar', [QuestaoController::class, 'criar'])->name('questoes.criar');
    Route::post('/questoes', [QuestaoController::class, 'store'])->name('questoes.store');
    Route::get('/questoes/{questao}/editar', [QuestaoController::class, 'editar'])->name('questoes.editar');
    Route::put('/questoes/{questao}', [QuestaoController::class, 'atualizar'])->name('questoes.atualizar');
    Route::delete('/questoes/{questao}', [QuestaoController::class, 'deletar'])->name('questoes.deletar');
});


    /*Rotas do CRUD de Professor*/
        Route::get('/professor', function () {
            $user = User::where('nivel_acesso', 'professor')->get();
            return view('professores', ['user' => $user]);
        });

        Route::get('/adicionarProfessor', function () {
            return view('adicionarProfessor');
        });

        Route::post('/cadastrar-professor', function(Request $informacoes)
        {
            $name = request()->input('name');
            $email = request()->input('email');
            $password = request()->input('password');
            $data_nasc = request()->input('data_nasc');
            $telefone = request()->input('telefone');
            $cpf = request()->input('cpf');
            $nivel_acesso = request()->input('nivel_acesso');


            User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'data_nasc' => $data_nasc,
                'telefone' => $telefone,
                'cpf' => $cpf,
                'nivel_acesso' => $nivel_acesso
            ]);
            $user = User::all();
            return view('professores', ['user' => $user]);
        })->name('cadastrar-professor');

        Route::get('/mostrar-professor/{id_professor}', function($id_professor) {
            $professor = User::findOrFail($id_professor);
            echo $professor->name;
            echo "<br />";
            echo $professor->email;
            echo "<br />";
            echo $professor->password;
            echo "<br />";
            echo $professor->data_nasc;
            echo "<br />";
            echo $professor->cpf;
            echo "<br />";
            echo $professor->telefone;
            echo "<br />";
            echo $professor->nivel_acesso;
        });

        Route::get('/editar-professor/{id_professor}', function($id_professor) {
            $user = User::findOrFail($id_professor);
            return view('atualizarProfessor', ['user' => $user]);
        });

        Route::put('/atualizar-professor/{id_professor}', function(Request $request, $id_professor) {
            $professor = User::findOrFail($id_professor);

            $professor->name = $request->input('name');
            $professor->email = $request->input('email');
            $professor->password = $request->input('password');
            $professor->data_nasc = $request->input('data_nasc');
            $professor->cpf = $request->input('cpf');
            $professor->telefone = $request->input('telefone');
            $professor->nivel_acesso = $request->input('nivel_acesso');

            $professor->save();

            $user = User::all();
            return view('professores', ['user' => $user]);
        });

        Route::get('/excluir-professor/{id_professor}', function($id_professor) {
            $professor = User::findOrFail($id_professor);
            $professor->delete();
            return redirect('/professor');
        });
    /*}*/

    /*Rotas do CRUD de Aluno*/
        Route::get('/aluno', function () {
            $User = User::where('nivel_acesso', 'aluno')->get();
            return view('alunos', ['user' => $User]);
        });

        Route::get('/adicionarAluno', function () {
            return view('adicionarAluno');
        });

        Route::post('/cadastrar-aluno', function(Request $informacoes)
        {
            $name = request()->input('name');
            $email = request()->input('email');
            $password = request()->input('password');
            $data_nasc = request()->input('data_nasc');
            $telefone = request()->input('telefone');
            $cpf = request()->input('cpf');
            $nivel_acesso = request()->input('nivel_acesso');

            User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'data_nasc' => $data_nasc,
                'telefone' => $telefone,
                'cpf' => $cpf,
                'nivel_acesso' => $nivel_acesso
            ]);
            $user = User::all();
            return view('alunos', ['user' => $user]);
        })->name('cadastrar-aluno');

        Route::get('/editar-aluno/{id_aluno}', function($id_aluno) {
            $aluno = User::findOrFail($id_aluno);
            return view('atualizarAluno', ['aluno' => $aluno]);
        });

        Route::put('/atualizar-aluno/{id_aluno}', function(Request $request, $id_aluno) {
            $aluno = User::findOrFail($id_aluno);

            $aluno->name = $request->input('name');
            $aluno->email = $request->input('email');
            $aluno->password = $request->input('password');
            $aluno->data_nasc = $request->input('data_nasc');
            $aluno->cpf = $request->input('cpf');
            $aluno->telefone = $request->input('telefone');
            $aluno->nivel_acesso = $request->input('nivel_acesso');

            $aluno->save();

            $user = User::all();
            return view('alunos', ['user' => $user]);
        });

        Route::get('/excluir-aluno/{id_aluno}', function($id_aluno) {
            $aluno = User::findOrFail($id_aluno);
            $aluno->delete();
            return redirect('/aluno');
        });
    /*}*/

    /*Rotas do CRUD de Turma*/

        Route::get('/turma', function () {
            $turmas = Turma::all();
            return view('turmas', compact('turmas'));
        })->name('turma');

        Route::get('/turma/{id}', function ($id) {
            $turmas = Turma::findOrFail($id); 
            return view('turmaEspecifica', ['turmas' => $turmas]); 
        })->name('turmaEspecifica');

        Route::get('/adicionarTurma', function () {
            return view('adicionarTurma');
        })->name('adicionarTurma');

        Route::post('/cadastrar-turma', function(Request $request)
        {
            $id = $request->input('id');
            $nome = $request->input('nome');
            $descricao = $request->input('descricao');

            Turma::create([
                'nome' => $nome,
                'descricao' => $descricao,
            ]);

            $turmas = Turma::all();
            return view('turmas', ['turmas' => $turmas]);
        })->name('cadastrar-turma');

        Route::get('/editar-turma/{id}', function($id) {
            $turma = Turma::findOrFail($id);
            return view('atualizarTurma', ['turma' => $turma]);
        })->name('editar-turma');

        Route::put('/atualizar-turma/{id}', function(Request $request, $id) {
            $turma = Turma::findOrFail($id);

            $turma->nome = $request->input('nome');
            $turma->descricao = $request->input('descricao');

            $turma->save();

            $turmas = Turma::all();
            return view('turmas', ['turmas' => $turmas]);
        });

        Route::get('/excluir-turma/{id}', function($id) {
            $turma = Turma::findOrFail($id);
            $turma->delete();
            return redirect('/turma');
        })->name('excluir-turma');
    /*}*/

    /*Rotas das Informações*/
    Route::get('/alterarInformacao', function () {
        $informacao = InformacaoSite::first();
        return view('atualizarInformacao', ['informacao' => $informacao]);
    });


    Route::post('/atualizarInformacao', function(Request $request) {
        $informacao = InformacaoSite::firstOrFail();

        $informacao->imagem = $request->input('imagem');
        $informacao->inicio_inscricao = Carbon::parse($request->input('inicio_inscricao'));
        $informacao->infogeral = $request->input('infogeral');
        $informacao->fim_inscricao = Carbon::parse($request->input('fim_inscricao'));
        $informacao->endereco = $request->input('endereco');
        $informacao->horario = $request->input('horario');

        $informacao->save();
        $registro = $informacao;

        return view('welcome', compact('registro'));
    })->name('atualizarInformacao');

    /*}*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
