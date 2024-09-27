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
        $atribuicoes = Turma_Disciplina::with(['turma', 'disciplina'])->get();
        return view('atribuicaoTurmaDisciplina', compact('atribuicoes'));
    }
    public function adicionar()
    {
        $turmas = Turma::all();
        $disciplinas = Disciplina::all();

        return view('atribuicaoTurmaDisciplinaAdicionar', compact('turmas', 'disciplinas'));
    }
    public function salvar()
    {

    }
    public function editar($id)
    {
        $atribuicao = Turma_Disciplina::findOrFail($id);
        $turmas = Turma::all();
        $disciplinas = Disciplina::all();

        return view('atribuicaoTurmaDisciplinaEditar', compact('atribuicao', 'turmas', 'disciplinas'));
    }
    public function atualizar()
    {

    }
    public function deletar()
    {

    }
}
