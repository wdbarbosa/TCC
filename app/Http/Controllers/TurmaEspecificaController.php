<?php

namespace App\Http\Controllers;

use App\Models\MaterialDidatico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Turma;
use App\Models\Atribuicao;
use App\Models\Disciplina;

class TurmaEspecificaController extends Controller
{
    public function show($id)
    {
        $user = Auth::user();
    
        if ($user->nivel_acesso === 'professor') {
            // Busca a turma pelo ID
            $turma = Turma::findOrFail($id); // Agora turma é singular
    
            // Pega o ID do professor autenticado
            $userId = Auth::id();
    
            // Recupera os IDs das disciplinas atribuídas ao professor
            $disciplinasIds = Atribuicao::where('fk_professor_users_id', $userId)
                                        ->where('deletado', false)
                                        ->pluck('fk_disciplina_id');
    
            // Recupera as disciplinas correspondentes aos IDs
            $disciplinas = Disciplina::whereIn('id', $disciplinasIds)->get();
    
            // Passa tanto a turma quanto as disciplinas para a view
            return view('turmaEspecifica', compact('turma', 'disciplinas')); // Note que usamos 'turma'
        }
    }
    


}
