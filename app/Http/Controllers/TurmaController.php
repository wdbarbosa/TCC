<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TurmaController extends Controller
{

    public function turmaespecifica($id)
    {
        $turma = Turma::findOrFail($id);

        return view('turmaEspecifica', ['turmas' => $turma]);
    }

    public function edit(Turma $turma): View
    {
        return view('editar-turma', compact('turma'));
    }

    public function update(Request $request, Turma $turma): RedirectResponse
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
        ]);

        $turma->update($request->all());

        return redirect()->back()->with('status', 'Turma updated!');
    }

    public function destroy(Turma $turma): RedirectResponse
    {
        $turma->delete();

        return redirect()->route('dashboard')->with('status', 'Turma deleted!');
    }
}
