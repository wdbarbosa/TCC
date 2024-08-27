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
        return $this->hasMany(Aluno::class, 'fk_turma_id');
    }
    public function atribuicoes()
    {
        return $this->belongsToMany(Atribuicao::class, 'atribuicao_turma', 'fk_turma_id', 'fk_atribuicao_id');
    }
}
