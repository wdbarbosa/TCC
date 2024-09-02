<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){

        $user = Auth::user();

        if ($user->nivel_acesso === 'professor') {
            $turmas = Turma::all();
            return view('dashboard', ['turmas' => $turmas]);
        }elseif ($user->nivel_acesso === 'aluno') {
            
            return redirect()->route('disciplinas');
        }elseif ($user->nivel_acesso === 'admin') {
            return view('dashboard');
        }
    
        // Redireciona para uma página padrão ou de erro se o nível de acesso não for reconhecido
        return redirect()->route('home')->with('error', 'Acesso não autorizado.');

    }
}
