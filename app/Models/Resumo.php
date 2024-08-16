<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resumo extends Model
{
    use HasFactory;

    protected $table = 'resumo';
    protected $primaryKey = 'id';
    protected $fillable = ['titulo', 'conteudo', 'arquivo', 'deletado', 'datapublicado', 'dataeditado', 'fk_aluno_users_id', 'fk_disciplina_id'];
    public $incrementing = true;
    protected $keyType = 'int';
    
    public function user()
    {
        return $this->belongsTo(User::class, 'fk_aluno_fk_users_id');
    }
    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'fk_disciplina_id');
    }    
}
