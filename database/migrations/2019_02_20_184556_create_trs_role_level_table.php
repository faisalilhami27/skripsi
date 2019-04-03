<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrsRoleLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_level', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user_level')->unsigned();
            $table->integer('id_menu')->unsigned();
            $table->integer('create');
            $table->integer('read');
            $table->integer('update');
            $table->integer('delete');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_user_level')->references('id')->on('mst_user_level');
            $table->foreign('id_menu')->references('id')->on('mst_menu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trs_role_level');
    }
}
