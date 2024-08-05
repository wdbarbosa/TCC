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
        return $this->hasMany(Resumo::class, 'fk_disciplina_id_disciplina');
    }

    public function questao()
    {
        return $this->hasMany(Questao::class, 'fk_disciplina_id_disciplina');
    }

}
