<?php

namespace App\Http\Controllers;

use App\Models\Duvida;
use App\Models\User;
use App\Models\RespostaDuvida;
use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DuvidaController extends Controller
{
    // Exibe o fórum de dúvidas
    public function index()
    {
        $users = User::where('nivel_acesso', 'aluno')->get();
        $duvidas = Duvida::all();
        $respostas = RespostaDuvida::with('duvida')
            ->whereIn('id_duvida', $duvidas->pluck('id'))
            ->get()
            ->groupBy('id_duvida');

        return view('forumdeduvidas', compact('users', 'duvidas', 'respostas'));
    }

    // Mostra o formulário para adicionar uma nova dúvida
    public function create()
    {
        $turmas = Turma::all();
        $users = User::all();
        return view('adicionarDuvida', compact('turmas', 'users'));
    }

    // Armazena uma nova dúvida
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'mensagem' => 'required|string|max:800',
            'dataforum' => 'required|date',
        ]);

        Duvida::create([
            'nome' => $validated['nome'],
            'mensagem' => $validated['mensagem'],
            'dataforum' => $validated['dataforum'],
            'id_aluno' => Auth::id(),
        ]);

        return redirect()->route('forumdeduvidas');
    }

    // Mostra o formulário para editar uma dúvida existente
    public function edit($id)
    {
        $duvida = Duvida::findOrFail($id);
        return view('atualizarDuvida', compact('duvida'));
    }

    // Atualiza uma dúvida existente
    public function update(Request $request, $id)
    {
        $duvida = Duvida::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'mensagem' => 'required|string|max:800',
            'dataforum' => 'date',
        ]);

        $duvida->update($validated);

        return redirect()->route('forumdeduvidas');
    }

    // Exclui uma dúvida
    public function destroy($id)
    {
        $duvida = Duvida::findOrFail($id);
        $duvida->delete();

        return redirect()->route('forumdeduvidas');
    }
}
