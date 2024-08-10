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

        $professorExists = Professor::where('fk_professor_users_id', $userId)->exists();

        if ($professorExists) {
            $disciplinas = Atribuicao::where('fk_professor_fk_users_id', $userId)
                                    ->pluck('fk_disciplina_id');

            $questoes = Questao::whereIn('fk_disciplina_id', $disciplinas)->get();

            return view('questoes', compact('questoes'));
        }

        abort(404);
    }

    public function criar()
    {
        $userId = Auth::id();

        $professorExists = Professor::where('fk_professor_users_id', $userId)->exists();

        if ($professorExists) {
            $disciplinasIds = Atribuicao::where('fk_professor_fk_users_id', $userId)
                                ->where('deletado', false)
                                ->pluck('fk_disciplina_id');

            $disciplinas = Disciplina::whereIn('id', $disciplinasIds)->get();
    
            return view('questoesCriar', ['disciplinas' => $disciplinas]);
        }

        abort(404);
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
            'fk_disciplina_id' => 'required|exists:disciplina,id',
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
    
        return $questao ? 
            redirect()->route('questoes.index')->with('success', 'Questão salva com sucesso') :
            back()->withErrors(['msg' => 'Falha ao salvar a questão.'])->withInput();
    }

    public function editar(Questao $questao)
    {
        $userId = Auth::id();

        $professor = Professor::where('fk_professor_users_id', $userId)->first();

        if ($professor) {
            $disciplinas = Atribuicao::where('fk_professor_fk_users_id', $userId)
                                    ->pluck('fk_disciplina_id');
            $disciplinas = Disciplina::whereIn('id', $disciplinas)->get();

            return view('questoesEditar', compact('questao', 'disciplinas'));
        }

        return redirect()->back()->with('error', 'Professor não encontrado.');
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
            'fk_disciplina_id' => 'required|exists:disciplina,id',
            'enunciado' => 'required',
            'assunto' => 'required',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('image_path')) {
            if ($questao->image_path) {
                Storage::disk('public')->delete($questao->image_path);
            }
    
            $path = $request->file('image_path')->store('images', 'public');
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
