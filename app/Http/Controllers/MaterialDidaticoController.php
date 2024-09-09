<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaterialDidatico;
use App\Models\Disciplina;

class MaterialDidaticoController extends Controller
{
    public function index($id)
    {
        $disciplina = Disciplina::findOrFail($id);
        $materiais = MaterialDidatico::where('fk_disciplina_id', $id)
                                    ->where('deletado', false)
                                    ->get();

        return view('materialDidatico', compact('disciplina', 'materiais'));
    }

    public function criar($id)
    {
        $disciplina = Disciplina::findOrFail($id);
        return view('materiais.create', compact('disciplina'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'conteudo' => 'required|max:255',
            'playlist' => 'required'
        ]);

        $material = new MaterialDidatico();
        $material->titulo = $request->titulo;
        $material->conteudo = $request->conteudo;
        $material->playlist = $request->playlist;
        $material->fk_disciplina_id = $id;
        $material->deletado = false;
        $material->save();

        return redirect()->route('materialDidaticoCriar', $id)->with('success', 'Material didático cadastrado com sucesso!');
    }
}

