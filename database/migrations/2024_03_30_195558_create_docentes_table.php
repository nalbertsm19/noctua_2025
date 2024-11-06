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
        Schema::create('docentes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->string('foto_perfil')->nullable(); 
            $table->string('email', 100);
            $table->text('formacao');
            $table->integer('disponibilidade');
            $table->integer('suap');
            $table->string('descricao');
            $table->string('curriculo_lates', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docentes');
    }
};
