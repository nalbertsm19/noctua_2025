<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AreaInteresse;
use App\Models\Projeto;
Use App\Models\Reuniao;

class Docente extends Model
{
    protected $fillable=['foto_pefil', 'nome','email','formacao','disponibilidade','suap','descricao','curriculo_lates'];

   public function AreaInteresse()
   {
      return $this->belongsToMany(AreaInteresse::class);
   }
 
   public function Projetos()
   {
      return $this->belongsToMany(Projeto::class);
   
   }

   public function Reunioes()
   {
      return $this->belongsToMany(Reuniao::class, 'Reuniao')->withPivot('dataHora', 'resumo', 'status_euniao');
   }
}
