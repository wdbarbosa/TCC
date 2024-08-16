<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Turma;

class AtribuicaoAlunoController extends Controller
{
    public function index()
    {
        $turmas = Turma::with('alunos.user')->get();
        return view('atribuicaoAluno', compact('turmas'));
    }
    public function adicionar()
    {
        $alunos = Aluno::whereNull('fk_turma_id')->get();
        $turmas = Turma::all();
        
        return view('atribuicaoAlunoAdicionar', compact('alunos','turmas'));
    }
    public function salvar(Request $request)
    {
        $request->validate([
            'turma' => 'required|array',
            'turma.*' => 'required|integer|exists:turma,id',
        ]);

        $turmas = $request->input('turma');

        foreach ($turmas as $id_aluno => $id_turma) 
        {
            $aluno = Aluno::findOrFail($id_aluno);
            $aluno->fk_turma_id = $id_turma;
            $aluno->save();
        }
        return redirect()->route('atribuicaoaluno.index');
    }
    public function editar($id)
    {
        $aluno = Aluno::findOrFail($id);
        $turmas = Turma::all();
        return view('atribuicaoAlunoEditar', compact('aluno', 'turmas'));
    }
    public function atualizar(Request $request, $id)
    {
        $request->validate([
            'turma' => 'required|integer|exists:turma,id',
        ]);
    
        $aluno = Aluno::findOrFail($id);
        $turma = $request->input('turma');
        $aluno->fk_turma_id = $turma;
        $aluno->save();
    
        return redirect()->route('atribuicaoaluno.index');
    }
    public function deletar($id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->fk_turma_id = null;
        $aluno->save();
        return redirect()->route('atribuicaoaluno.index');
    }
}
