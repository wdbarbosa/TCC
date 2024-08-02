<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunicado extends Model
{
    use HasFactory;

    protected $table = 'comunicados';
    protected $fillable = [
        'id',
        'nomecomunicado',
        'comunicado',
        'datacomunicado',
        'id_turma',
        'id_professor'
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class, 'id_turma');
    }

    public function user() // Adicione essa relação
    {
        return $this->belongsTo(User::class, 'id_professor');
    }
}


