<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Models\MaterialDidatico;
use Illuminate\Http\Request;

class DisciplinaController extends Controller
{
    public function index()
    {
        $disciplinas = Disciplina::all();
        
        return view('disciplina', compact('disciplinas'));
    }

    public function create()
    {
        return view('adicionarDisciplina');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome_disciplina' => 'required|string|max:255',
            'disciplina_descricao' => 'nullable|string',
        ]);

        Disciplina::create($validated);

        return redirect()->route('disciplina.index');
    }

    public function edit($id)
    {
        $disciplina = Disciplina::findOrFail($id);
        return view('atualizarDisciplina', compact('disciplina'));
    }

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

    public function destroy($id)
    {
        $disciplina = Disciplina::findOrFail($id);
        $disciplina->delete();

        return redirect()->route('disciplina.index');
    }

    public function mostrarDisciplina($id)
    {
        $disciplina = Disciplina::findOrFail($id);

        $materiais = MaterialDidatico::where('fk_disciplina_id', $id)->get();

        return view('disciplinaEspecifica', [
            'disciplina' => $disciplina,
            'materiais' => $materiais,
        ]);
    }
}
