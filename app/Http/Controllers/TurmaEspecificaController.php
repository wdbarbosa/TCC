<?php

namespace App\Http\Controllers;

use App\Models\MaterialDidatico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Turma;

class TurmaEspecificaController extends Controller
{
    public function show($id)
    {
        $user = Auth::user();

        if ($user->nivel_acesso === 'professor') {
            $turmas = Turma::findOrFail($id);
            return view('turmaEspecifica', compact('turmas'));
        }

    }

    public function storeMaterial(Request $request, $id)
    {
        $user = Auth::user();

        if ($user->nivel_acesso === 'professor') {
        $material = $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'playlist' => 'nullable|string',
            'fk_disciplina_id' => 'required|exists:disciplina,id',
        ]);

        $turmas = Turma::findOrFail($id);

        $material = new MaterialDidatico();
        $material->titulo = $request->titulo;
        $material->conteudo = $request->conteudo;
        $material->playlist = $request->playlist;
        $material->fk_disciplina_id = $request->fk_disciplina_id;

        $material = MaterialDidatico::create($material);

        return redirect()->route('turmaEspecifica', $turmas->id)->with('success', 'Material didático adicionado com sucesso!');
        }
    }
}
