<?php

namespace App\Http\Controllers;

use App\Models\RespostaDuvida;
use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RespostaDuvidaController extends Controller
{
    public function index(): View
    {
        $respostas = RespostaDuvida::with('aluno')->get();

        return view('forumdeduvidas.index', compact('respostas'));
    }
}

