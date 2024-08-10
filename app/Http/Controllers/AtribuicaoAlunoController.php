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
    public function editar()
    {
        
    }
    public function atualizar()
    {

    }
    public function deletar()
    {
        
    }
}
