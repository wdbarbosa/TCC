<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AlunoController extends Controller
{
    // Exibe a lista de alunos
    public function index()
    {
        $user = User::where('nivel_acesso', 'aluno')->get();
        return view('alunos', compact('user'));
    }

    // Mostra o formulário para adicionar um novo aluno
    public function create()
    {
        return view('adicionarAluno');
    }

    // Armazena um novo aluno
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'data_nasc' => 'required|date',
            'telefone' => 'required|string|max:15',
            'cpf' => 'required|string|max:14|unique:users',
            'nivel_acesso' => 'required|string',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // Armazena a senha de forma segura
            'data_nasc' => $validated['data_nasc'],
            'telefone' => $validated['telefone'],
            'cpf' => $validated['cpf'],
            'nivel_acesso' => $validated['nivel_acesso'],
        ]);

        return redirect()->route('alunos.index');
    }

    // Mostra o formulário para editar um aluno existente
    public function edit($id)
    {
        $aluno = User::findOrFail($id);
        return view('atualizarAluno', compact('aluno'));
    }

    // Atualiza um aluno existente
    public function update(Request $request, $id)
    {
        $aluno = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'data_nasc' => 'required|date',
            'telefone' => 'required|string|max:15',
            'cpf' => 'required|string|max:14|unique:users,cpf,' . $id,
            'nivel_acesso' => 'required|string',
        ]);

        $aluno->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : $aluno->password,
            'data_nasc' => $validated['data_nasc'],
            'telefone' => $validated['telefone'],
            'cpf' => $validated['cpf'],
            'nivel_acesso' => $validated['nivel_acesso'],
        ]);

        return redirect()->route('alunos.index');
    }

    // Exclui um aluno
    public function destroy($id)
    {
        $aluno = User::findOrFail($id);
        $aluno->delete();

        return redirect()->route('alunos.index');
    }
}
