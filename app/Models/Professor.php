<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $table = 'professor';

    protected $primaryKey = 'fk_professor_users_id';

    public $timestamps = true; 

    protected $fillable = [
        'fk_professor_users_id'
    ];

    // Relação com a tabela Users
    public function user()
    {
        return $this->belongsTo(User::class, 'fk_professor_users_id', 'id');
    }

    // Relação com a tabela Atribuicao
    public function atribuicoes()
    {
        return $this->hasMany(Atribuicao::class, 'fk_professor_fk_users_id', 'fk_professor_users_id');
    }
}
