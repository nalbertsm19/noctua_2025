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
        Schema::create('projeto_docente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_projeto');
            $table->foreign('id_projeto')->references('id')->on('projetos');
            $table->unsignedBigInteger('id_docente');
            $table->foreign('id_docente')->references('id')->on('docentes');
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
        Schema::dropIfExists('projeto_docente');
    }
};
