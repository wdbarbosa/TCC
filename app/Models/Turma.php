<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $table = 'turma';

    protected $fillable = [
        'nome',
        'descricao',
    ];

    public function alunos()
    {
        return $this->hasMany(Aluno::class, 'fk_turma_id_turma');
    }
}
