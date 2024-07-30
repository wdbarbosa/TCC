<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questao extends Model
{
    use HasFactory;

    protected $table = 'questao';
    protected $primaryKey = 'id_questao';
    protected $fillable = ['banca', 'alternativa_a', 'alternativa_b', 'alternativa_c', 'alternativa_d', 'alternativa_e', 'deletado', 'alternativacorreta', 'fk_disciplina_id_disciplina'];

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'fk_disciplina_id_disciplina');
    }
}
