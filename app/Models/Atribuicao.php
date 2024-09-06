<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Disciplina;
use App\Models\Professor;
use App\Models\Turma;

class Atribuicao extends Model
{
    protected $table = 'atribuicao';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = 
    [
        'dataatribuicao', 'deletado', 'fk_professor_users_id', 'fk_disciplina_id', 'fk_turma_id'
    ];

    public function professor()
    {
        return $this->belongsTo(Professor::class, 'fk_professor_users_id');
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'fk_disciplina_id');
    }

    public function atribuicaoTurmas()
    {
        return $this->hasMany(Atribuicao_Turma::class, 'fk_atribuicao_id');
    }


}
