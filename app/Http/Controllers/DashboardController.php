<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma;
use Illuminate\Support\Facades\Auth;
use App\Models\Atribuicao;
use App\Models\Atribuicao_Turma;

class DashboardController extends Controller
{
    public function index(){

        $user = Auth::user();

        if ($user->nivel_acesso === 'professor') {
            $professorId = Auth::user()->id;

        $atribuicaoIds = Atribuicao::where('fk_professor_users_id', $professorId)
                            ->where('deletado', false)
                            ->pluck('id');
                        
        $turmaIds = Atribuicao_Turma::whereIn('fk_atribuicao_id', $atribuicaoIds)->pluck('fk_turma_id');

        $turmas = Turma::whereIn('id', $turmaIds)->get();
        
        return view('dashboard', compact('turmas'));

        }elseif ($user->nivel_acesso === 'aluno') {
            
            return redirect()->route('disciplinas');
        }elseif ($user->nivel_acesso === 'admin') {
            return view('dashboard');
        }
    
        // Redireciona para uma página padrão ou de erro se o nível de acesso não for reconhecido
        return redirect()->route('home')->with('error', 'Acesso não autorizado.');

    }
}
