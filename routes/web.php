<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

    /*Rotas do CRUD de Professor*/
        Route::get('/professor', function () {
            $user = User::where('nivel_acesso', 'professor')->get();
            return view('professores', ['user' => $user]);
        });

        Route::get('/adicionar', function () {
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
            $professor = User::findOrFail($id_professor);
            return view('atualizarProfessor', ['professor' => $professor]);
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
            $user = User::where('nivel_acesso', 'aluno')->get();
            return view('alunos', ['user' => $user]);
        });

        Route::get('/adicionar', function () {
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

        Route::get('/mostrar-aluno/{id_aluno}', function($id_aluno) {
            $aluno = User::findOrFail($id_aluno);
            echo $aluno->name;
            echo "<br />";
            echo $aluno->email;
            echo "<br />";
            echo $aluno->password;
            echo "<br />";
            echo $aluno->data_nasc;
            echo "<br />";
            echo $aluno->cpf;
            echo "<br />";
            echo $aluno->telefone;
            echo "<br />";
            echo $aluno->nivel_acesso;
        });

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
