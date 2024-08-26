<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Disciplina;
use App\Models\Atribuicao;
use App\Models\Turma;

class AtribuicaoProfessorController extends Controller
{
    public function index()
    {
        $atribuicoes = Atribuicao::with(['professor', 'disciplina', 'turmas'])
                                  ->where('deletado', false)
                                  ->get();
        return view('atribuicaoProfessor', compact('atribuicoes'));
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
            'professor_id' => 'required|integer|exists:professores,fk_professor_users_id',
            'disciplina_id' => 'required|integer|exists:disciplinas,id',
            'turmas' => 'required|array',
            'turmas.*' => 'integer|exists:turmas,id',
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


        foreach ($request->professor as $disciplinaId => $professorId) 
        {
            if (empty($request->turmas[$disciplinaId]) || !is_array($request->turmas[$disciplinaId]) || count($request->turmas[$disciplinaId]) === 0) 
            {
                return redirect()->back()->withErrors(['turmas' => 'A disciplina deve ter pelo menos uma turma associada.']);
            }

            if (Atribuicao::where('fk_disciplina_id', $disciplinaId)
                        ->where('deletado', false)
                        ->exists()) {
                return redirect()->back()->withErrors(['professor' => 'A disciplina ' . $disciplinaId . ' já foi atribuída a um professor.']);
            }

            foreach ($request->turmas[$disciplinaId] as $turmaId) 
            {
                Atribuicao::create([
                    'fk_professor_users_id' => $professorId,
                    'fk_disciplina_id' => $disciplinaId,
                    'fk_turma_id' => $turmaId,
                    'dataatribuicao' => now(),
                    'deletado' => false,
                ]);
            }
        }

        return redirect()->route('atribuicaoprofessor.index')->with('success', 'Atribuição(ões) criada(s) com sucesso');
    }

    // Recupera os dados da requisição
    

    // Verifica se a disciplina já foi atribuída a um professor
    
    //PAREI AQUI
    // Cria a atribuição
    /*$atribuicao = Atribuicao::create([
        'fk_professor_users_id' => $professorId,
        'fk_disciplina_id' => $disciplinaId,
        'dataatribuicao' => now(),
        'deletado' => false,
    ]);

    // Associa as turmas à atribuição
    foreach ($turmasIds as $turmaId) {
        Atribuicao_Turma::create([
            'fk_atribuicao_id' => $atribuicao->id,
            'fk_turma_id' => $turmaId,
        ]);
    }

    return redirect()->route('atribuicaoprofessor.index')->with('success', 'Atribuição criada com sucesso');
}*/


    public function editar($id)
    {
        $atribuicao = Atribuicao::findOrFail($id);
        $professores = Professor::all();
        $disciplinas = Disciplina::all();
        $turmas = Turma::all();

        return view('atribuicaoProfessorEditar', compact('atribuicao', 'professores', 'disciplinas', 'turmas'));
    }

    public function atualizar(Request $request, $id)
    {
        $atribuicao = Atribuicao::findOrFail($id);
        
        $request->validate([
            'fk_professor_users_id' => 'required|integer|exists:professor,fk_professor_users_id',
            'fk_disciplina_id' => 'required|integer|exists:disciplina,id',
            'fk_turma_id' => 'required|integer|exists:turma,id',
        ]);

        
        $atribuicao->update([
            'fk_professor_users_id' => $request->input('fk_professor_users_id'),
            'fk_disciplina_id' => $request->input('fk_disciplina_id'),
            'fk_turma_id' => $request->input('fk_turma_id'),
        ]);

        return redirect()->route('atribuicaoprofessor.index');
    }

    public function deletar($id)
    {
        $atribuicao = Atribuicao::findOrFail($id);
        $atribuicao->update(['deletado' => true]);

        return redirect()->route('atribuicaoprofessor.index');
    }

}
