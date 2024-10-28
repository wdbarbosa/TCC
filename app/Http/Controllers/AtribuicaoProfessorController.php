<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Disciplina;
use App\Models\Atribuicao;
use App\Models\Turma;
use App\Models\Atribuicao_Turma;
use Carbon\Carbon;

class AtribuicaoProfessorController extends Controller
{
    public function index()
    {
        // Carregar as atribuições com os relacionamentos necessários
        $atribuicoes = Atribuicao::with(['professor.user', 'disciplina', 'turma'])
            ->where('deletado', false) 
            ->get();

        $atribuicoes = $atribuicoes->sortBy(function($atribuicao) {
            return $atribuicao->professor->user->name;
        });

        return view('atribuicaoProfessor', compact('atribuicoes'));
    }

    public function adicionar()
    {
        // Carregar todas as turmas que têm disciplinas associadas e professores para essas disciplinas
        $turmas = Turma::whereHas('disciplinas', function ($query) {
                // Verifica se a disciplina está associada a professores
                $query->whereHas('professores');
            })
            ->with([
                'disciplinas' => function ($query) {
                    // Carrega as disciplinas e apenas os professores associados na tabela professor_disciplina
                    $query->with(['professores.user']); // Inclui o relacionamento com o User para o nome do professor
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
        foreach ($request->input('atribuicoes') as $turmaId => $disciplinas) {
            foreach ($disciplinas as $disciplinaId => $data) {
                // Cria uma nova atribuição
                Atribuicao::create([
                    'fk_professor_users_id' => $data['fk_professor_users_id'], // ID do professor selecionado
                    'fk_disciplina_id' => $disciplinaId, // ID da disciplina
                    'fk_turma_id' => $turmaId, // ID da turma
                    'deletado' => false,
                    'dataatribuicao' => Carbon::now(),
                ]);
            }
        }
    
        // Redireciona para a lista de atribuições com uma mensagem de sucesso
        return redirect()->route('atribuicaoprofessor.index')->with('success', 'Atribuições salvas com sucesso!');
    }
   

    public function editar($id)
    {
        $atribuicao = Atribuicao::with('turma')->findOrFail($id);
        $professores = Professor::all();
        $turmas = Turma::all();

        return view('atribuicaoProfessorEditar', compact('atribuicao', 'professores', 'turmas'));
    }

    public function atualizar(Request $request, $id)
    {
        $atribuicao = Atribuicao::findOrFail($id);
        
        $request->validate([
            'fk_professor_users_id' => 'required|integer|exists:professor,fk_professor_users_id',
            'turmas' => 'required|array',
            'turmas.*' => 'integer|exists:turma,id',
        ]);
        
        $atribuicao->update([
            'fk_professor_users_id' => $request->input('fk_professor_users_id'),
        ]);
    
        $atribuicao->turmas()->sync($request->input('turmas'));
    
        return redirect()->route('atribuicaoprofessor.index')->with('success', 'Atribuição atualizada com sucesso');
    }
        
    public function deletar($id)
    {
        $atribuicao = Atribuicao::findOrFail($id);
        $atribuicao->update(['deletado' => true]);

        return redirect()->route('atribuicaoprofessor.index')->with('success', 'Atribuição deletada com sucesso');
    }

}
