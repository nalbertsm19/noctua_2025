<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Projeto;
use App\Models\Docente;

class Reuniao extends Model
{
    use HasFactory;

    protected $table = 'reuniao'; 
    protected $fillable = ['id_projeto', 'id_docente', 'dataHora', 'resumo', 'status_reuniao'];

    public function projeto()
    {
        return $this->belongsTo(Projeto::class, 'id_projeto'); // Nome da FK correto
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class, 'id_docente'); // Nome da FK correto
    }
}




