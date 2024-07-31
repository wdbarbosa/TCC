<?php

namespace App\Http\Controllers;

use App\Models\Questao;
use App\Models\Disciplina;
use App\Models\Professor;
use App\Models\Atribuicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class QuestaoController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $disciplinas = Atribuicao::where('fk_professor_fk_pessoa_id_pessoa', $userId)
                                    ->pluck('fk_disciplina_id_disciplina');

        $disciplinasArray = $disciplinas->toArray();
        
        $questoes = Questao::whereIn('fk_disciplina_id_disciplina', $disciplinasArray)->get();

        return view('questoes', compact('questoes'));
    }

    public function criar()
    {
        $user = auth()->user();
        $professor = Professor::find($user->id);
        $disciplinas = Atribuicao::where('fk_professor_fk_pessoa_id_pessoa', $professor)
                            ->where('deletado', false)
                            ->pluck('fk_disciplina_id_disciplina');

        return view('questoesCriar', compact('disciplinas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'banca' => 'required',
            'alternativa_a' => 'required',
            'alternativa_b' => 'required',
            'alternativa_c' => 'required',
            'alternativa_d' => 'required',
            'alternativa_e' => 'required',
            'deletado' => 'required|boolean',
            'alternativacorreta' => 'required',
            'fk_disciplina_id_disciplina' => 'required|exists:disciplina,id_disciplina',
        ]);

        Questao::create($validated);

        return redirect()->route('questoes');
    }

    public function editar(Questao $questao)
    {
        $user = auth()->user();
        $professor = Professor::find($user->id);
        $disciplinas = $professor->disciplinas;

        return view('questoesEditar', compact('questao', 'disciplinas'));
    }

    public function atualizar(Request $request, Questao $questao)
    {
        $validated = $request->validate([
            'banca' => 'required',
            'alternativa_a' => 'required',
            'alternativa_b' => 'required',
            'alternativa_c' => 'required',
            'alternativa_d' => 'required',
            'alternativa_e' => 'required',
            'deletado' => 'required|boolean',
            'alternativacorreta' => 'required',
            'fk_disciplina_id_disciplina' => 'required|exists:disciplina,id_disciplina',
        ]);

        $questao->update($validated);

        return redirect()->route('questoes');
    }

    public function deletar(Questao $questao)
    {
        $questao->delete();

        return redirect()->route('questoes');
    }
}
