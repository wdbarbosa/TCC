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
            $turma = Turma::findOrFail($id); 
            $userId = Auth::id();
            $disciplinasIds = Atribuicao::where('fk_professor_users_id', $userId)
                                        ->where('deletado', false)
                                        ->pluck('fk_disciplina_id');

            $disciplinas = Disciplina::whereIn('id', $disciplinasIds)->get();

            return view('turmaEspecifica', compact('turma', 'disciplinas'));
        }
    }
    


}
