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
        return view('atribuicaoProfessorDisciplina', compact('atribuicoes'));
    }
    public function adicionar()
    {
        $professores = Professor::whereDoesntHave('disciplinas')->get();
        $disciplinas = Disciplina::all();

        return view('atribuicaoProfessorDisciplinaAdicionar', compact('professores', 'disciplinas'));
    }
    public function salvar(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'professores' => 'required|array',
            'professores.*' => 'exists:professor,fk_professor_users_id',
            'disciplinas' => 'required|array',
            'disciplinas.*' => 'exists:disciplina,id',
        ]);
        // Loop pelos professores
        foreach ($request->professores as $professorId) {
            // Loop pelas disciplinas selecionadas
            foreach ($request->disciplinas as $disciplinaId) {
                // Criação da atribuição
                Professor_Disciplina::create([
                    'fk_professor_users_id' => $professorId,
                    'fk_disciplina_id' => $disciplinaId,
                    'deletado' => false,
                ]);
            }
        }
        // Redirecionar após salvar com sucesso
        return redirect()->route('atribuicaoprofessordisciplina.index')->with('success', 'Atribuições salvas com sucesso!');
    }
    public function editar($id)
    {
        $atribuicao = Professor_Disciplina::findOrFail($id);
        $professores = Professor::all();
        $disciplinas = Disciplina::all();

        return view('atribuicaoProfessorDisciplinaEditar', compact('atribuicao', 'professores', 'disciplinas'));
    }
    public function atualizar(Request $request, $id)
    {
        $atribuicao = Professor_Disciplina::findOrFail($id);

        $request->validate([
            'professor_id' => 'required|integer|exists:professor,fk_professor_users_id',  
            'disciplinas' => 'required|array', 
            'disciplinas.*' => 'integer|exists:disciplina,id',
        ]);
    
        $professorId = $request->input('professor_id');
        $disciplinas = $request->input('disciplinas'); 

        $atribuicao->disciplinas()->sync($disciplinas);

        return redirect()->route('atribuicaoprofessordisciplina.index')->with('success', 'Atribuição atualizada com sucesso');
    }

    public function deletar($id)
    {
        $atribuicao = Professor_Disciplina::findOrFail($id);
        $atribuicao->update(['deletado' => true]);

        return redirect()->route('atribuicaoprofessordisciplina.index')->with('success', 'Atribuição deletada com sucesso');
    }
}
