<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrsKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_karyawan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_karyawan')->unsigned()->index();
            $table->string('username', 20);
            $table->string('password', 255);
            $table->text('images')->nullable();
            $table->enum('status' ,['y', 'n']);
            $table->string('api_token', 210)->nullable()->unique();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_karyawan')->references('id')->on('karyawan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_karyawan');
    }
}
