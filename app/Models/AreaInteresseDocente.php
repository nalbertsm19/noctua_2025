<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AreaInteresseDocente extends Model
{
    use HasFactory;

    protected $table = 'area_interesse_orientador';

    protected $fillable = ['orientador_id', 'area_interesse_id'];

    
    public function Docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function areaInteresse()
    {
        return $this->belongsTo(AreaInteresse::class);
    }
}
