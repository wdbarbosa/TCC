<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resumo;
use App\Models\Disciplina;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ResumoController extends Controller
{
    public function index(Request $req)
    {
        $idUser = Auth::id();
        $resumos = Resumo::where('fk_aluno_fk_pessoa_id_pessoa', $idUser)
                            ->where('deletado', false)
                            ->get();
        $disciplinas = Disciplina::all();
        if($req->has('id_busca') && $req->id_busca != '')
        {
            $resumos = Resumo::where('fk_aluno_fk_pessoa_id_pessoa', $idUser)
                            ->where('deletado', false)
                            ->where('fk_disciplina_id_disciplina', $req->id_busca)
                            ->get();
        }
        return view('resumos', compact('resumos', 'disciplinas'));
    }
    public function abrir($id_resumo)
    {
        try 
        {
            $resumo = Resumo::findOrFail($id_resumo);
            if ($resumo->fk_aluno_fk_pessoa_id_pessoa != Auth::id()) 
            {
                abort(403); //verificacao do usuario 
            }
            return view('resumosAbrir', compact('resumo'));
        } 
        catch (ModelNotFoundException $e) {
            abort(404); //quando o resumo nao for encontrado
        }
    }
    public function editar($id_resumo)
    {
        try
        {
            $disciplinas = Disciplina::all();
            $resumo = Resumo::findOrFail($id_resumo);
            if ($resumo->fk_aluno_fk_pessoa_id_pessoa != Auth::id()) 
            {
                abort(403);
            }
            return view('resumoEditar', compact('resumo', 'disciplinas'));
        } 
        catch (ModelNotFoundException $e) 
        {
            abort(404);
        }
    }
    public function deletar($id_resumo)
    {
        try
        {
            $resumo = Resumo::findOrFail($id_resumo);
            if ($resumo->fk_aluno_fk_pessoa_id_pessoa != Auth::id())
            {
                abort(403);
            }
            $resumo->deletado = true;
            $resumo->save();
            return redirect()->route('resumo.index');
        }
        catch (ModelNotFoundException $e)
        {
            abort(404);
        }
    }
    public function adicionar()
    {
        $disciplinas = Disciplina::all();
        return view('resumosAdicionar', compact('disciplinas'));
    }
    public function salvar(Request $req)
    {
        $req->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'arquivo' => ['required', 'file', 'mimes:pdf'],
            'fk_disciplina_id_disciplina' => ['required', 'exists:disciplinas,id_disciplina'],
        ]);
        $dados = $req->all();
        $dados['datapublicado'] = now();
        $dados['deletado'] = false;
        $dados['fk_aluno_fk_pessoa_id_pessoa'] = Auth::id();
        if($req->hasFile('arquivo'))
        {
            $caminho = $req->file('arquivo')->store('resumos', 'public');
            $dados['arquivo'] = $caminho;
        }
        Resumo::create($dados);
        return redirect()->route('resumo.index');
    }
    public function atualizar(Request $req, $id_resumo)
    {
        $req->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'arquivo' => ['nullable', 'file', 'mimes:pdf'],
            'fk_disciplina_id_disciplina' => ['required', 'exists:disciplinas,id_disciplina'],
        ]);
        try
        {
            $resumo = Resumo::findOrFail($id_resumo);
            if ($resumo->fk_aluno_fk_pessoa_id_pessoa != Auth::id())
            {
                abort(403);
            }
            $dados = $req->all();
            $dados['dataeditado'] = now();
            if($req->hasFile('arquivo'))
            {
                $caminho = $req->file('arquivo')->store('resumos', 'public');
                $dados['arquivo'] = $caminho; //altera o arquivo caso tenha um novo
            }
            else
            {
                $dados['arquivo'] = $resumo->arquivo; //mantem o antigo
            }
            $resumo->update($dados);
            return redirect()->route('resumo.index');
        }
        catch (ModelNotFoundException $e)
        {
            abort(404);
        }
    }
}
