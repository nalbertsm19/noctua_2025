<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Docente;

class Projeto extends Model
{
    use HasFactory;

    protected $fillable = [
        'matriz_tcc',           // Documento ou matriz curricular associada ao TCC
        'termo_compromisso',    // Documento de termo de compromisso
        'tema',                 // Tema do projeto
        'descricao',            // Descrição detalhada do projeto
        'statusProjeto',        // Status do projeto (ativo, pendente, concluído, etc.)
        'data_termino'          // Data de término planejada ou real
    ];

    /**
     * Relacionamento com Docentes através da tabela pivot 'projeto_docente'.
     * - 'id_projeto': chave estrangeira no pivot referenciando o ID de projetos.
     * - 'id_docente': chave estrangeira no pivot referenciando o ID de docentes.
     */
    public function docentes()
    {
        return $this->belongsToMany(Docente::class, 'projeto_docente', 'id_projeto', 'id_docente');
    }

    public function discentes()
    {
        return $this->hasMany(Discente::class, 'id_projeto');
    }
    
    public function scopeAtivos($query)
    {
        return $query->where('statusProjeto', 1); // Supondo que '1' represente ativo
    }
}
