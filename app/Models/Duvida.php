<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duvida extends Model
{
    use HasFactory;

    protected $table = 'forum';
    protected $fillable = [
        'id',
        'dataforum',
        'deletado',
        'mensagem',
        'id_aluno',
        'descricao_disciplina'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class, 'id_aluno');
    }
}


