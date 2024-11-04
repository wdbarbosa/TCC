<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma;
use Illuminate\Support\Facades\Auth;
use App\Models\Atribuicao;


class DashboardController extends Controller
{
    public function index(){

        $user = Auth::user();

        if ($user->nivel_acesso === 'professor') {
            $professorId = Auth::user()->id;

            $turmas = Turma::whereIn('id', function ($query) use ($professorId) {
                $query->select('fk_turma_id')
                      ->from('atribuicao')
                      ->where('fk_professor_users_id', $professorId)
                      ->where('deletado', false); 
            })->get();
    
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
