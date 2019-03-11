<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstPemesananTiketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_pemesanan_tiket', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_pemesanan', 20)->unique();
            $table->date('tgl_pemesanan');
            $table->integer('id_karyawan')->unsigned()->nullable();
            $table->integer('jumlah_tiket');
            $table->integer('total_uang_masuk')->nullable();
            $table->integer('uang_pembayaran');
            $table->integer('status_penggunaan');
            $table->integer('id_jenis')->unsigned();
            $table->integer('id_customer')->unsigned();
            $table->string('qr_code', 100);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_karyawan')->references('id')->on('mst_user_karyawan');
            $table->foreign('id_jenis')->references('id')->on('mst_jenis_pemesanan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_pemesanan_tiket');
    }
}
