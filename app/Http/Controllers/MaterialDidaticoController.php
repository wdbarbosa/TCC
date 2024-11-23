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
        'titulo' => 'required|string|max:255',
        'conteudo' => 'required',
        'playlist' => 'required',
        'pdf' => 'nullable|mimes:pdf|max:2048',
        'slide' => 'nullable|mimes:ppt,pptx|max:2048',
    ]);

    // Salvar arquivos na pasta public/materiais
    $pdfPath = null;
    if ($request->hasFile('pdf')) {
        $nomePdf = time() . '_' . $request->file('pdf')->getClientOriginalName();
        $request->file('pdf')->move(public_path('materiais'), $nomePdf);
        $pdfPath = 'materiais/' . $nomePdf; // Caminho relativo ao public
    }

    $slidePath = null;
    if ($request->hasFile('slide')) {
        $nomeSlide = time() . '_' . $request->file('slide')->getClientOriginalName();
        $request->file('slide')->move(public_path('materiais'), $nomeSlide);
        $slidePath = 'materiais/' . $nomeSlide; // Caminho relativo ao public
    }

    // Criar material no banco de dados
    $material = new MaterialDidatico(); // Corrigido para MaterialDidatico
    $material->titulo = $request->titulo;
    $material->conteudo = $request->conteudo;
    $material->playlist = $request->playlist;
    $material->pdf = $pdfPath; // Caminho salvo
    $material->slide = $slidePath; // Caminho salvo
    $material->fk_disciplina_id = $id; // Relaciona com a disciplina
    $material->deletado = false;
    $material->save();

    // Redireciona com sucesso
    return redirect()
        ->route('materiais.index', ['id' => $id, 'turmaId' => $turmaId])
        ->with('success', 'Material didático adicionado com sucesso!');

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
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'playlist' => 'nullable|string|max:255',
            'pdf' => 'nullable|mimes:pdf|max:2048',
            'slide' => 'nullable|mimes:ppt,pptx|max:2048',
        ]);
    
        $material = MaterialDidatico::findOrFail($materialId);
        $material->titulo = $request->titulo;
        $material->conteudo = $request->conteudo;
        $material->playlist = $request->playlist;
    
        // Atualizar PDF
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->move(public_path('materiais'), $request->file('pdf')->getClientOriginalName());
            $material->pdf = 'materiais/' . $request->file('pdf')->getClientOriginalName();
        }
    
        // Atualizar Slide
        if ($request->hasFile('slide')) {
            $slidePath = $request->file('slide')->move(public_path('materiais'), $request->file('slide')->getClientOriginalName());
            $material->slide = 'materiais/' . $request->file('slide')->getClientOriginalName();
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

