<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $table = 'professor';
    protected $primaryKey = 'fk_pessoa_id_pessoa';

    public function atribuicoes()
    {
        return $this->hasMany(Atribuicao::class, 'fk_professor_fk_pessoa_id_pessoa');
    }

    public function disciplinas()
    {
        return $this->hasManyThrough(Disciplina::class, Atribuicao::class, 'fk_professor_fk_pessoa_id_pessoa', 'id_disciplina', 'fk_pessoa_id_pessoa', 'fk_disciplina_id_disciplina');
    }
}
