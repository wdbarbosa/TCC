<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atribuicao extends Model
{
    use HasFactory;

    protected $table = 'atribuicao';
    protected $primaryKey = 'id_atribuicao';

    public function professor()
    {
        return $this->belongsTo(Professor::class, 'fk_professor_fk_pessoa_id_pessoa');
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'fk_disciplina_id_disciplina');
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'fk_turma_id_turma');
    }
}
