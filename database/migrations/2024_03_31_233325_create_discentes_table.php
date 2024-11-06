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
        Schema::create('discentes', function (Blueprint $table) {
            $table->id(); 
            $table->string('imagem')->nullable(); 
            $table->string('nome', 45); 
            $table->string('email', 45); 
            $table->integer('cpf'); 
            $table->unsignedBigInteger('id_projeto')->nullable(); 
            $table->foreign('id_projeto')->references('id')->on('projetos');
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
        Schema::dropIfExists('discentes'); 
    }
};
