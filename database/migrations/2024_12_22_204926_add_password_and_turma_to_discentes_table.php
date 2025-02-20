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
        Schema::table('discentes', function (Blueprint $table) {
       
            $table->string('turma', 50)->nullable(); // Adiciona o campo 'turma' após 'senha'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discentes', function (Blueprint $table) {
            $table->dropColumn(['turma']); // Remove os campos 'senha' e 'turma'
        });
    }
};
