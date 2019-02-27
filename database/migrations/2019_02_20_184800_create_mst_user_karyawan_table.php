<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstUserKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_user_karyawan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 50);
            $table->string('username', 20);
            $table->string('email', 60);
            $table->string('password', 255);
            $table->text('images')->nullable();
            $table->enum('status' ,['y', 'n']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_user_karyawan');
    }
}
