<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    use HasFactory;

    protected $table = 'disciplina';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nome_disciplina',
        'disciplina_descricao',
    ];

    public function resumos()
    {
        return $this->hasMany(Resumo::class, 'fk_disciplina_id');
    }

    public function questao()
    {
        return $this->hasMany(Questao::class, 'fk_disciplina_id');
    }

    public function professores()
    {
        return $this->belongsToMany(Professor::class, 'professor_disciplina', 'fk_disciplina_id', 'fk_professor_users_id');
    }

    public function turmas()
    {
        return $this->belongsToMany(Turma::class, 'turma_disciplina', 'fk_disciplina_id', 'fk_turma_id')
            ->where('turma_disciplina.deletado', false);
    }
    public function turmasSemProfessor()
    {
        return $this->turmas()->whereDoesntHave('atribuicoes', function ($query) {
            $query->where('deletado', false);
        });
    }
    public function atribuicoes()
    {
        return $this->hasMany(Atribuicao::class, 'fk_disciplina_id');
    }


}
