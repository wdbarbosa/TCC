<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformacaoSite;
use Illuminate\Support\Facades\Auth;

class InformacaoSiteController extends Controller
{
    public function index()
    {
        $registro = InformacaoSite::all();
        
        return view('welcome', compact('registro'));
    }

    public function atualizar(Request $req)
    {
        if (!Auth::check() || Auth::user()->nivel_acesso != 1)
        {
            return redirect()->route('informacao');
        }
        $dados = $req->all();
        if($req->hasFile('imagem'))
        {
            $imagem = $req->file('imagem');
            $num = rand(1111,9999);
            $dir = "img/site/";
            $ex = $imagem->guessClientExtension();
            $nomeImagem = "imagem_".$num.".".$ex;
            $imagem->move($dir, $nomeImagem);
            $dados['imagem'] = $dir."/".$nomeImagem;
        }
        InformacaoSite::update($dados);
        return redirect()->route('informacao');

    }
}
