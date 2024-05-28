<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class InformacaoSite extends Model
{
    use HasFactory;
<<<<<<< HEAD
    
=======
>>>>>>> 3db15218f66229dbf51cb99d4114dc088acea901
    protected $fillable = [
        'imagem', 'inicio_inscricao', 'fim_inscricao', 'info_geral', 'endereco', 'horario'
    ];

<<<<<<< HEAD
    /**
     * Retorna todos os registros da tabela.
     *
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function all($columns = ['*'])
    {
        return parent::all($columns);
    }
=======
>>>>>>> 3db15218f66229dbf51cb99d4114dc088acea901

    public function getInicioInscricaoAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getFimInscricaoAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
}
<<<<<<< HEAD
=======
 
>>>>>>> 3db15218f66229dbf51cb99d4114dc088acea901
