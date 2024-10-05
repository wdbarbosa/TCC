<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaterialDidatico;
use App\Models\Disciplina;
use App\Models\Turma;

class MaterialDidaticoController extends Controller
{
    public function index($id, $turmaId)
    {
        $disciplina = Disciplina::findOrFail($id);
        $turma = Turma::findOrFail($turmaId); 
        $materiais = MaterialDidatico::where('fk_disciplina_id', $id)
                                ->where('deletado', false)
                                ->orderBy('titulo', 'asc')
                                ->get();

        return view('materialDidatico', compact('disciplina', 'materiais', 'turma')); 
    }

    public function criar($id, $turmaId)
    {
        $disciplina = Disciplina::find($id);
        $turma = Turma::find($turmaId);

        return view('materialDidaticoCriar', compact('disciplina', 'turma'));
    }

    public function store(Request $request, $id, $turmaId)
    {
   
        $request->validate([
            'titulo' => 'required|max:255',
            'conteudo' => 'required|max:1000',
            'playlist' => 'required',
            'pdf' => 'nullable|file|mimes:pdf|max:100000',
            'slide' => 'nullable|file|max:100000'
        ]);

        $material = new MaterialDidatico();
        $material->titulo = $request->titulo;
        $material->conteudo = $request->conteudo;
        $material->playlist = strtoupper($request->playlist);
        $material->pdf = $request->pdf;
        $material->slide = $request->slide;
        $material->fk_disciplina_id = $id;
        $material->deletado = false;
        
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('materiais', 'public'); 
            $material->pdf = $pdfPath; 
        }
        
        if ($request->hasFile('slide')) {
            $slidePath = $request->file('slide')->store('materiais', 'public');
            $material->slide = $slidePath;
        }
        
        $material->save();

        return redirect()->route('materiais.index', ['id' => $id, 'turmaId' => $turmaId])
                     ->with('success', 'Material didático cadastrado com sucesso!');
    }


    public function editar($id, $materialId, $turmaId)
    {
        $disciplina = Disciplina::findOrFail($id);
        $material = MaterialDidatico::findOrFail($materialId);
        $turma = Turma::findOrFail($turmaId);

        return view('materialDidaticoEditar', compact('disciplina', 'material', 'turma'));
    }


    public function atualizar(Request $request, $id, $materialId, $turmaId) 
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'conteudo' => 'required|max:1000',
            'playlist' => 'required',
            'pdf' => 'nullable|file|mimes:pdf|max:100000', 
            'slide' => 'nullable|file|max:100000' 
    ]);

        $material = MaterialDidatico::findOrFail($materialId);
        $material->titulo = $request->titulo;
        $material->conteudo = $request->conteudo;
        $material->playlist = strtoupper($request->playlist);

        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('materiais', 'public');
            $material->pdf = $pdfPath;
        }

        if ($request->hasFile('slide')) {
            $slidePath = $request->file('slide')->store('materiais', 'public');
            $material->slide = $slidePath;
        }

        $material->save();

        return redirect()->route('materiais.index', ['id' => $id, 'turmaId' => $turmaId])
            ->with('success', 'Material didático atualizado com sucesso!');
    } 



    public function deletar($id, $materialId, $turmaId)
    {
        $material = MaterialDidatico::findOrFail($materialId);
        $material->deletado = true;
        $material->save();

        return redirect()->route('materiais.index', ['id' => $id, 'turmaId' => $turmaId])
                     ->with('success', 'Material didático deletado com sucesso!');
    }   

}

