<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Turma;
use App\Models\InformacaoSite;
use App\Http\Controllers\InformacaoController;

Route::get('/', [InformacaoController::class, 'index'])->name('welcome');

Route::get('/dashboard', function () {
    $turmas = Turma::all();
    return view('dashboard',['turmas' => $turmas]);
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/informacoes', function (){
    return view('informacoes');
})->middleware(['auth', 'verified'])->name('informacoes');



Route::get('/perfil', function (){
    return view('perfil');
})->middleware(['auth', 'verified'])->name('perfil');


Route::get('/forumdeduvidas', function () {
    return view('forumdeduvidas');
})->middleware(['auth', 'verified'])->name('forumdeduvidas');


Route::get('/materias', function (){
    return view('materias');
})->middleware(['auth', 'verified'])->name('materias');


Route::get('/resumos', function () {
    return view('resumos');
})->middleware(['auth', 'verified'])->name('resumos');


Route::get('/questoes', function () {
    return view('questoes');
})->middleware(['auth', 'verified'])->name('questoes');


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
        $informacao = InformacaoSite::all();
        return view('atualizar-informacao', ['informacao' => $informacao]);
    });

    Route::put('/atualizar-informacao', function(Request $request) {
        $informacao = InformacaoSite::all();

        $informacao->info_geral = $request->input('info_geral');
        $informacao->imagem = $request->input('imagem');
        $informacao->endereco = $request->input('endereco');
        $informacao->inicio_inscricao = $request->input('inicio_inscricao');
        $informacao->fim_inscricao = $request->input('fim_inscricao');

        $informacao->save();

        $registro = InformacaoSite::all();
        return view('welcome', compact('registro'));
    });
    /*}*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
