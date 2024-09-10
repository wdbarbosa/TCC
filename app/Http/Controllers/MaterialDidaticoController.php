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
        return view('materialDidaticoCriar', compact('disciplina'));
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
        $material->playlist = strtoupper($request->playlist);
        $material->fk_disciplina_id = $id;
        $material->deletado = false;
        $material->save();

        return redirect()->route('materiais.criar', $id)->with('success', 'Material didático cadastrado com sucesso!');
    }

    public function editar($id, $materialId){
        $disciplina = Disciplina::findOrFail($id);
        $material = MaterialDidatico::findOrFail($materialId);

        return view('materialDidaticoEditar', compact ('disciplina', 'material'));
    }

    public function atualizar(Request $request, $id, $materialId){
        $request->validate([
            'titulo' => 'required|max:255',
            'conteudo' => 'required|max:255',
            'playlist' => 'required'
        ]);

        $material = MaterialDidatico::findOrFail($materialId);
        $material->titulo = $request->titulo;
        $material->conteudo = $request->conteudo;
        $material->playlist = strtoupper($request->playlist);
        $material->save();

        return redirect()->route('materiais.index', $id)->with('success', 'Material didático atualizado com sucesso!');
    }

    public function deletar($id, $materialId){
        $material = MaterialDidatico::findOrFail($materialId);
        $material->deletado = true;
        $material->save();

        return redirect()->route('materiais.index', $id)->with('sucess', 'material didatico deletado com sucesso.');
    }
}

