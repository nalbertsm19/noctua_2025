<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AreaInteresse;
use App\Models\Projeto;
use App\Models\Reuniao;

class Docente extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto_pefil', 
        'nome', 
        'email', 
        'formacao', 
        'disponibilidade', 
        'suap', 
        'descricao', 
        'curriculo_lates',
        'password',
        'user_id'
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

    public function areaInteresses()
    {
        return $this->belongsToMany(AreaInteresse::class, 'area_interesse_docente', 'docente_id', 'area_interesse_id');
    }

    public function projetos()
    {
        return $this->belongsToMany(Projeto::class, 'ProjetoDocente', 'id_docente', 'id_projeto');
    }
    

    public function reunioes()
    {
        return $this->belongsToMany(Reuniao::class, 'ReuniaoDocente', 'docente_id', 'reuniao_id')
                    ->withPivot('dataHora', 'resumo', 'status_reuniao');
    }
}
