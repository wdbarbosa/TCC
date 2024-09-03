<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Atribuicao;
use App\Models\Atribuicao_Turma;


class TurmaController extends Controller
{

    public function index()
    {
        $professorId = Auth::user()->id;

        // Busca as turmas que estão relacionadas ao professor logado
        $turmas = Turma::whereHas('atribuicoes', function ($query) use ($professorId) {
            $query->where('fk_professor_users_id', $professorId);
        })->get();

        $turmas = Turma::all();
        return view('turmas', ['turmas' => $turmas]);
    
        // Retorna a view com as turmas filtradas
        return view('turmas', compact('turmas'));
    }


    public function show($id)
    {
        $turma = Turma::findOrFail($id);
        return view('turmaEspecifica', compact('turma'));
    }

    public function create()
    {
        return view('adicionarTurma');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        Turma::create($validated);

        return redirect()->route('turma.index');
    }

    public function edit($id)
    {
        $turma = Turma::findOrFail($id);
        return view('atualizarTurma', compact('turma'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $turma = Turma::findOrFail($id);
        $turma->update($validated);

        return redirect()->route('turma.index');
    }

    public function destroy($id)
    {
        $turma = Turma::findOrFail($id);
        $turma->delete();

        return redirect()->route('turma.index');
    }
}
