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
        $atribuicoes = Atribuicao::where('deletado', false)
            ->with(['professor.user', 'disciplina']) 
            ->get();
        $disciplinas = Disciplina::all();
        $professores = Professor::all();
        $turmas = Turma::all();

        return view('atribuicaoProfessor', compact('professores', 'disciplinas', 'atribuicoes', 'turmas'));
    }
    public function adicionar()
    {
        $disciplinas = Disciplina::all();
        $professores = Professor::all();
        $turmas = Turma::all();

        return view('atribuicaoProfessorAdicionar', compact('professores','disciplinas','turmas'));
    }
    public function salvar()
    {

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
