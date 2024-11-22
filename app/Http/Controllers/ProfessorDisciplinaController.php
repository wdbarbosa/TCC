<?php

namespace App\Http\Controllers;

use App\Models\Professor_Disciplina;
use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Disciplina;

class ProfessorDisciplinaController extends Controller
{
    public function index()
    {
        $atribuicoes = Professor_Disciplina::with(['professor.user', 'disciplina'])
                            ->where('deletado', false)
                            ->get();

        $professores = Professor::whereDoesntHave('professorDisciplina', function($query) {
            $query->where('deletado', false);
        })->get();

        return view('atribuicaoProfessorDisciplina', compact('atribuicoes', 'professores'));
    }

    public function adicionar()
    {
        $professores = Professor::whereDoesntHave('professorDisciplina', function($query) {
            $query->where('deletado', false);
        })->get();

        $disciplinas = Disciplina::where('deletado', 'n')
            ->get();

        return view('atribuicaoProfessorDisciplinaAdicionar', compact('professores', 'disciplinas'));
    }
    public function salvar(Request $request)
    {
        $request->validate([
            'professores' => 'required|array',
            'professores.*' => 'exists:professor,fk_professor_users_id',
            'disciplinas' => 'required|array',
        ]);
        
        foreach ($request->professores as $professorId) 
        {
            if (isset($request->disciplinas[$professorId])) 
            {
                foreach ($request->disciplinas[$professorId] as $disciplinaId) 
                {
                    Professor_Disciplina::create([
                        'fk_professor_users_id' => $professorId,
                        'fk_disciplina_id' => $disciplinaId,
                        'deletado' => false,
                    ]);
                }
            }
        }

        return redirect()->route('atribuicaoprofessordisciplina.index')->with('success', 'Atribuições salvas com sucesso!');
    }
    public function editar($id)
    {
        $atribuicao = Professor_Disciplina::with('professor', 'disciplina')->findOrFail($id);
        $professores = Professor::all();
        $disciplinas = Disciplina::where('deletado', 'n')
            ->get();

        $disciplinasAtuais = $atribuicao->professor->disciplinas->pluck('id')->toArray();

        return view('atribuicaoProfessorDisciplinaEditar', compact('atribuicao', 'professores', 'disciplinas', 'disciplinasAtuais'));
    }
    public function atualizar(Request $request, $id)
    {
        $atribuicao = Professor_Disciplina::findOrFail($id);

        $request->validate([
            'fk_professor_users_id' => 'required|integer|exists:professor,fk_professor_users_id',
            'disciplinas' => 'required|array',
            'disciplinas.*' => 'integer|exists:disciplina,id',
        ]);

        $atribuicao->fk_professor_users_id = $request->input('fk_professor_users_id');

        $disciplinas = $request->input('disciplinas');

        foreach ($disciplinas as $disciplinaId) 
        {
            $existeAtribuicao = Professor_Disciplina::where([
                ['fk_professor_users_id', '=', $atribuicao->fk_professor_users_id],
                ['fk_disciplina_id', '=', $disciplinaId],
                ['deletado', '=', false]
            ])->exists();
            
            if (!$existeAtribuicao) {
                Professor_Disciplina::create([
                    'fk_professor_users_id' => $atribuicao->fk_professor_users_id,
                    'fk_disciplina_id' => $disciplinaId,
                    'deletado' => false,
                ]);
            }
        }

    return redirect()->route('atribuicaoprofessordisciplina.index')->with('success', 'Atribuição atualizada com sucesso');
    }
    public function deletar($id)
    {
        $atribuicao = Professor_Disciplina::findOrFail($id);
        $atribuicao->update(['deletado' => true]);

        return redirect()->route('atribuicaoprofessordisciplina.index')->with('success', 'Atribuição deletada com sucesso');
    }
}
