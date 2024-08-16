<?php

namespace App\Http\Controllers;

use App\Models\RespostaDuvida;
use App\Models\User;
use App\Models\Duvida;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RespostaDuvidaController extends Controller
{
    public function index(): View
    {
        $respostas = RespostaDuvida::with('user')->get();

        return view('forumdeduvidas.index', compact('respostas'));
    }

    public function show()
        {
            $duvidas = Duvida::all();
            $id_user = auth()->user()->id; // ID do aluno autenticado
            $dataresposta = now(); // Data e hora atuais

            return view('sua_view', compact('duvidas', 'id_user', 'dataresposta'));
        }

    public function responderForum(Request $request, $id_duvida) {
        $validated = $request->validate([
            'resposta' => 'required|string',
            'id_user' => 'required|integer',
            'id_duvida' => 'required|integer'
        ]);
    
        $id_user = $validated['id_user'];
        $id_duvida = $validated['id_duvida'];
        $resposta = $validated['resposta'];
        $dataResposta = now(); // Data e hora atuais do servidor
    
        // Processa a resposta aqui
        // Exemplo: Salvar a resposta no banco de dados
    
        return redirect()->back()->with('success', 'Resposta enviada com sucesso!');
    }
    
}

