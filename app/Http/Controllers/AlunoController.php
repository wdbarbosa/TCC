<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\Questao;


class AlunoController extends Controller
{
    public function index()
    {
        $disciplinas = Disciplina::all();
        return view('questoesdisciplinas', compact('disciplinas'));
    }

    public function listarBancas($disciplinaId)
    {
        $disciplinas = Disciplina::findOrFail($disciplinaId);
        $bancas = Questao::where('fk_disciplina_id', $disciplinaId)
                    ->select('banca')
                    ->distinct()
                    ->get();

        return view('questoesbancas', compact('bancas', 'disciplinaId'));
    }

    public function listarQuestoes($disciplinaId, $banca)
    {
        $questoes = Questao::where('fk_disciplina_id', $disciplinaId)
                    ->where('banca', $banca)
                    ->get();

        return view('questaoaluno', compact('questoes', 'disciplinaId'));
    }

    public function responder(Request $request)
    {
        $questoes = Questao::whereIn('id', $request->questoes_ids)->get();

        return view('questoesrespostas', compact('questoes', 'request'));
    }

}
