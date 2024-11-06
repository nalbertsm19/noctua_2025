<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Discente;


class Projeto extends Model
{
    protected $fillable=['matriz_tcc', 'tema', 'descricao', 'termo_compromisso', 'statusProjeto', 'data_termino'];

    public function discentes()
    {
        return $this->hasMany(Discente::class, 'id_projeto');
    }

  
}
