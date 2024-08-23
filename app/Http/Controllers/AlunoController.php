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
                    ->paginate(1);

        return view('questaoaluno', compact('questoes', 'disciplinaId'));
    }

    public function responder(Request $request)
    {
        $questao = Questao::findOrFail($request->questao_id);

        $respostaCorreta = $questao->alternativacorreta === $request->resposta;

        return redirect()->back()->with([
            'respostaCorreta' => $respostaCorreta,
            'questaoRespondida' => $questao->id,
            'respostaCorretaTexto' => $questao->alternativacorreta
        ]);
    }

}
