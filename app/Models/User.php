<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Http; // Importando a fachada Http
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * Os atributos que podem ser preenchidos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'foto_perfil',
    ];

    /**
     * Os atributos que devem ser ocultados para arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Os atributos que devem ser convertidos em tipos nativos.
     *
     * @var array
     */
    public function docente()
    {
        return $this->hasOne(Docente::class);
    }

    public function discente()
    {
        return $this->hasOne(Discente::class);
    }
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function ad(string $user, string $senha)
{
    $url = 'http://server.nudevcb.ifms.edu.br/api/login';
    $campos = [
        'usuario' => $user,
        'senha' => $senha
    ];

    // Envia os dados com o cabeçalho de autorização
    $response = Http::asForm()->withHeaders([
        'Authorization' => 'Bearer cfV5PNtFcDYMkXcDTihKg4Q3oqZkzTXTCc5EI1fN', 
        'Accept' => 'application/json',
    ])->post($url, $campos);

    // Verifica se a resposta foi bem-sucedida
    if ($response->successful()) {
        return $response->json(); // Retorna a resposta em formato JSON
    }

    // Em caso de erro
    return back()->withErrors(['identificador' => 'Erro ao tentar autenticar.']);
}


}
