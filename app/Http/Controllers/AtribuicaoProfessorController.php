<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Disciplina;
use App\Models\Atribuicao;
use App\Models\Turma;
use App\Models\Atribuicao_Turma;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AtribuicaoProfessorController extends Controller
{
    public function index()
    {
        // Buscar turmas que têm disciplinas associadas e onde as disciplinas não têm professores atribuídos (ou estão "deletados")
        $turmasSemAtribuicao = Turma::whereHas('disciplinas')
        ->whereDoesntHave('atribuicoes', function ($query) {
            $query->where('deletado', false);
        })
        ->with(['disciplinas.professores'])
        ->get();

        // Buscar todas as atribuições existentes e ativas
        $atribuicoes = Atribuicao::with(['professor.user', 'disciplina', 'turma'])
            ->where('deletado', false)
            ->get();

        $atribuicoes = $atribuicoes->sortBy(function ($atribuicao) {
            return $atribuicao->professor->user->name;
        });

        return view('atribuicaoProfessor', compact('atribuicoes', 'turmasSemAtribuicao'));
    }

    public function adicionar()
    {
        // Carregar todas as turmas que têm disciplinas associadas, onde essas disciplinas não têm atribuições ativas
        $turmas = Turma::whereHas('disciplinas', function ($query) {
                // Verifica se a disciplina está associada a professores e não possui uma atribuição ativa
                $query->whereHas('professores')
                    ->whereDoesntHave('atribuicoes', function ($subQuery) {
                        $subQuery->where('deletado', false); // Considera "deletado = false" como atribuição ativa
                    });
            })
            ->with([
                'disciplinas' => function ($query) {
                    // Carrega disciplinas com seus professores associados
                    $query->with(['professores.user'])
                        ->whereDoesntHave('atribuicoes', function ($subQuery) {
                            $subQuery->where('deletado', false);
                        });
                }
            ])
            ->get();

        return view('atribuicaoProfessorAdicionar', compact('turmas'));
    }
    public function salvar(Request $request)
    {
        $validated = $request->validate([
            'atribuicoes' => 'required|array',
            'atribuicoes.*' => 'required|array',
            'atribuicoes.*.*.fk_professor_users_id' => 'required|exists:professor,fk_professor_users_id',
        ]);

        // Itera sobre as atribuições recebidas do formulário
        foreach ($request->input('atribuicoes') as $turmaId => $disciplinas) 
        {
            foreach ($disciplinas as $disciplinaId => $data) 
            {
                Atribuicao::create([
                    'fk_professor_users_id' => $data['fk_professor_users_id'],
                    'fk_disciplina_id' => $disciplinaId, 
                    'fk_turma_id' => $turmaId, 
                    'deletado' => false,
                    'dataatribuicao' => Carbon::now(),
                ]);
            }
        }

        return redirect()->route('atribuicaoprofessor.index')->with('success', 'Atribuições salvas com sucesso!');
    }

    public function editar($id) 
    {
        // Obtém a atribuição junto com a disciplina e a turma
        $atribuicao = Atribuicao::with(['disciplina', 'turma', 'professor.user'])->findOrFail($id);

        // Obtém apenas os professores que estão associados à disciplina da atribuição
        $professores = Professor::whereHas('disciplinas', function ($query) use ($atribuicao) {
            $query->where('fk_disciplina_id', $atribuicao->fk_disciplina_id);
        })->get();

        return view('atribuicaoProfessorEditar', compact('atribuicao', 'professores'));
    }
        
    public function atualizar(Request $request, $id) 
    {
        $request->validate([
            'fk_professor_users_id' => 'required|exists:professor,fk_professor_users_id',
        ]);

        $atribuicao = Atribuicao::findOrFail($id);
        
        $atribuicao->fk_professor_users_id = $request->fk_professor_users_id;

        $atribuicao->save();

        return redirect()->route('atribuicaoprofessor.index')->with('success', 'Atribuição atualizada com sucesso.');
    }

    public function deletar($id)
    {
        $atribuicao = Atribuicao::findOrFail($id);

        $atribuicao->update(['deletado' => true]);
        
        return redirect()->route('atribuicaoprofessor.index')->with('success', 'Atribuição deletada com sucesso');
    }
}