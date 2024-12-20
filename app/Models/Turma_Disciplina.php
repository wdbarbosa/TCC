<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma_Disciplina extends Model
{
    use HasFactory;
    protected $table = 'turma_disciplina'; 
    protected $primaryKey = 'id';
    public $timestamps = true; 

    protected $fillable = [
        'fk_turma_id',
        'fk_disciplina_id',
        'deletado'
    ];

    
    public function turma()
    {
        return $this->belongsTo(Turma::class, 'fk_turma_id');
    }

    public function disciplinas()
    {
        return $this->belongsToMany(Disciplina::class, 'turma_disciplina', 'fk_turma_id', 'fk_disciplina_id');
    }
    
}
