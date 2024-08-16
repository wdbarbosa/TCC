<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespostaDuvida extends Model
{
    use HasFactory;

    // Nome da tabela associada ao modelo
    protected $table = 'respostas';

    // Atributos que são mass assignable
    protected $fillable = [
        'id',
        'id_duvida',
        'id_user',
        'resposta',
        'data_resposta',
    ];

    // Os atributos que devem ser ocultados para arrays
    protected $hidden = [];

    // Os atributos que devem ser mutados para tipos nativos
    protected $casts = [
        'data_resposta' => 'datetime', // Converte 'data_resposta' para uma instância de Carbon
    ];

    // Definir a relação com o modelo Duvida
    public function duvida()
    {
        return $this->belongsTo(Duvida::class, 'id_duvida');
    }

    // Definir a relação com o modelo Aluno
    public function aluno()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}


