<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DisciplinaController extends Controller
{
    /**
     * Show the form for editing a Turma.
     */
    public function edit(Disciplina $disciplina): View
    {
        return view('editar-disciplina', compact('disciplina'));
    }

    /**
     * Update the specified Turma in storage.
     */
    public function update(Request $request, Disciplina $disciplina): RedirectResponse
    {
        $request->validate([
            'nome_disciplina' => 'required|string|max:255',
            'disciplina_descricao' => 'required|string|max:255',
        ]);

        $disciplina->update($request->all());

        return redirect()->back()->with('status', 'Turma updated!');
    }

    /**
     * Remove the specified Turma from storage.
     */
    public function destroy(Disciplina $disciplina): RedirectResponse
    {
        $disciplina->delete();

        return redirect()->route('dashboard')->with('status', 'Disciplina deleted!');
    }
}
