<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Projeto;


class Discente extends Model
{

    protected $fillable=['imagem','nome','email','cpf','id_projeto', 'password','turma','user_id'];

    public function projeto()
    {
        return $this->belongsTo(Projeto::class, 'id_projeto');
    }

}