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
        // Consulta turmas que têm disciplinas que podem ser atribuídas
        $turmasSemAtribuicao = Turma::whereHas('disciplinas', function ($query) {
            $query->where(function ($subQuery) {
                // 1. Disciplinas que não têm atribuições ativas
                $subQuery->whereDoesntHave('atribuicoes', function ($subSubQuery) {
                    $subSubQuery->where('deletado', false);
                });
            })
            ->orWhereHas('atribuicoes', function ($subQuery) {
                // 2. Disciplinas com atribuições deletadas
                $subQuery->where('deletado', true);
            });
        })
        ->with([
            'disciplinas' => function ($query) {
                $query->whereDoesntHave('atribuicoes', function ($subQuery) {
                    $subQuery->where('deletado', false);
                })
                ->orWhereHas('atribuicoes', function ($subQuery) {
                    $subQuery->where('deletado', true);
                });
            },
            'disciplinas.professores.user'
        ])->get();

        // Carrega atribuições ativas (onde deletado é false) para organização na view
        $atribuicoes = Atribuicao::with(['professor.user', 'disciplina', 'turma'])
            ->where('deletado', false)
            ->get()
            ->sortBy(fn($atribuicao) => $atribuicao->professor->user->name);

        return view('atribuicaoProfessor', compact('atribuicoes', 'turmasSemAtribuicao'));
    }

    public function adicionar()
    {
        // Buscar todas as turmas que têm disciplinas sem atribuição ativa ou apenas com atribuição deletada
        $turmasComDisciplinasPendentes = Turma::with([
            'disciplinas' => function ($query) {
                // Carregar disciplinas sem atribuição ativa ou apenas com atribuições deletadas
                $query->whereDoesntHave('atribuicoes', function ($subQuery) {
                    $subQuery->where('deletado', false); // Exclui disciplinas com atribuições ativas
                })
                ->orWhereHas('atribuicoes', function ($subQuery) {
                    $subQuery->where('deletado', true); // Inclui disciplinas com atribuições deletadas
                });
            },
            'disciplinas.professores.user' // Carrega os professores que podem lecionar as disciplinas
        ])->get();

        // Filtra as turmas para incluir apenas aquelas que têm disciplinas sem atribuição ativa
        $turmasComDisciplinasPendentes = $turmasComDisciplinasPendentes->filter(function ($turma) {
            return $turma->disciplinas->isNotEmpty();
        });

        // Se não houver turmas com disciplinas pendentes, redireciona para a lista principal com mensagem
        if ($turmasComDisciplinasPendentes->isEmpty()) {
            return redirect()->route('atribuicaoprofessor.index')->with('info', 'Todas as atribuições já foram realizadas.');
        }

        return view('atribuicaoProfessorAdicionar', compact('turmasComDisciplinasPendentes'));
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