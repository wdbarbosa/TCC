<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $table = 'professor';

    protected $primaryKey = 'fk_professor_users_id';

    public $timestamps = true; 

    protected $fillable = [
        'fk_professor_users_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_professor_users_id', 'id');
    }

    public function atribuicoes()
    {
        return $this->hasMany(Atribuicao::class, 'fk_professor_users_id', 'fk_professor_users_id');
    }

    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class, 'professor_disciplina', 'fk_professor_users_id', 'fk_disciplina_id');
    }

    public function turmas()
    {
        return $this->belongsToMany(Turma::class, 'turma_disciplina', 'fk_professor_users_id', 'fk_turma_id'); // Caso tenha um relacionamento assim
    }

    public function professorDisciplina()
    {
        return $this->hasMany(Professor_Disciplina::class, 'fk_professor_users_id', 'id');
    }

}
