<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resumo;
use App\Models\Disciplina;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Services\PdfThumbnailService;

class ResumoController extends Controller
{
    public function index(Request $req)
    {
        $idUser = Auth::id();
        $resumos = Resumo::where('fk_aluno_users_id', $idUser)
                            ->where('deletado', false)
                            ->get();
        $disciplinas = Disciplina::all();
        
        if($req->has('id_busca') && $req->id_busca != '')
        {
            $resumos = Resumo::where('fk_aluno_users_id', $idUser)
                            ->where('deletado', false)
                            ->where('fk_disciplina_id', $req->id_busca)
                            ->get();
        }
        return view('resumos', compact('resumos', 'disciplinas'));
    }
    public function abrir($id)
    {
        try 
        {
            $resumo = Resumo::findOrFail($id);
            if ($resumo->fk_aluno_users_id != Auth::id()) 
            {
                abort(403); //verificação do usuário 
            }
            //verificar se o arquivo existe no armazenamento
            $filePath = storage_path('app/public/' . $resumo->arquivo);
            if (!file_exists($filePath)) 
            {
                abort(404, 'Arquivo não encontrado');
            }
            //retornar o arquivo diretamente para download ou visualização
            return response()->file($filePath);
        } 
        catch (ModelNotFoundException $e) 
        {
            abort(404); //quando o resumo não for encontrado
        }
    }
    public function editar($id)
    {
        try
        {
            $disciplinas = Disciplina::all();
            $resumo = Resumo::findOrFail($id);
            if ($resumo->fk_aluno_users_id != Auth::id()) 
            {
                abort(403);
            }
            return view('resumosEditar', compact('resumo', 'disciplinas'));
        } 
        catch (ModelNotFoundException $e) 
        {
            abort(404);
        }
    }
    public function deletar($id)
    {
        try
        {
            $resumo = Resumo::findOrFail($id);
            if ($resumo->fk_aluno_users_id != Auth::id())
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
            'fk_disciplina_id' => ['required', 'exists:disciplina,id'],
        ]);
        $dados = $req->all();
        $dados['datapublicado'] = now();
        $dados['deletado'] = false;
        $dados['fk_aluno_users_id'] = Auth::id();
        if($req->hasFile('arquivo')) 
        {
            $arquivo = $req->file('arquivo');
            $nomeArquivo = $arquivo->getClientOriginalName();
            $caminho = $arquivo->storeAs('resumos', $nomeArquivo, 'public');
            $dados['arquivo'] = $caminho;
        }
        Resumo::create($dados);
        return redirect()->route('resumo.index');
    }
    public function atualizar(Request $req, $id)
    {
        $req->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'arquivo' => ['nullable', 'file', 'mimes:pdf'],
            'fk_disciplina_id' => ['required', 'exists:disciplina,id'],
        ]);

        try
        {
            $resumo = Resumo::findOrFail($id);
            if ($resumo->fk_aluno_users_id != Auth::id())
            {
                abort(403);
            }
            $dados = $req->all();
            $dados['dataeditado'] = now();
            if($req->hasFile('arquivo')) 
            {
                $arquivo = $req->file('arquivo');
                $nomeArquivo = $arquivo->getClientOriginalName();
                $caminho = $arquivo->storeAs('resumos', $nomeArquivo, 'public');
                $dados['arquivo'] = $caminho; // altera o arquivo caso tenha um novo
            } else 
            {
                $dados['arquivo'] = $resumo->arquivo; // mantem o antigo
            }
            $resumo->update($dados);
            return redirect()->route('resumo.index');
        }
        catch (ModelNotFoundException $e)
        {
            abort(404);
        }
    }

    public function store(Request $request, PdfThumbnailService $pdfThumbnailService)
{
    // Valida os dados
    $validated = $request->validate([
        'titulo' => 'required|string|max:255',
        'pdf' => 'required|file|mimes:pdf|max:2048',
    ]);

    // Salvar o arquivo PDF no diretório de 'storage/public/pdfs'
    $pdfPath = $request->file('pdf')->store('pdfs', 'public');

    // Gerar a miniatura e salvar no diretório 'public/storage/thumbnails'
    $thumbnailPath = 'thumbnails/' . basename($pdfPath, '.pdf') . '.jpg';
    $pdfThumbnailService->generateThumbnail(storage_path('app/public/' . $pdfPath), $thumbnailPath);

    // Salvar as informações no banco de dados
    Resumo::create([
        'titulo' => $request->titulo,
        'arquivo' => $pdfPath,
        'miniatura' => $thumbnailPath,
    ]);

    // Redirecionar para a página de listagem de resumos
    return redirect()->route('resumo.index');
}

}
