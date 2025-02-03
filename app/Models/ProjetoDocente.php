<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjetoDocente extends Model
{
    use HasFactory;

    // Se a tabela não seguir a convenção, você define o nome da tabela manualmente
    protected $table = 'projeto_docente';  // Nome correto da tabela no banco de dados

    protected $fillable = ['id_projeto', 'id_docente'];

    public function docente()
    {
        return $this->belongsTo(Docente::class, 'id_docente');
    }

    public function projeto()
    {
        return $this->belongsTo(Projeto::class, 'id_projeto');
    }
}

