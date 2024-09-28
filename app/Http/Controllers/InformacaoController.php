<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\InformacaoSite;

class InformacaoController extends Controller
{
    public function index()
    {
        // Tenta encontrar o primeiro registro
        $informacao = InformacaoSite::first();

        // Se não encontrar nenhum registro, cria um objeto vazio para evitar erros
        if (!$informacao) {
            $informacao = new InformacaoSite(); // Cria um novo objeto vazio
        }

        // Passa a variável para a view
        return view('welcome', compact('informacao'));
    }

    public function atualizar(Request $req)
    {
        // Verifica se o usuário está autenticado e tem nível de acesso 1
        if (!Auth::check() || Auth::user()->nivel_acesso != 1) {
            return redirect()->route('informacao');
        }

        // Coleta todos os dados enviados
        $dados = $req->all();

        // Tenta encontrar o primeiro registro
        $informacao = InformacaoSite::first();

        // Se o registro existir, atualiza, caso contrário, cria um novo
        if ($informacao) {
            $informacao->update($dados);
        } else {
            InformacaoSite::create($dados); // Cria um novo registro se não existir nenhum
        }

        // Redireciona para a página inicial
        return redirect()->route('welcome');
    }
}
