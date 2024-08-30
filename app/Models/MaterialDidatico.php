<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialDidatico extends Model
{
    use HasFactory;

    protected $table = 'material_didatico';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'conteudo',
        'playlist',
        'fk_disciplina_id'
    ];

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class, 'fk_disciplina_id');
    }
}
