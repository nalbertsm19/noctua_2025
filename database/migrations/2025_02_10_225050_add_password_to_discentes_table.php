<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('discentes', function (Blueprint $table) {
            $table->string('password')->after('id'); // Escolha um local apropriado
        });
    }

    public function down()
    {
        Schema::table('discentes', function (Blueprint $table) {
            $table->dropColumn('password');
        });
    }
};
