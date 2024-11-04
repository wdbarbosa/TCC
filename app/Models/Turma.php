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
        return $this->belongsToMany(Atribuicao::class, 'atribuicao', 'fk_turma_id', 'fk_atribuicao_id');
    }

    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class, 'turma_disciplina', 'fk_turma_id', 'fk_disciplina_id')
        ->where('turma_disciplina.deletado', false)
        ->with('professores');
    }

    public function atribuicaoTurmas()
    {
        return $this->hasMany(Atribuicao_Turma::class, 'fk_turma_id');
    }

    public function turmaDisciplina()
    {
        return $this->hasMany(Turma_Disciplina::class, 'fk_turma_id');
    }

}
