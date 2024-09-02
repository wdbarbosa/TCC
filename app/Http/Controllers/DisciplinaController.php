<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use Illuminate\Http\Request;

class DisciplinaController extends Controller
{
    // Exibe a lista de disciplinas
    public function index()
    {
        $disciplinas = Disciplina::all();
        return view('disciplina', compact('disciplinas'));
    }

    // Mostra o formulário para adicionar uma nova disciplina
    public function create()
    {
        return view('adicionarDisciplina');
    }

    // Armazena uma nova disciplina
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome_disciplina' => 'required|string|max:255',
            'disciplina_descricao' => 'nullable|string',
        ]);

        Disciplina::create($validated);

        return redirect()->route('disciplina.index');
    }

    // Mostra o formulário para editar uma disciplina existente
    public function edit($id)
    {
        $disciplina = Disciplina::findOrFail($id);
        return view('atualizarDisciplina', compact('disciplina'));
    }

    // Atualiza uma disciplina existente
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nome_disciplina' => 'required|string|max:255',
            'disciplina_descricao' => 'nullable|string',
        ]);

        $disciplina = Disciplina::findOrFail($id);
        $disciplina->update($validated);

        return redirect()->route('disciplina.index');
    }

    // Exclui uma disciplina
    public function destroy($id)
    {
        $disciplina = Disciplina::findOrFail($id);
        $disciplina->delete();

        return redirect()->route('disciplina.index');
    }
}
