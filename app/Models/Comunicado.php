<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunicado extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_comunicado',
        'nomecomunicado',
        'comunicado',
        'data_comunicado',
    ];
}
