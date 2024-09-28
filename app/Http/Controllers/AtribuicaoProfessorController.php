<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Disciplina;
use App\Models\Atribuicao;
use App\Models\Turma;
use App\Models\Atribuicao_Turma;

class AtribuicaoProfessorController extends Controller
{
    public function index()
    {
        
        $disciplinasAtribuidas = Atribuicao::where('deletado', false)
                                        ->pluck('fk_disciplina_id')
                                        ->toArray();
        $disciplinas = Disciplina::whereNotIn('id', $disciplinasAtribuidas)->get();

        $atribuicoes = Atribuicao::with(['professor', 'disciplina', 'turma'])
                                  ->where('deletado', false)
                                  ->get();
        return view('atribuicaoProfessor', compact('atribuicoes', 'disciplinas'));
    }

    public function adicionar()
    {
        $professores = Professor::all();
        $disciplinasAtribuidas = Atribuicao::where('deletado', false)
                                        ->pluck('fk_disciplina_id')
                                        ->toArray();
        $disciplinas = Disciplina::whereNotIn('id', $disciplinasAtribuidas)->get();
        $turmas = Turma::all();

        return view('atribuicaoProfessorAdicionar', compact('professores', 'disciplinas', 'turmas'));
    }
    
    public function salvar(Request $request)
    {
        $request->validate([
            'professor_id' => 'required|integer|exists:professor,fk_professor_users_id',
            'disciplina_id' => 'required|integer|exists:disciplina,id',
            'turmas' => 'required|array',
            'turmas.*' => 'integer|exists:turma,id',
        ]);

        $professorId = $request->input('professor_id');
        $disciplinaId = $request->input('disciplina_id');
        $turmasIds = $request->input('turmas');

        if (Atribuicao::where('fk_disciplina_id', $disciplinaId)
                  ->where('deletado', false)
                  ->exists()) 
        {
            return redirect()->back()->withErrors(['disciplina_id' => 'A disciplina já foi atribuída a um professor.']);
        }

        $atribuicao = Atribuicao::create([
            'fk_professor_users_id' => $professorId,
            'fk_disciplina_id' => $disciplinaId,
            'dataatribuicao' => now(),
            'deletado' => false,
        ]);

        foreach ($turmasIds as $turmaId) 
        {
            Atribuicao_Turma::create([
                'fk_atribuicao_id' => $atribuicao->id,
                'fk_turma_id' => $turmaId,
            ]);
        }

        return redirect()->route('atribuicaoprofessor.index')->with('success', 'Atribuição criada com sucesso');
    }


    public function editar($id)
    {
        $atribuicao = Atribuicao::with('turmas')->findOrFail($id);
        $professores = Professor::all();
        $turmas = Turma::all();

        return view('atribuicaoProfessorEditar', compact('atribuicao', 'professores', 'turmas'));
    }

    public function atualizar(Request $request, $id)
    {
        $atribuicao = Atribuicao::findOrFail($id);
        
        $request->validate([
            'fk_professor_users_id' => 'required|integer|exists:professor,fk_professor_users_id',
            'turmas' => 'required|array',
            'turmas.*' => 'integer|exists:turma,id',
        ]);
        
        $atribuicao->update([
            'fk_professor_users_id' => $request->input('fk_professor_users_id'),
        ]);
    
        $atribuicao->turmas()->sync($request->input('turmas'));
    
        return redirect()->route('atribuicaoprofessor.index')->with('success', 'Atribuição atualizada com sucesso');
    }
        
    public function deletar($id)
    {
        $atribuicao = Atribuicao::findOrFail($id);
        $atribuicao->update(['deletado' => true]);

        return redirect()->route('atribuicaoprofessor.index')->with('success', 'Atribuição deletada com sucesso');
    }

}
