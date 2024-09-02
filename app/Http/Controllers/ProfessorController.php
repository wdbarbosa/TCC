<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfessorController extends Controller
{
    // Exibe a lista de professores
    public function index()
    {
        $user = User::where('nivel_acesso', 'professor')->get();
        return view('professores', compact('user'));
    }

    // Mostra o formulário para adicionar um novo professor
    public function create()
    {
        return view('adicionarProfessor');
    }

    // Armazena um novo professor
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
            'password' => Hash::make($validated['password']), // Armazena a senha hashada
            'data_nasc' => $validated['data_nasc'],
            'telefone' => $validated['telefone'],
            'cpf' => $validated['cpf'],
            'nivel_acesso' => $validated['nivel_acesso'],
        ]);

        return redirect()->route('professores.index');
    }

    // Mostra o formulário para editar um professor existente
    public function edit($id)
    {
        $professor = User::findOrFail($id);
        return view('atualizarProfessor', compact('professor'));
    }

    // Atualiza um professor existente
    public function update(Request $request, $id)
    {
        $professor = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8',
            'data_nasc' => 'required|date',
            'telefone' => 'required|string|max:15',
            'cpf' => 'required|string|max:14|unique:users,cpf,'.$id,
            'nivel_acesso' => 'required|string',
        ]);

        $professor->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : $professor->password,
            'data_nasc' => $validated['data_nasc'],
            'telefone' => $validated['telefone'],
            'cpf' => $validated['cpf'],
            'nivel_acesso' => $validated['nivel_acesso'],
        ]);

        return redirect()->route('professores.index');
    }

    // Exclui um professor
    public function destroy($id)
    {
        $professor = User::findOrFail($id);
        $professor->delete();

        return redirect()->route('professores.index');
    }
}
