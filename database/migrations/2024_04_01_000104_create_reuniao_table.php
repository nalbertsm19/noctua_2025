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
        Schema::create('reuniao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_projeto');
            $table->unsignedBigInteger('id_docente');
            $table->dateTime('dataHora');
            $table->string('resumo',100);
            $table->integer('status_reuniao');
            $table->foreign('id_projeto')->references('id')->on('projetos');
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
        Schema::dropIfExists('reuniao');
    }
};
