<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Discente;
use App\Models\Docente;

class Reuniao extends Model
{
    protected $table='reuniaos';
    protected $fillable=['dataHora', 'resumo', 'status_reuniao'];

    public function Docentes()
    {
        return $this->belongsToMany(Docente::class)->withPivot('dataHora', 'resumo', 'status_reuniao');

    }
}
