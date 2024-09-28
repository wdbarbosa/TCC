<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use App\Models\Turma_Disciplina;
use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaDisciplinaController extends Controller
{
    public function index()
    {
        $atribuicoes = Turma_Disciplina::with(['turma', 'disciplina'])
                        ->where('deletado', false)
                        ->get();
        return view('atribuicaoTurmaDisciplina', compact('atribuicoes'));
    }
    public function adicionar()
    {
        $turmas = Turma::whereDoesntHave('turmaDisciplina')->get();
        $disciplinas = Disciplina::all();

        return view('atribuicaoTurmaDisciplinaAdicionar', compact('turmas', 'disciplinas'));
    }
    public function salvar(Request $request)
    {
        $request->validate([
            'turma_id' => 'required|integer|exists:turma,id',
            'disciplinas' => 'required|array',
            'disciplinas.*' => 'integer|exists:disciplina,id',
        ]);

        $turmaId = $request->input('turma_id');
        $disciplinasIds = $request->input('disciplinas');

        foreach ($disciplinasIds as $disciplinaId) 
        {
            Turma_disciplina::create([
                'fk_turma_id' => $turmaId,
                'fk_disciplina_id' => $disciplinaId,
                'dataatribuicao' => now(),
                'deletado' => false,
            ]);
        }

        return redirect()->route('atribuicaoturmadisciplina.index')->with('success', 'Atribuição criada com sucesso');
    }
    public function editar($id)
    {
        $atribuicao = Turma_Disciplina::findOrFail($id);
        $turmas = Turma::all();
        $disciplinas = Disciplina::all();

        return view('atribuicaoTurmaDisciplinaEditar', compact('atribuicao', 'turmas', 'disciplinas'));
    }
    public function atualizar(Request $request, $id)
    {
        $atribuicao = Turma_Disciplina::findOrFail($id);

        $request->validate([
            'fk_turma_id' => 'required|integer|exists:turma,id',  
            'disciplinas' => 'required|array', 
            'disciplinas.*' => 'integer|exists:disciplina,id',
        ]);
    
        $turmaId = $request->input('fk_turma_id');
        $disciplinas = $request->input('disciplinas'); 

        $atribuicao->disciplinas()->sync($disciplinas);

        return redirect()->route('atribuicaoturmadisciplina.index')->with('success', 'Atribuição atualizada com sucesso');
    }

    public function deletar($id)
    {
        $atribuicao = Turma_Disciplina::findOrFail($id);
        $atribuicao->update(['deletado' => true]);

        return redirect()->route('atribuicaoturmadisciplina.index')->with('success', 'Atribuição deletada com sucesso');
    }
}
