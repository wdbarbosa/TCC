<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

   // Relação com a tabela Turma
    public function turma()
    {
        return $this->belongsTo(Turma::class, 'fk_turma_id');
    }
}
