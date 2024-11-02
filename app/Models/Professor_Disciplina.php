<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor_Disciplina extends Model
{
    use HasFactory;
    protected $table = 'professor_disciplina';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = 
    [
        'fk_professor_users_id', 'fk_disciplina_id', 'deletado'
    ];

    public function professor()
    {
        return $this->belongsTo(Professor::class, 'fk_professor_users_id');
    }
    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'fk_disciplina_id');
    }
}