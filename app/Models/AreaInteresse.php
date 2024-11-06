<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Docente;

class AreaInteresse extends Model
{
    use HasFactory;

    protected $fillable=['nome'];
    protected $table = 'area_interesse';


    public function Docentes()
    {
         return $this->belongsToMany(Docente::class);
    }
}
