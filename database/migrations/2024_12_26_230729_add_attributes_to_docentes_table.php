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
        Schema::table('docentes', function (Blueprint $table) {
            // Adiciona a coluna 'password'
            $table->string('password')->nullable(); // ou 'required' se desejar
            $table->enum('role', ['discente', 'docente'])->default('docente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('docentes', function (Blueprint $table) {
            // Remove as colunas ao fazer rollback
            $table->dropColumn('password');
            // $table->dropColumn('role'); // caso tenha adicionado 'role'
        });
    }
};
