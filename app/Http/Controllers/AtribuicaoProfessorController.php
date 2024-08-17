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
        $atribuicoes = Atribuicao::with(['fk_professor_users_id', 'fk_disciplina_id', 'fk_turma_id'])
                                ->whereNull('deletado')
                                ->get();
        return view('atribuicaoProfessor', compact('atribuicoes'));
    }
    public function adicionar()
    {
        $professores = Professor::all();
        $disciplinas = Disciplina::all();
        $turmas = Turma::all();
        return view('atribuicaoProfessorAdicionar', compact('professores', 'disciplinas', 'turmas'));
    }
    public function salvar(Request $request)
    {
        $request->validate([
            'fk_professor_users_id' => 'required|integer|exists:professores,fk_professor_users_id',
            'fk_disciplina_id' => 'required|integer|exists:disciplina,id',
            'fk_turma_id' => 'required|integer|exists:turma,id',
        ]);

        $disciplinaJaAtribuida = Atribuicao::where('fk_disciplina_id', $request->fk_disciplina_id)
                                       ->whereNull('deletado')
                                       ->exists();
        if ($disciplinaJaAtribuida) {
            return redirect()->back()->withErrors(['fk_disciplina_id' => 'Esta disciplina já foi atribuída a um professor.']);
        }
        Atribuicao::create([
            'fk_professor_users_id' => $request->fk_professor_users_id,
            'fk_disciplina_id' => $request->fk_disciplina_id,
            'fk_turma_id' => $request->fk_turma_id,
            'dataatribuicao' => now(),
            'deletado' => null,
        ]);
        return redirect()->route('atribuicaoprofessor.index')->with('success', 'Atribuição criada com sucesso');
    }
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
        $request->validate([
            'fk_professor_users_id' => 'required|integer|exists:professor,fk_professor_users_id',
            'fk_disciplina_id' => 'required|integer|exists:disciplina,id',
            'fk_turma_id' => 'required|integer|exists:turma,id',
        ]);

        $atribuicao = Atribuicao::findOrFail($id);
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
