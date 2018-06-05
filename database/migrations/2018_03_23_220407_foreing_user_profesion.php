<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForeingUserProfesion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',function (Blueprint $table){
            //$table->dropColumn('profesion');
            $table->unsignedInteger('profesion_id')->after('password')->nullable();
            $table->foreign('profesion_id')->references('id')->on('profesion');

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users',function (Blueprint $table){
            $table->dropForeign(['profesion_id']);
            $table->dropColumn('profesion_id');
        });
    }
}
