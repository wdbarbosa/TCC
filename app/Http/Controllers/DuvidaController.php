<?php

namespace App\Http\Controllers;

use App\Models\Duvida;
use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DuvidaController extends Controller
{
    public function index(): View
    {
        // Eager load the turma relation to avoid N+1 problem
        $duvidas = Duvida::with('aluno')->get();

        return view('forumdeduvidas.index', compact('duvidas'));
    }
}

