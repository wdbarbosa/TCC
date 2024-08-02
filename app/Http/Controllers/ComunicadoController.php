<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;
use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ComunicadoController extends Controller
{
    public function index(): View
    {
        $comunicados = Comunicado::with('turma')->get();

        return view('comunicados.index', compact('comunicados'));
    }
}

