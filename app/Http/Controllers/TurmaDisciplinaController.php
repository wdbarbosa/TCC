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
        $atribuicoes = Turma_Disciplina::with(['turma', 'disciplinas'])
                        ->where('deletado', false)
                        ->get();
                        
        $turmas = Turma::whereDoesntHave('turmaDisciplina', function($query) {
            $query->where('deletado', false);
        })->get();

        return view('atribuicaoTurmaDisciplina', compact('atribuicoes', 'turmas'));
    }

    public function adicionar()
    {
        $turmas = Turma::whereDoesntHave('turmaDisciplina', function($query) {
            $query->where('deletado', false);
        })->get();

        $disciplinas = Disciplina::all();

        return view('atribuicaoTurmaDisciplinaAdicionar', compact('turmas', 'disciplinas'));
    }

    public function salvar(Request $request)
    {
        $request->validate([
            'turmas' => 'required|array',
            'turmas.*' => 'integer|exists:turma,id',
            'disciplinas' => 'required|array',
            'disciplinas.*' => 'array',
            'disciplinas.*.*' => 'integer|exists:disciplina,id',
        ]);

        $turmasIds = $request->input('turmas');

        $disciplinasPorTurma = $request->input('disciplinas');

        foreach($turmasIds as $turmaId)
        {
            if(isset($disciplinasPorTurma[$turmaId]))
            {
                foreach($disciplinasPorTurma[$turmaId] as $disciplinaId)
                {
                    Turma_Disciplina::create([
                        'fk_turma_id' => $turmaId,
                        'fk_disciplina_id' => $disciplinaId,
                        'deletado' => false,
                    ]);
                }
            }
        }
        
        return redirect()->route('atribuicaoturmadisciplina.index')->with('success', 'Atribuição criada com sucesso');
    }

    public function editar($id)
    {
        $atribuicao = Turma_Disciplina::with(['turma', 'disciplinas'])->findOrFail($id);

        $turmas = Turma::all();

        $disciplinas = Disciplina::all();

        return view('atribuicaoTurmaDisciplinaEditar', compact('atribuicao', 'turmas', 'disciplinas'));
    }
        
    public function atualizar(Request $request, $id)
    {
        $request->validate([
            'fk_turma_id' => 'required|integer|exists:turma,id',
            'disciplinas' => 'required|array',
            'disciplinas.*' => 'integer|exists:disciplina,id',
        ]);

        $turmaId = $request->input('fk_turma_id');

        $disciplinas = $request->input('disciplinas');

        Turma_Disciplina::where('fk_turma_id', $turmaId)
                        ->update(['deletado' => true]); 

        foreach ($disciplinas as $disciplinaId) {
            Turma_Disciplina::updateOrCreate(
                [
                    'fk_turma_id' => $turmaId,
                    'fk_disciplina_id' => $disciplinaId,
                ],
                ['deletado' => false] 
            );
        }

        return redirect()->route('atribuicaoturmadisciplina.index')
                        ->with('success', 'Atribuição atualizada com sucesso');
    }

    public function deletar($id)
    {
        $atribuicao = Turma_Disciplina::findOrFail($id);

        $atribuicao->update(['deletado' => true]);
        
        return redirect()->route('atribuicaoturmadisciplina.index')->with('success', 'Atribuição deletada com sucesso');
    }
}