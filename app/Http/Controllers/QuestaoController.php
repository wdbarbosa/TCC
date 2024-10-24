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
    public function index(Request $request)
    {
        $userId = Auth::id();
        $user = Auth::user();
    
        if ($user->nivel_acesso === 'aluno') {
            return redirect()->route('aluno.disciplinas');
        }
    
        $professorExists = Professor::where('fk_professor_users_id', $userId)->exists();
    
        if ($professorExists) {
            $disciplinas = Atribuicao::where('fk_professor_users_id', $userId)
                                    ->where('deletado', false)
                                    ->pluck('fk_disciplina_id');
    
            $query = Questao::whereIn('fk_disciplina_id', $disciplinas);
    
            if ($request->has('disciplina') && !empty($request->input('disciplina'))) {
                $query->where('fk_disciplina_id', $request->input('disciplina'));
            }
    
            if ($request->has('search') && !empty($request->input('search'))) {
                $query->where('id', $request->input('search'));
            }
    
            // Paginação com 3 questões por página
            $questoes = $query->paginate(2);
    
            $listaDisciplinas = Disciplina::whereIn('id', $disciplinas)->get();
    
            return view('questoes', compact('questoes', 'listaDisciplinas'));
        }
    
        abort(404);
    }
    


    public function criar()
    {
        $userId = Auth::id();

        $professorExists = Professor::where('fk_professor_users_id', $userId)->exists();

        if ($professorExists) {
            $disciplinasIds = Atribuicao::where('fk_professor_users_id', $userId)
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
            'banca' => 'required|regex:/^[\w\s\(\)\-\/]+$/',
            'alternativa_a' => 'nullable',
            'alternativa_b' => 'nullable',
            'alternativa_c' => 'nullable',
            'alternativa_d' => 'nullable',
            'alternativa_e' => 'nullable',
            'deletado' => 'required|boolean',
            'alternativacorreta' => 'required',
            'fk_disciplina_id' => 'required|exists:disciplina,id',
            'enunciado' => 'required',
            'assunto' => 'required',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        $validated['banca'] = strtoupper($validated['banca']);
        $validated['assunto'] = strtoupper($validated['assunto']);

        if ($request->hasFile('image_path')) {
            $image_path = $request->file('image_path')->store('images', 'public');
            $validated['image_path'] = $image_path;
        }
    
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
            $disciplinas = Atribuicao::where('fk_professor_users_id', $userId)
                                    ->pluck('fk_disciplina_id');
            $disciplinas = Disciplina::whereIn('id', $disciplinas)->get();

            return view('questoesEditar', compact('questao', 'disciplinas'));
        }

        return redirect()->back()->with('error', 'Professor não encontrado.');
    }

    public function atualizar(Request $request, Questao $questao)
    {
        $validated = $request->validate([
            'banca' => 'required|regex:/^[\w\s\(\)\-\/]+$/',
            'alternativa_a' => 'nullable',
            'alternativa_b' => 'nullable',
            'alternativa_c' => 'nullable',
            'alternativa_d' => 'nullable',
            'alternativa_e' => 'nullable',
            'deletado' => 'required|boolean',
            'alternativacorreta' => 'required',
            'fk_disciplina_id' => 'required|exists:disciplina,id',
            'enunciado' => 'required',
            'assunto' => 'required',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $validated['banca'] = strtoupper($validated['banca']);
        $validated['assunto'] = strtoupper($validated['assunto']);

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
