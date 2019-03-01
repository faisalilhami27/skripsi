<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstPembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_pembayaran', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_pemesanan', 20);
            $table->integer('id_status')->unsigned();
            $table->text('bukti_pembayaran')->nullable();
            $table->integer('id_karyawan')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_karyawan')->references('id')->on('trs_karyawan');
            $table->foreign('id_status')->references('id')->on('mst_status_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_pembayaran');
    }
}