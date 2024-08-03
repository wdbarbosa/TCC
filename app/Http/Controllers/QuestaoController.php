<?php

namespace App\Http\Controllers;

use App\Models\Questao;
use App\Models\Disciplina;
use App\Models\Professor;
use App\Models\Atribuicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;


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
        $userId = Auth::id();

        $disciplinasIds = Atribuicao::where('fk_professor_fk_pessoa_id_pessoa', $userId)
                                ->where('deletado', false)
                                ->pluck('fk_disciplina_id_disciplina');

        $disciplinas = Disciplina::whereIn('id_disciplina', $disciplinasIds)->get();
    
        return view('questoesCriar', ['disciplinasArray' => $disciplinas]);
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
            'enunciado' => 'required',
            'assunto' => 'required',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    
        // Processamento da imagem
        if ($request->hasFile('image_path')) {
            $image_path = $request->file('image_path')->store('images', 'public');
            $validated['image_path'] = $image_path;
        }
    
        // Criação da questão
        $questao = Questao::create($validated);
    
        if ($questao) {
            return redirect()->route('questoes.index')->with('success', 'Questão salva com sucesso');
        } else {
            return back()->withErrors(['msg' => 'Falha ao salvar a questão.'])->withInput();
        }
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
            'enunciado' => 'required',
            'alternativa_a' => 'required',
            'alternativa_b' => 'required',
            'alternativa_c' => 'required',
            'alternativa_d' => 'required',
            'alternativa_e' => 'required',
            'deletado' => 'required|boolean',
            'alternativacorreta' => 'required',
            'fk_disciplina_id_disciplina' => 'required|exists:disciplina,id_disciplina',
            'assunto' => 'required',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('image_path')) {
            // Apagar imagem antiga se existir
            if ($questao->image_path) {
                Storage::disk('public')->delete($questao->image_path);
            }
    
            // Armazenar a nova imagem
            $path = $request->file('image_path')->store('imagens', 'public');
            $validated['image_path'] = $path;
        }

        $questao->update($validated);

        return redirect()->route('questoes.index');
    }

    public function deletar(Questao $questao)
    {
        $questao->delete();

        return redirect()->route('questoes.index')->with('deletado', 'Questão deletada');
    }
}
