<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $table = 'aluno';
    protected $primaryKey = 'fk_aluno_users_id';
    public $incrementing = false;

    protected $fillable = [
        'matricula', 
        'fk_aluno_users_id', 
        'fk_turma_id'
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'fk_turma_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_aluno_users_id');
    }
}
