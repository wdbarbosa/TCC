<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class InformacaoSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'imagem', 'inicio_inscricao', 'fim_inscricao', 'info_geral', 'endereco', 'horario'
    ];

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

    public function getInicioInscricaoAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getFimInscricaoAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
}

