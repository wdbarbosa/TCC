<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TurmaController extends Controller
{
    /**
     * Show the form for editing a Turma.
     */
    public function edit(Turma $turma): View
    {
        return view('editar-turma', compact('turma'));
    }

    /**
     * Update the specified Turma in storage.
     */
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
