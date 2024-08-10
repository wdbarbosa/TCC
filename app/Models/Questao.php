<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questao extends Model
{
    protected $table = 'questao';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'banca',
        'enunciado',
        'assunto',
        'image_path',
        'alternativa_a',
        'alternativa_b',
        'alternativa_c',
        'alternativa_d',
        'alternativa_e',
        'deletado',
        'alternativacorreta',
        'fk_disciplina_id'
    ];

    // Relação com a tabela Disciplina
    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'fk_disciplina_id');
    }
}
