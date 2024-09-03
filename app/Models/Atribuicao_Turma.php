<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atribuicao_Turma extends Model
{
    protected $table = 'atribuicao_turma';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'fk_atribuicao_id',
        'fk_turma_id',
    ];

    public function atribuicao()
    {
        return $this->belongsTo(Atribuicao::class, 'fk_atribuicao_id');
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'fk_turma_id');
    }

}
