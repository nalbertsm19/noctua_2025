<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjetoDocente extends Model
{
    use HasFactory;

    protected $fillable= ['id_projeto', 'id_docente'];

    public function Docente(){
        return $this->belongsTo(Docente::class);
    }
}
