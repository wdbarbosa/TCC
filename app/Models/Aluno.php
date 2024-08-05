<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $table = 'aluno';
    protected $primaryKey = 'fk_pessoa_id_pessoa';
    public $incrementing = false;

    protected $fillable = [
        'matricula', 
        'fk_pessoa_id_pessoa', 
        'fk_turma_id_turma'
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'fk_turma_id_turma');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_pessoa_id_pessoa');
    }
}
