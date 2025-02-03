<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToDiscentesTable extends Migration
{
    public function up()
    {
        Schema::table('discentes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->unique()->after('id'); // Relacionamento com a tabela users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('discentes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
