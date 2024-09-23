<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma_Disciplina extends Model
{
    use HasFactory;
    protected $table = 'turma_disciplinas'; 
    protected $primaryKey = 'id';
    public $timestamps = false; 

    protected $fillable = [
        'fk_turma_id',
        'fk_disciplina_id',
    ];

    
    public function turma()
    {
        return $this->belongsTo(Turma::class, 'fk_turma_id');
    }

    // Relação com Disciplina
    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'fk_disciplina_id');
    }
}
