<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespostaDuvida extends Model
{
    use HasFactory;

    protected $table = 'respostaforum';
    protected $fillable = [
        'id',
        'resposta',
        'id_user',
        'id_duvida',
        'data_resposta'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function duvida() 
    {
        return $this->belongsTo(User::class, 'id_duvida');
    }
}


