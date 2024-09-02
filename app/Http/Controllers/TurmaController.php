<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    // Exibe a lista de turmas
    public function index()
    {
        $turmas = Turma::all();
        return view('turmas', compact('turmas'));
    }

    // Mostra uma turma específica
    public function show($id)
    {
        $turma = Turma::findOrFail($id);
        return view('turmaEspecifica', compact('turma'));
    }

    // Mostra o formulário para adicionar uma nova turma
    public function create()
    {
        return view('adicionarTurma');
    }

    // Armazena uma nova turma
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        Turma::create($validated);

        return redirect()->route('turma.index');
    }

    // Mostra o formulário para editar uma turma existente
    public function edit($id)
    {
        $turma = Turma::findOrFail($id);
        return view('atualizarTurma', compact('turma'));
    }

    // Atualiza uma turma existente
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $turma = Turma::findOrFail($id);
        $turma->update($validated);

        return redirect()->route('turma.index');
    }

    // Exclui uma turma
    public function destroy($id)
    {
        $turma = Turma::findOrFail($id);
        $turma->delete();

        return redirect()->route('turma.index');
    }
}
