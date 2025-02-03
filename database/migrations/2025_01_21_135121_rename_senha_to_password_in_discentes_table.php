<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('discentes', function (Blueprint $table) {
            $table->string('password')->nullable(); // Adiciona a nova coluna
        });

        DB::statement('UPDATE discentes SET password = senha'); // Copia os dados

        Schema::table('discentes', function (Blueprint $table) {
            $table->dropColumn('senha'); // Remove a coluna antiga
        });
    }

    public function down(): void
    {
        Schema::table('discentes', function (Blueprint $table) {
            $table->string('senha')->nullable(); // Recria a coluna antiga
        });

        DB::statement('UPDATE discentes SET senha = password'); // Restaura os dados

        Schema::table('discentes', function (Blueprint $table) {
            $table->dropColumn('password'); // Remove a coluna nova
        });
    }
};
