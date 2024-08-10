<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atribuicao extends Model
{
    use HasFactory;

    protected $table = 'atribuicao';
    protected $primaryKey = 'id';

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

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'fk_turma_id');
    }
}
