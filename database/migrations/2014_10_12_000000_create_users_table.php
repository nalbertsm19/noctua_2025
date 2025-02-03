<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Cria o campo de id como chave primária
            $table->string('name'); // Nome do usuário
            $table->string('email')->unique(); // Email único do usuário
            $table->timestamp('email_verified_at')->nullable(); // Data de verificação do email
            $table->string('password'); // Senha do usuário
            $table->rememberToken(); // Campo para "remember me" (lembrar o login)
            $table->timestamps(); // Campos de criação e atualização (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users'); // Remove a tabela users
    }
};
