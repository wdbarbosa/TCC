<?php

namespace App\Http\Controllers;

use App\Models\RespostaDuvida;
use App\Models\Duvida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RespostaDuvidaController extends Controller
{
    // Exibir as respostas no fórum
    public function index()
    {
        $respostas = RespostaDuvida::with('duvida', 'aluno')->get();
        return view('forumdeduvidas.index', compact('respostas'));
    }

    // Responder uma dúvida
    public function responderForum(Request $request, $id_duvida)
    {
        $request->validate([
            'resposta' => 'required|string|max:800',
        ]);

        // Cria uma nova resposta
        $resposta = new RespostaDuvida();
        $resposta->resposta = $request->input('resposta');
        $resposta->dataresposta = now();
        $resposta->id_user = Auth::id(); // ID do usuário autenticado
        $resposta->id_duvida = $id_duvida; // ID da dúvida vinculada
        $resposta->save();

        return redirect()->back()->with('success', 'Resposta adicionada com sucesso!');
    }

    // Exibir o formulário de edição
    public function edit($id)
    {
        $resposta = RespostaDuvida::findOrFail($id);

        // Verifica se o usuário é o autor da resposta
        if (Auth::id() !== $resposta->id_user) {
            return redirect()->route('forum.de.duvidas')->with('error', 'Você não tem permissão para editar esta resposta.');
        }

        return view('atualizarResposta', compact('resposta'));
    }

    // Atualizar a resposta
    public function update(Request $request, $id)
    {
        $request->validate([
            'resposta' => 'required|string|max:800',
        ]);

        $resposta = RespostaDuvida::findOrFail($id);

        // Verifica se o usuário é o autor da resposta
        if (Auth::id() !== $resposta->id_user) {
            return redirect()->route('forum.de.duvidas')->with('error', 'Você não tem permissão para atualizar esta resposta.');
        }

        // Atualiza a resposta
        $resposta->resposta = $request->input('resposta');
        $resposta->save();

        return redirect()->route('forum.de.duvidas')->with('success', 'Resposta atualizada com sucesso!');
    }

    // Excluir uma resposta
    public function destroy($id)
    {
        $resposta = RespostaDuvida::findOrFail($id);

        // Verifica se o usuário é o autor da resposta
        if (Auth::id() !== $resposta->id_user) {
            return redirect()->route('forum.de.duvidas')->with('error', 'Você não tem permissão para excluir esta resposta.');
        }

        // Exclui a resposta
        $resposta->delete();

        return redirect()->route('forum.de.duvidas')->with('success', 'Resposta excluída com sucesso!');
    }
}