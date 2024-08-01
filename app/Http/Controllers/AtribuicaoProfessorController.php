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

        return view('atribuicaoProfessorDisciplina', compact('professores', 'disciplinas', 'atribuicoes', 'turmas'));
    }
        
}
