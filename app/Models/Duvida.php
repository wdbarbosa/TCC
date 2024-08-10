<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duvida extends Model
{
    use HasFactory;

    protected $table = 'forum';
    protected $fillable = [
        'id',
        'dataforum',
        'nome',
        'mensagem',
        'id_aluno',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class, 'id_aluno');
    }
}


