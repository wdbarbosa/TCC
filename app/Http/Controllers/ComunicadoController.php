<?php

namespace App\Http\Controllers;

use App\Models\Comunicado;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComunicadoController extends Controller
{
    // Exibe a lista de comunicados
    public function index()
    {
        $users = User::where('nivel_acesso', 'professor')->get();
        $comunicados = Comunicado::all();
        return view('comunicados', compact('users', 'comunicados'));
    }

    // Mostra o formulário para adicionar um novo comunicado
    public function create()
    {
        $turmas = Turma::all();
        $users = User::all();
        return view('adicionarComunicado', compact('turmas', 'users'));
    }

    // Armazena um novo comunicado
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomecomunicado' => 'required|string|max:255',
            'comunicado' => 'required|string',
            'datacomunicado' => 'required|date',
            'id_turma' => 'required|exists:turma,id',
        ]);

        Comunicado::create([
            'nomecomunicado' => $validated['nomecomunicado'],
            'comunicado' => $validated['comunicado'],
            'datacomunicado' => $validated['datacomunicado'],
            'id_turma' => $validated['id_turma'],
            'id_professor' => Auth::id(),
        ]);

        return redirect()->route('comunicados');
    }

    // Mostra o formulário para editar um comunicado existente
    public function edit($id)
    {
        $comunicado = Comunicado::findOrFail($id);
        return view('atualizarComunicados', compact('comunicado'));
    }

    // Atualiza um comunicado existente
    public function update(Request $request, $id)
    {
        $comunicado = Comunicado::findOrFail($id);

        $validated = $request->validate([
            'nomecomunicado' => 'required|string|max:255',
            'comunicado' => 'required|string',
            'datacomunicado' => 'required|date',
        ]);

        $comunicado->update($validated);

        return redirect()->route('comunicados');
    }

    // Exclui um comunicado
    public function destroy($id)
    {
        $comunicado = Comunicado::findOrFail($id);
        $comunicado->delete();

        return redirect()->route('comunicados');
    }
}
